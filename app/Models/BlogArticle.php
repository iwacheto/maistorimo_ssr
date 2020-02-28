<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogArticle extends Model {
    protected $table = 'blog_articles';

    protected $guarded = ['id'];

    protected $appends = ['less_content'];

    public function blogCategory() {
        return $this->belongsTo('App\Models\BlogCategory');
    }

    public function tags() {
        return $this->hasMany('App\Models\BlogTag', 'blog_article_id');
    }

    /**
     * Get the user's first name.
     *
     * @param  string $value
     * @return string
     */
    public function getLessContentAttribute() {
        return Str::limit($this->content, 50, ' ...');
    }

    public function author() {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleGalleries() {
        return $this->hasMany('App\Models\ArticleGallery','article_id');
    }
}

