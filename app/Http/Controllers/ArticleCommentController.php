<?php

namespace App\Http\Controllers;

use App\Models\ArticleComment;
use Illuminate\Http\Request;
use App\Http\Resources\Resource as ArticleCommentResource;
use App\Http\Requests\ArticleCommentRequest;

class ArticleCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // returns all article_comments
        $article_comments = ArticleComment::where('article_id', $id)->orderBy('created_at', 'DESC')->paginate(10);
        return ArticleCommentResource::collection($article_comments)->additional(['status' => true])->response()->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCommentRequest $request, $id)
    {
        // creates artcles
        $article_comment = ArticleComment::create(array_merge($request->all(), ['article_id' => $id]));
        return (new ArticleCommentResource($article_comment))->additional(['status' => true])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticleComment  $article_comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // show one article_comment
        $article_comment = ArticleComment::find($id);
        if ($article_comment) {
            return (new ArticleCommentResource($article_comment))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleComment  $article_comment
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleComment $article_comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArticleComment  $article_comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update article_comments
        $article_comment = ArticleComment::find($id);
        if ($article_comment) {
            $short_desc = substr($request->full_text, 0, 100);
            $article_comment->update($request->all());
            return (new ArticleCommentResource($article_comment))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleComment  $article_comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete article_comment
        $article_comment = ArticleComment::find($id);
        if ($article_comment) {
            $article_comment->delete();
            return (new ArticleCommentResource($article_comment))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }
}
