<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function get() {
        $user = auth()->user();
        $projectsCount = Project::where('user', $user->id)->count();
        $servicesCount = Service::where('user_id', $user->id)->count();
        return response()->json([
            'user' => $user,
            'projectsCount' => $projectsCount,
            'servicesCount' => $servicesCount
        ]);
    }
}
