<?php

namespace App\Http\Controllers\Vendor;

use App\ContactAnalytic;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\City;
use App\Models\CityService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return Service::where('user_id', $user->id)->get();
    }

    public function getForSelect()
    {
        $user = auth()->user();
        $services = Service::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $return = [];
        foreach ($services as $k => $service) {
            $return[] = [
                'id' => $service->id,
                'name' => $service->name,
            ];
        }
        return $return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCities()
    {
        return City::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceRequest $request)
    {
        $data = $request->validated();

        if (!$data) {
            return 'Възникна грешка!';
        } else {
            $service = Service::create([
                'user_id'            => auth()->id(),
                'name'               => $data['title'],
                'first_description'  => $data['firstDescription'],
                'second_description' => $data['secondDescription'],
                'category_id'        => $data['category'],
                'all_country'        => $data['allCountry'] ? 1 : 0,
                'image_url'          => $data['mainImage']['url'],
                'image_name'         => $data['mainImage']['name']
            ]);

            $cities = City::find($data['location']);

            $service->cities()->attach($cities);
            return $service;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $service = Service::with([
            'category'
        ])->where([
            'id' => $id,
            'user_id' => $user->id
        ])->get();
        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        $user = auth()->user();
        $service = Service::with([
            'category'
        ])->where([
            'id' => $id,
            'user_id' => $user->id
        ])->firstOrFail();

        $service->update([
            'name'               => $request->all()['name'],
            'first_description'  => $request->all()['first_description'],
            'second_description' => $request->all()['second_description'],
            'category_id'         => $request->all()['service_id'],
            'image_url'          => $request->all()['mainImage'][0]['url'],
            'image_name'         => $request->all()['mainImage'][0]['name'],
        ]);
        return $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $service = Service::with([
            'category'
        ])->where([
            'id' => $id,
            'user_id' => $user->id
        ])->firstOrFail();
        $service->delete($id);
    }

    public function getServiceAnalytics()
    {
        $user = auth()->user();
        return Service::with(['records'])->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
    }

    public function getContactsAnalytics()
    {
        $user = auth()->user();
        return ContactAnalytic::where('user_id', $user->id)->get();
    }

    public function filterContactsAnalytics(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $user = auth()->user();
        $start = $data['start'];
        $end = $data['end'];
        return ContactAnalytic::where('user_id', $user->id)->whereBetween('date', [$start, $end])->get();
    }

    public function filterServicesAnalytics(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $start = $data['start'];
        $end = $data['end'];
        $services = Service::with(['records' => function ($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }])->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return $services;
    }
}
