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
use App\Models\ProjectTag;
use App\Models\Service;
use App\Models\ServiceCategory;

class ProjectsController extends Controller {

    public function getProjects() {
        $user = auth()->user();
        return Project::with(['projectGalleries'])->where('user', $user->id)->orderBy('created_at', 'DESC')->get();
    }

    public function getProjectsAnalitycs(){
        $user = auth()->user();
       return Project::with(['projectGalleries', 'records'])->where('user', $user->id)->orderBy('created_at', 'DESC')->get();
    }

    public function getFilterProjectsAnalitycs(Request $request){
        $data=$request->all();
        $user=auth()->user();
        $start= $data['start'];
        $end= $data['end'];
        $projects=Project::with(['projectGalleries', 'records'=> function($q) use($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }])->where('user', $user->id)->orderBy('created_at', 'DESC')->get();
        return $projects;
    }

    public function getProject($id) {
        $user = auth()->user();
        return Project::with([
            'projectGalleries',
            'tags',
            'tags.tag',
            'projectServices',
            'projectServices.service'
        ])->where([
            'id' => $id,
            'user' => $user->id
        ])->firstOrFail();
    }

    public function deleteProject($id) {
        $user = auth()->user();
        $project = Project::where([
            'id'=>$id,
            'user'=>$user->id
        ])->firstOrFail();
        $images = $project->projectGalleries()->get();
        foreach ($images as $k => $image) {
            $imagePublicId = explode('/', $image->url);
            $imagePublicId = $imagePublicId[count($imagePublicId) - 2] . '/' . explode('.', $imagePublicId[count($imagePublicId) - 1])[0];
            $rest = \Cloudder::delete($imagePublicId);
        }
        $project->delete($id);
    }

