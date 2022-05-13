<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // for soft deletes

class Article extends Model
{
    use HasFactory;
    use SoftDeletes; //add this lines
 
    public $fillable = [ 'title', 'short_description', 'full_text', 'thumbnail_path', 'image_path' ];
 
    protected $dates = [ 'deleted_at' ];

    public function likes_counter()
    {
        return $this->hasOne("App\LikedArticle");
    }

    public function views_counter()
    {
        return $this->hasOne("App\ViewedArticle");
    }

    public function article_tags()
    {
        return $this->hasMany("App\ArticleTag");
    }

    public function article_comments()
    {
        return $this->hasMany("App\ArticleComment");
    }
}
