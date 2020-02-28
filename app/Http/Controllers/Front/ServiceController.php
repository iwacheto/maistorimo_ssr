<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Jobs\ObjectAnalitycJob;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\VendorDetail;
use App\ObjectAnalytic;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function getServices(Request $request, $id)
    {
        $service = Service::with([
            'projectServices',
            'projectServices.sProject',
        ])->find($id);
       $service->projectServices->map(function ($serviceProject) {
            $serviceProject->sProject->main_image = $serviceProject->sProject->ProjectMainImage ? $serviceProject->sProject->ProjectMainImage->url : "";
        });
        $service->first_description = strip_tags($service->first_description);
        $vendor = VendorDetail::where('user', $service->user_id)->first();
        return [
            'service' => $service,
            'vendor' => $vendor,
            // 'mainImg'=>$mainImg
        ];
    }

    public function getLastService()
    {
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        // dd($today);
        $services = DB::table('services')->select(DB::raw('services.*, object_analytics.count, object_analytics.date'))
            ->leftJoin('object_analytics', 'services.id', 'object_analytics.object_id')
            ->where('object_analytics.object_type', '=', 'service')
            ->where('object_analytics.date', '=', $today)->orderBy('object_analytics.count', 'DESC')->limit(10)->get();
        //  return $services;
        if (count($services) < 5) {
            $services = DB::table('services')->select(DB::raw('services.id, services.name, services.image_url,SUM(object_analytics.count) as count'))
                ->leftJoin('object_analytics', 'services.id', 'object_analytics.object_id')
                ->where('object_analytics.object_type', '=', 'service')
                ->groupBy('services.name')
                ->groupBy('services.id')
                ->groupBy('services.image_url')
                ->orderBy('count', 'DESC')->limit(10)->get();
            return $services;
        } else {
            return $services;
        }
    }

    public function applyServiceFilter(Request $request)
    {
        $data = $request->all();
        $page = isset($data['page']) ? $data['page'] : 1;
        $perPage = 10;
        // dd($data);
       if ($request->has('filters')) {
            $filters = json_decode($data['filters'], 1);
            $query = Service::select('*');
            foreach ($filters as $filterName => $value) {
                if ($value) {
                    $query->{$filterName}($value);
                }
                continue;
            }
            return $query->offset(($page - 1) * $perPage)->limit($perPage)->orderBy('created_at', 'DESC')->get();
        } else {
            $services = Service::offset(($page - 1) * $perPage)->limit($perPage)->orderBy('created_at', 'DESC')->get();
            return $services;
        }
    }

    public function getServiceCategories()
    {
        $serviceCaategories = ServiceCategory::all();
        return ($serviceCaategories);
    }

    public function getAnalysis(Request $request)
    {
        $name = $request->session()->get('name');
        // dd($name);
        $data = $request->all();
        $dateTime = $data['date'];
        $today = \Carbon\Carbon::now()->format('Y/m/d');
        $analitycs = ObjectAnalytic::where('user_id', $data['user'])->where('object_type', $data['object_type'])->where('object_id', $data['project'])->where('date', $dateTime)->get();
        if ($name == 'maistorimo') {
            ObjectAnalitycJob::dispatch($name = true, $data, $dateTime, $today, $analitycs)->onQueue('processing');
            return 'Броячът е увеличен';
        } else {
            $request->session()->put('name', 'maistorimo');
            ObjectAnalitycJob::dispatch($name = false, $data, $dateTime, $today, $analitycs)->onQueue('processing');
            return 'Броячът е увеличен';
        }
    }
}
