<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Vendor;
use App\Models\GeneralTerm;
use Illuminate\Http\Request;
use App\User;
use App\Models\VendorDetail;
use App\Models\WebsiteSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function __invoke()
    {

        $user = auth()->user();
        // $user = User::with(['vendorDetails', 'websiteSettings', 'terms', 'vendorDetails.city'])->find($user->id);
        $user = User::with(['vendorDetails', 'websiteSettings', 'terms', 'vendorDetails.city'])->find(4);
        if (!$user->vendorDetails) {
            VendorDetail::insert(
                [
                    'user' => $user->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            $user = User::with(['vendorDetails', 'websiteSettings'])->find($user->id);
        }
        if (!$user->terms) {
            $newTerms = new GeneralTerm();
            $newTerms->vendor_id = $user->id;
            $newTerms->save();
            $user = User::with(['websiteSettings', 'terms'])->find($user->id);
        }
        if (!$user->websiteSettings) {
            WebsiteSetting::insert(
                [
                    'user_id' => $user->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            $user = User::with(['vendorDetails', 'websiteSettings'])->find($user->id);
        }
        \JavaScript::put('user', $user);
        return view('admin', [
            'packages' => $this->getPackages(),
        ]);
    }

    private function getPackages(): array
    {
        $path = public_path('packages.json');

        $contents = file_get_contents($path);

        return json_decode($contents, true);
    }
}
