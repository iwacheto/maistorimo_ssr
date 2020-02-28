<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model {
    protected $table = 'blog_categories';

    protected $guarded = ['id'];


    public function blogArticles() {
        return $this->hasMany('App\Models\BlogArticle');
    }

    //
}
