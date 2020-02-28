<?php

namespace App\Http\Controllers\Vendor;

use App\Models\GeneralTerm;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class CategoriesController extends Controller
{

    public function getSubCategories()
    {
        // return Category::where('parent_id','!=', Null)->get();
        return Category::with([
            'children'
        ])->where('parent_id', Null)->get();
    }

    public function getCategories()
    {
        // return Category::with([
        //     'children'
        // ])->where('parent_id', Null)->get();
        $mainCategories = Category::where('parent_id', Null)->get();
        $serviceCategories = DB::table('services')
            ->selectRaw('categories.id,categories.title,categories.parent_id')
            ->join('categories', 'services.category_id', 'categories.id')
            ->where('categories.parent_id', '>', 0)
            ->groupBy('categories.id')
            ->groupBy('categories.title')
            ->groupBy('categories.parent_id')
            ->get();
        $sIds = $serviceCategories->pluck('parent_id');
        $servicemainCategories = Category::whereIn('id', $sIds)->get();

        $projectCategories = DB::table('projects')
            ->selectRaw('categories.id,categories.title,categories.parent_id')
            ->join('categories', 'projects.category', 'categories.id')
            ->where('categories.parent_id', '>', 0)
            ->groupBy('categories.id')
            ->groupBy('categories.title')
            ->groupBy('categories.parent_id')
            ->get();
        $ids = $projectCategories->pluck('parent_id');
        $projMainCategories = Category::whereIn('id', $ids)->get();

        return [
            'mainSerCategory' => $servicemainCategories,
            'mainProjCategory' => $projMainCategories,
            'services' => $serviceCategories,
            'projects' => $projectCategories,
        ];
    }

    public function getTags()
    {
        return Tag::withCount('projectTags')->get();
    }

    public function getTerms($id)
    {
        return GeneralTerm::firstOrCreate(['vendor_id' => $id]);
    }
}
