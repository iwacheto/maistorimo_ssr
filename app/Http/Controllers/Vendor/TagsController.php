<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProject;
use App\Models\Category;
use App\Models\City;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use App\Models\ProjectGallery;
use App\Models\ProjectService;
use App\Models\Service;

class TagsController extends Controller {

    public function getTags() {
        $tags = Tag::all();
        return $tags->transform(function ($item, $key) {
            return [
                'text' => $item['tag'],
                'id' => $item['id']
            ];
        });
    }
}
