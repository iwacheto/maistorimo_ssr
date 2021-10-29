<?php

namespace App\Http\Controllers\Front;

use App\ContactAnalytic;
use App\Http\Controllers\Controller;
use App\Jobs\ContactsAnalitycJob;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function getProfile(Request $request, $id)
    {

        $user = User::with([
            'projects' => function($query) {
                $query->orderBy('created_at', 'DESC');
            },
            'vendorDetails',
            'websiteSettings',
            'services' => function($query) {
                $query->orderBy('created_at', 'DESC');
            },
        ])->find($id);
        // dd($user['projects'][0]['ProjectMainImage']['url']);
        foreach ($user['projects'] as &$project) {
            $project['mainImage'] = $project['ProjectMainImage']['url'];
        }
        return $user;
    }

    public function contactAnalysis(Request $request)
    {
        $data = $request->all();
        // return $data;
       // Cookie an Session
        $myCookieValue = $request->cookie('XSRF-TOKEN');
        $session = $request->session()->get('_token');
        $name = $request->session()->get('name');
        $dateTime = $data['date'];
        $today = \Carbon\Carbon::now()->format('Y/m/d');
        // return $dateTime;
        $analitycs = ContactAnalytic::where('user_id', $data['user'])->where('type', $data['object_type'])->where('date', $dateTime)->get();

        if ($name == 'maistorimo') {
            ContactsAnalitycJob::dispatch($data, $myCookieValue, $session, $name = true, $dateTime, $today, $analitycs)->onQueue('processing');
            return 'Броячът е увеличен';
        } else {
            $request->session()->put('name', 'maistorimo');
            ContactsAnalitycJob::dispatch($data, $myCookieValue, $session, $name = false, $dateTime, $today, $analitycs)->onQueue('processing');
            return 'Броячът е увеличен';
        }
    }

    public function getMeta(){
        return  'Pesho';
    }
}
