<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class UploadController extends Controller
{

    public function uploadImage(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $file = $data['file']->path();
        \Cloudder::upload($file, $user->name . '/' .  substr($data['file']->getClientOriginalName(), 0, strrpos($data['file']->getClientOriginalName(), '.')) . uniqid(), ['format' => 'WebP']);
        $res = \Cloudder::getResult();
        $esImage = $res['secure_url'];
        return ['url' => $esImage];
    }

    public function uploadProfilePhoto(Request $request) {
        $data = $request->all();
        Cloudder::upload($data['dataUrl'], uniqid(), ['format' => 'WebP']);
        // \Cloudder::upload($data['dataUrl'], $user->name . '/' .  substr($data['file']->getClientOriginalName(), 0, strrpos( $data['file']->getClientOriginalName(), '.')) . uniqid());
        $res = Cloudder::getResult();
        $esImage = $res['secure_url'];
        return ['url' => $esImage];

    }

    public function uploadProfileMainPhoto(Request $request) {
        $data = $request->all();
        \Cloudder::upload($data['dataUrl'], uniqid(), ['format' => 'WebP']);
        $res = \Cloudder::getResult();
        $esImage = $res['secure_url'];
        return ['url' => $esImage];

    }
}
