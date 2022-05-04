<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\Resource as ArticleResource;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/articles",
     *      operationId="getArticlesList",
     *      tags={"Articles"},
     *      summary="Get list of articles",
     *      description="Returns list of articles",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function index()
    {
        // returns all articles
        $articles = Article::orderBy('created_at', 'DESC')->paginate(10);
        return ArticleResource::collection($articles)->additional(['status' => true])->response()->setStatusCode(200);
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
     *      path="/articles",
     *      operationId="postArticle",
     *      tags={"Articles"},
     *      summary="post an article",
     *      description="post an article",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function store(ArticleRequest $request)
    {
        // creates artcles
        $short_desc = substr($request->full_text, 0, 100);
        $article = Article::create(array_merge($request->all(), ['short_description' => $short_desc]));
        return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/articles/{id}",
     *      operationId="getoneArticle",
     *      tags={"Articles"},
     *      summary="get an article",
     *      description="get an article",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function show($id)
    {
        // show one article
        $article = Article::find($id);
        if ($article) {
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Put(
     *      path="/articles/{id}",
     *      operationId="updateArticle",
     *      tags={"Articles"},
     *      summary="update an article",
     *      description="update an article",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function update(Request $request, $id)
    {
        // update articles
        $article = Article::find($id);
        if ($article) {
            $short_desc = substr($request->full_text, 0, 100);
            $article->update(array_merge($request->all(), ['short_description' => $short_desc]));
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *      path="/articles/{id}",
     *      operationId="deleteArticle",
     *      tags={"Articles"},
     *      summary="delete an article",
     *      description="delete an article",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function destroy($id)
    {
        // delete article
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }
}