    public function editProject($id, Request $request) {

        $data = $request->all();
        $user = auth()->user();
        $project = Project::where([
            'id'=>$id,
            'user'=>$user->id
        ])->firstOrFail();
        $project->user = $user->id;
        $project->title = $data['title'];
        $project->category = $data['category'];
        $project->description = $data['description'];
        $project->lat = $request->all()['lat'];
        $project->lng = $request->all()['lng'];
        $project->formatted_address = $request->all()['formatted_address'];
        $project->raw_data = json_encode($request->all()['raw_data']);

        $project->save();
        $tags = [];
        $projectServices = $project->projectServices()->get()->pluck('service', 'service')->toArray();
        foreach($data['userServicesTags'] as $k => $service) {
            if(in_array($service['id'], $projectServices)) {
                unset($projectServices[$service['id']]);
            }
            ProjectService::updateOrCreate(
                [
                    'service' => $service['id'],
                    'project' => $project->id
                ],
                [
                    'service' => $service['id'],
                    'project' => $project->id
                ]
            );
        }
        foreach($projectServices as $service) {
            $projectService = ProjectService::where(['service' => $service, 'project' => $project->id])->firstOrFail();

            $projectService->delete();
        }
            // dd($data['tags']);
        $projectTags = ProjectTag::where('project_id', $project->id)->get()->pluck('tag_id', 'tag_id');

        foreach ($data['tags'] as $k => $tag) {
            if(!isset($tag['id'])) {
                $existingTag = Tag::where('tag', $tag['text'])->firstOrFail();
                if($existingTag) {
                    $newTag = $existingTag;
                } else {
                    $newTag = new Tag();
                    $newTag->tag = $tag['text'];
                    $newTag->save();
                }
                $tag['id'] = $newTag->id;
            }

            if(isset($projectTags[$tag['id']])) {
                unset($projectTags[$tag['id']]);
            }

            ProjectTag::updateOrCreate(
                [
                    'project_id'    => $project->id,
                    'tag_id'        => $tag['id']
                ],
                [
                    'project_id'    => $project->id,
                    'tag_id'        => $tag['id'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
        foreach($projectTags as $delTag) {
            ProjectTag::where(['tag_id' => $delTag, 'project_id' => $project->id])->delete();
        }
        // ProjectTag::insert($tags);
        $images = [];
        foreach ($data['project_galleries'] as $k => $image) {
            if (!isset($image['id'])) {
                $images[] = [
                    'project'    => $project->id,
                    'main'       => $k == 0 ? 1 : 0,
                    'url'        => $image['url'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            } else if (isset($image['deleted'])) {

                $imagePublicId = explode('/', $image['url']);
                $imagePublicId = $imagePublicId[count($imagePublicId) - 2] . '/' . explode('.', $imagePublicId[count($imagePublicId) - 1])[0];

                $rest = \Cloudder::delete($imagePublicId);
                ProjectGallery::destroy($image['id']);
            }
        }
        ProjectGallery::insert($images);
    }

    public function addProject(CreateProject $request) {
        // return $request->all();
         $request->validate([
            'title'=>'required|min:6|max:255|string',
            'description'=>'required|min:15|string',
            'category'=>'required',
            'city'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'formatted_address'=>'required',
            'raw_data'=>'required',
            'tags'=>'required',
            'images'=>'required',
        ]);
        $data=$request->all();

        if(!$data){
            return 'Съжаляваме, но възникна грешка, моля опитайте отново!';
        }

        $project = Project::create([
            'title'             => $request->all()['title'],
            'description'       => $request->all()['description'],
            'category'          => $request->all()['category'],
            'city_id'           => $request->all()['city'],
            'lat'               => $request->all()['lat'],
            'lng'               => $request->all()['lng'],
            'formatted_address' => $request->all()['formatted_address'],
            'raw_data'          => json_encode($request->all()['raw_data']),
            'user'              => auth()->user()->id
        ]);

        if($data['userServices']){
            $projectServices = $project->projectServices()->get()->pluck('service', 'service')->toArray();
            foreach($data['userServices'] as $k => $service) {
                if(in_array($service['id'], $projectServices)) {
                    unset($projectServices[$service['id']]);
                }
                ProjectService::updateOrCreate(
                    [
                        'service' => $service['id'],
                        'project' => $project->id
                    ],
                    [
                        'service' => $service['id'],
                        'project' => $project->id
                    ]
                );
            }
            foreach($projectServices as $service) {
                $projectService = ProjectService::where(['service' => $service, 'project' => $project->id])->firstOrFail();

                $projectService->delete();
            }
        }


        $projectTags = ProjectTag::where('project_id', $project->id)->get()->pluck('tag_id', 'tag_id');

        foreach ($data['tags'] as $k => $tag) {
            if(!isset($tag['id'])) {
                $existingTag = Tag::where('tag', $tag['text'])->first();
                if($existingTag) {
                    $newTag = $existingTag;
                } else {
                    $newTag = new Tag();
                    $newTag->tag = $tag['text'];
                    $newTag->save();
                }
                $tag['id'] = $newTag->id;
            }

            if(isset($projectTags[$tag['id']])) {
                unset($projectTags[$tag['id']]);
            }

            ProjectTag::updateOrCreate(
                [
                    'project_id'    => $project->id,
                    'tag_id'        => $tag['id']
                ],
                [
                    'project_id'    => $project->id,
                    'tag_id'        => $tag['id'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
        foreach($projectTags as $delTag) {
            ProjectTag::where(['tag_id' => $delTag, 'project_id' => $project->id])->delete();
        }
        // $tags = [];
        // foreach ($data['tags'] as $k => $tag) {
        //     $tags[] = [
        //         'project'    => $project->id,
        //         'tag'        => $tag['text'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ];
        // }
        // Tag::insert($tags);
        $images = [];
        foreach ($data['images'] as $k => $image) {
            $images[] = [
                'project'    => $project->id,
                'main'       => $k == 0 ? 1 : 0,
                'url'        => $image['url'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        ProjectGallery::insert($images);
        return $project->id;
    }

//    public function autcompleteCity(Request $request) {
//        $searchQuery = $request->searchQuery;
//        $data = City::name($searchQuery)->get();
//
//
//        return response()->json($data);
//
//    }

    public function getServiceCategories(){
        $serviceCaategories=ServiceCategory::all();
        return ($serviceCaategories);
    }

    public function filterProjectsAnalytics(Request $request){
        $data=$request->all();
        dd($data);
    }
}
