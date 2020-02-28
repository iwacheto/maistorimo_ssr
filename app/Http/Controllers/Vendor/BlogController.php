<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Models\ArticleGallery;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller {

    public function createArticle(CreateArticleRequest $request) {


        $data = $request->all();

        $article = BlogArticle::create([
            'title'            => $request->all()['title'],
            'description'      => $request->all()['description'],
            'blog_category_id' => $request->all()['category'],
            'content'          => $request->all()['content'],
            'url_address'      => $request->all()['url_address'],
            'author_id'        => auth()->user()->id
        ]);


        $tags = [];
        foreach ($data['tags'] as $k => $tag) {
            $tags[] = [
                'blog_article_id' => $article->id,
                'name'            => $tag['text'],
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
            ];
        }
        BlogTag::insert($tags);


        $images = [];
        foreach ($data['images'] as $k => $image) {
            $images[] = [
                'article_id' => $article->id,
                'main'       => 0,
                'name'       => $image['name'],
                'url'        => $image['url'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        $images[] = [
            'article_id' => $article->id,
            'main'       => 1,
            'name'       => $data['mainImage']['name'],
            'url'        => $data['mainImage']['url'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        ArticleGallery::insert($images);
        return $article->id;
    }

    public function getCategories() {
        return BlogCategory::all();
    }

    public function getArticle($id) {
        return BlogArticle::with([
            'tags',
            'articleGalleries'
        ])->find($id);
    }

    public function deleteArticle($id) {
        $article = BlogArticle::find($id);
        $article->delete($id);
    }

    public function getArticles() {
        return BlogArticle::with(['articleGalleries'])->orderBy('created_at', 'DESC')->get();
    }

    public function updateArticle($id, Request $request) {

        $data = $request->all();

        $user = auth()->user();
        $article = BlogArticle::find($id);
        $article->author_id = $user->id;
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->blog_category_id = $data['blog_category_id'];
        $article->description = $data['description'];
        $article->save();

        $tags = [];
        foreach ($data['tags'] as $k => $tag) {
            if (!isset($tag['id'])) {
                $tags[] = [
                    'blog_article_id' => $article->id,
                    'name'            => $tag['text'],
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now()
                ];
            } else if (isset($tag['deleted'])) {
                BlogTag::destroy($tag['id']);
            }
        }
        BlogTag::insert($tags);
        $images = [];
        foreach ($data['article_galleries'] as $k => $image) {
            if (!isset($image['id'])) {
                $images[] = [
                    'article_id' => $article->id,
                    'main'       => isset($image['main']) ? $image['main'] : 0,
                    'name'       => $image['name'],
                    'url'        => $image['url'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            } else if (isset($image['deleted'])) {

                $imagePublicId = explode('/', $image['url']);
                $imagePublicId = $imagePublicId[count($imagePublicId) - 2] . '/' . explode('.', $imagePublicId[count($imagePublicId) - 1])[0];

                $rest = \Cloudder::delete($imagePublicId);
                ArticleGallery::destroy($image['id']);
            }


        }
        ArticleGallery::insert($images);
        return $article->id;
    }

}
