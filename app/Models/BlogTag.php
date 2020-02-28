<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model {
    //
    protected $table = 'blog_tags';

    protected $guarded = ['id'];
    protected $hidden = ["created_at", "updated_at"];


    public function article() {
        return $this->belongsTo('App\Models\BlogArticle', 'blog_article_id');
    }
}
