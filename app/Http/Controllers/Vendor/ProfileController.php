<?php

namespace App\Http\Controllers\Vendor;
use App\Http\Controllers\Controller;
use App\Models\GeneralTerm;
use Illuminate\Http\Request;
use App\User;
use App\Models\VendorDetail;
use App\Models\WebsiteSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    function __constructy() {
        $this->auth();
    }

    public function index() {

        $user = auth()->user();
        $user = User::with(['vendorDetails', 'websiteSettings', 'terms', 'vendorDetails.city'])->find($user->id);
        if(!$user->vendorDetails) {
            VendorDetail::insert(
                [
                'user' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            );
            $user = User::with(['vendorDetails', 'websiteSettings'])->find($user->id);
        }
        if(!$user->terms) {
            $newTerms = new GeneralTerm();
            $newTerms->vendor_id = $user->id;
            $newTerms->save();
            $user = User::with(['websiteSettings', 'terms'])->find($user->id);
        }
        if(!$user->websiteSettings) {
            WebsiteSetting::insert(
                [
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            );
            $user = User::with(['vendorDetails', 'websiteSettings'])->find($user->id);
        }
        // \JavaScript::put('user', $user);
        return view('vendor.index');
    }

    public function saveProfile(Request $request) {
        $data = $request->all();
        // return $data;
        $user=auth()->user();
        $vendorDetails = VendorDetail::where([
            'id'=>$data['vendor_details']['id'],
            'user'=>$user->id
            ])->first();
        $vendorDetails->fill($data['vendor_details']);
        $vendorDetails->update();
    }

    public function changePassword(Request $request) {
        $user = auth()->user();
        $user = User::find($user->id);
        $user->password = Hash::make($request->get('password'));
        $user->save();
    }

    public function getProfile() {

    }

}
