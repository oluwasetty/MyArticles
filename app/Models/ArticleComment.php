<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // for soft deletes

class ArticleComment extends Model
{
    use HasFactory;
    use SoftDeletes; //add this line
 
    public $fillable = [ 'article_id', 'subject', 'body' ];
 
    protected $dates = [ 'deleted_at' ];
}