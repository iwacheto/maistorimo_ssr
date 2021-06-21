<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Jobs\ObjectAnalitycJob;
use App\Models\Category;
use App\Models\City;
use App\Models\Project;
use App\Models\VendorDetail;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use App\Models\ProjectGallery;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{

    public function getProjects(Request $request)
    {
        $data = $request->all();
        $page = $data['page'];
        $perPage = 6;
        return Project::with([
            'projectGalleries',
            'tags'
        ])->offset(($page - 1) * $perPage)->limit($perPage)->orderBy('created_at', 'DESC')->get();
    }

    public function getProject($id)
    {

        // ObjectAnalitycJob::dispatch($name = true, [], [], [], [])->onQueue('processing');
        $project = Project::with([
            'projectGalleries',
            'tags',
            'tags.tag',
            'city',
            'projectServices.service',
        ])->find($id);

        $project->description = strip_tags($project->description);
        $vendor = VendorDetail::where('user', $project->user)->first();
        return [
            'project' => $project,
            'vendor'  => $vendor
        ];
    }

    public function getPopularProjects()
    {
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $projects = DB::table('projects')->select(DB::raw('projects.*, object_analytics.count, project_gallery.url'))
            ->leftJoin('object_analytics', 'projects.id', 'object_analytics.object_id')
            ->where('object_analytics.object_type', 'project')
            ->leftjoin('project_gallery', 'project_gallery.id', 'projects.id')
            ->whereNull('deleted_at')
            // ->where('project_gallery.main', 1)
            ->where('object_analytics.date', $today)->orderBy('object_analytics.count', 'DESC')->limit(10)->get();
        // return $projects;
        if (count($projects) < 5) {
            $projects = DB::table('projects')
                ->selectRaw('projects.id, projects.title ,SUM(object_analytics.count) as count,project_gallery.url')
                ->leftjoin('object_analytics', 'projects.id', 'object_analytics.object_id')
                ->where('object_analytics.object_type', 'project')
                ->whereNotNull('project_gallery.url')
                ->leftjoin('project_gallery', 'projects.id', 'project_gallery.project')
                ->where('project_gallery.main', 1)
                ->whereNull('deleted_at')
                ->groupBy('projects.title')
                ->groupBy('projects.id')
                ->groupBy('project_gallery.url')
                ->orderBy('count', 'DESC')->limit(10)->get();
            return $projects;
        } else {
            return $projects;
        }
    }

    public function applyFilter(Request $request)
    {
        $data = $request->all();
        $page = isset($data['page']) ? $data['page'] : 1;
        $perPage = 10;

        if ($request->has('filters')) {
            $filters = json_decode($request->all()['filters'], 1);
            $query = Project::with(['projectGalleries']);
            foreach ($filters as $filterName => $value) {
                if ($value) {
                    $query->{$filterName}($value);
                }
                continue;
            }
            return $query->offset(($page - 1) * $perPage)->limit($perPage)->orderBy('created_at', 'DESC')->get();
        } else {
            return Project::with(['projectGalleries'])->offset(($page - 1) * $perPage)->limit($perPage)->orderBy('created_at', 'DESC')->get();
        }
        //
    }

    public function applybyTagFilter(Request $request)
    {
        $data = $request->all();
        $page = $data['page'];
        $perPage = 10;
        if ($request->has('filters')) {
            $filters = json_decode($request->all()['filters'], 1);
            // dd($filters);
            $array = [];
            foreach ($filters as $value => $key) {
                $array = $key;

                continue;
            }
            return $query = Tag::with(['projects', 'projects', 'projects.projectGalleries'])->whereIn('tag', $array)->offset(($page - 1) * $perPage)->limit($perPage)->get();
            // return $query->offset(($page - 1) * $perPage)->limit($perPage)->orderBy('created_at', 'DESC')->get();
        } else {
            return Tag::with(['projects', 'projects' . 'projectGalleries'])->offset(($page - 1) * $perPage)->limit($perPage)->get();
        }
    }

    public function autcompleteCity(Request $request)
    {
        $searchQuery = $request->searchQuery;
        $data = City::name($searchQuery)->get();
        return response()->json($data);
    }

    public function fetchProjects(){
        return Project::all();
    }
}
