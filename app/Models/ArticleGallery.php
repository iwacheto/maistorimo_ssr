<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleGallery extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_gallery';

    protected $guarded = ['id'];


    public function article() {
        return $this->belongsTo('App\Models\BlogArticle', 'article_id');
    }
}
