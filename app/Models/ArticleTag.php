<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // for soft deletes

class ArticleTag extends Model
{
    use HasFactory;
    use SoftDeletes; //add this line
 
    public $fillable = [ 'article_id', 'label', 'url' ];
 
    protected $dates = [ 'deleted_at' ];
}
