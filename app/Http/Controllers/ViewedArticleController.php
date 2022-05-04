<?php

namespace App\Http\Controllers;

use App\Models\ViewedArticle;
use Illuminate\Http\Request;
use App\Http\Resources\Resource as ArticleResource;

class ViewedArticleController extends Controller
{

    /**
     * @OA\Get(
     *      path="/articles/{id}/view",
     *      operationId="getArticlesViews",
     *      tags={"Articles"},
     *      summary="Get view counter of articles",
     *      description="Get how many views the articles have",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function getArticleViews($id){
        $article = ViewedArticle::where('article_id', $id)->first();
        if ($article) {
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }


    /**
     * @OA\Post(
     *      path="/articles/{id}/view",
     *      operationId="saveArticlesViews",
     *      tags={"Articles"},
     *      summary="increment view counter of articles",
     *      description="increases the count when someone views an article",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function saveArticleView($id){
        // find article
        $article = ViewedArticle::where('article_id', $id)->first();
        if ($article) {
            $count = $article->count + 1;
            $article->update(['count' => $count]);
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            $article = ViewedArticle::create([
                'article_id' => $id,
                'count' => 1
            ]);
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        }
    }
}
