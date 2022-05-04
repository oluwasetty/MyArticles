<?php

namespace App\Http\Controllers;

use App\Models\ArticleTag;
use Illuminate\Http\Request;
use App\Http\Resources\Resource as ArticleTagResource;
use App\Http\Requests\ArticleTagRequest;

class ArticleTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/articles/{id}/tags",
     *      operationId="getArticlesTagList",
     *      tags={"Articles"},
     *      summary="Get list of articles",
     *      description="Returns list of articles",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function index($id)
    {
        // returns all article_tags
        $article_tags = ArticleTag::where('article_id', $id)->orderBy('created_at', 'DESC')->get();
        return ArticleTagResource::collection($article_tags)->additional(['status' => true])->response()->setStatusCode(200);
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

    /**
     * @OA\Post(
     *      path="/articles/{id}/tags",
     *      operationId="postArticleTag",
     *      tags={"Articles"},
     *      summary="post an article tag",
     *      description="post an article tag",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function store(ArticleTagRequest $request, $id)
    {
        // creates artcles
        $article_tag = ArticleTag::create(array_merge($request->all(), ['article_id' => $id]));
        return (new ArticleTagResource($article_tag))->additional(['status' => true])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/articles/{id}/tags/{id}",
     *      operationId="getoneArticleTag",
     *      tags={"Articles"},
     *      summary="get an article tag",
     *      description="get an article tag",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function show($id)
    {
        // show one article_tag
        $article_tag = ArticleTag::find($id);
        if ($article_tag) {
            return (new ArticleTagResource($article_tag))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleTag $article_tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Put(
     *      path="/articles/{id}/tags/{id}",
     *      operationId="updateArticleTag",
     *      tags={"Articles"},
     *      summary="update an article tag",
     *      description="update an article tag",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function update(Request $request, $id)
    {
        // update article_tags
        $article_tag = ArticleTag::find($id);
        if ($article_tag) {
            $short_desc = substr($request->full_text, 0, 100);
            $article_tag->update($request->all());
            return (new ArticleTagResource($article_tag))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *      path="/articles/{id}/tags/{id}",
     *      operationId="deleteArticleTag",
     *      tags={"Articles"},
     *      summary="delete an article tag",
     *      description="delete an article tag",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function destroy($id)
    {
        // delete article_tag
        $article_tag = ArticleTag::find($id);
        if ($article_tag) {
            $article_tag->delete();
            return (new ArticleTagResource($article_tag))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }
}
