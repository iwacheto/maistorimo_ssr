<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use Illuminate\Http\Request;

class BlogController extends Controller {
    //
    public function getArticles() {
        $articles = BlogArticle::with(['articleGalleries'])->orderBy('created_at', 'DESC')->paginate(3);

        $response = [
            'pagination' => [
                'total'        => $articles->total(),
                'per_page'     => $articles->perPage(),
                'current_page' => $articles->currentPage(),
                'last_page'    => $articles->lastPage(),
                'from'         => $articles->firstItem(),
                'to'           => $articles->lastItem()
            ],
            'data'       => $articles,

        ];
        return response()->json($response);
    }

    public function getLatestArticles() {
        $lastAdded = BlogArticle::with(['articleGalleries'])->latest('created_at')->limit(3)->get();
        return $lastAdded;
    }

    public function getArticle($id) {
        return BlogArticle::with([
            'tags',
            'author',
            'articleGalleries'
        ])->find($id);
    }

    public function getLatestFromCategory(Request $request,$categoryId) {


        $latestFromCategory = BlogArticle::with(['articleGalleries'])->where('blog_category_id', $categoryId)->latest('created_at')->limit(3)->get();


     return $latestFromCategory;
    }
}
