<?php

namespace App\Http\Controllers;

use App\Models\LikedArticle;
use Illuminate\Http\Request;
use App\Http\Resources\Resource as ArticleResource;

class LikedArticleController extends Controller
{
    public function getArticleLikes($id){
        $article = LikedArticle::where('article_id', $id)->first();
        if ($article) {
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            return response()->json(['status' => false, 'error' => 'resource could not be found'], 404);
        }
    }

    public function saveArticleLike($id){
        // find article
        $article = LikedArticle::where('article_id', $id)->first();
        if ($article) {
            $count = $article->count + 1;
            $article->update(['count' => $count]);
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        } else {
            $article = LikedArticle::create([
                'article_id' => $id,
                'count' => 1
            ]);
            return (new ArticleResource($article))->additional(['status' => true])->response()->setStatusCode(200);
        }
    }
}
