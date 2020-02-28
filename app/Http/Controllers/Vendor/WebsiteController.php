<?php

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\VendorDetail;
use App\Models\GeneralTerm;
use App\Models\WebsiteSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class WebsiteController extends Controller
{

    function __constructy()
    {
        $this->auth();
    }

    public function index()
    {

        $user = auth()->user();
        $user = User::with(['websiteSetting', 'terms'])->find($user->id);
        if (!$user->websiteSetting) {
            WebsiteSetting::insert(
                [
                    'user' => $user->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            $user = User::with('websiteSetting')->find($user->id);
        }
        \JavaScript::put('user', $user);
        return view('vendor.index');
    }

    public function saveWebsite(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'name' => 'max:255|nullable',
            'email' => 'nullable|email',
            'vendor_details.user' => 'max:255|nullable',
            'website_settings.id' => 'max:255|nullable',
            'website_settings.main_image' => 'max:255|nullable',
            'website_settings.logo' => 'max:255|nullable',
            'website_settings.home_text' => 'max:1000|nullable',
            'website_settings.about_us' => 'min:15|nullable',
            'website_settings.color' => 'max:255|nullable',
            'website_settings.raw_data' => 'nullable',
            'website_settings.home_heading' => 'max:255|nullable',
            'website_settings.bullet_1_heading' => 'max:255|nullable',
            'website_settings.bullet_1_content' => 'max:255|nullable',
            'website_settings.bullet_2_heading' => 'max:255|nullable',
            'website_settings.bullet_2_content' => 'max:255|nullable',
            'website_settings.bullet_3_heading' => 'max:255|nullable',
            'website_settings.bullet_3_content' => 'max:255|nullable',
            'website_settings.about_us_2' => 'nullable',
            'website_settings.seo_title' => 'max:100|nullable',
            'website_settings.seo_description' => 'max:255|nullable',
            'terms.id' => 'nullable|integer',
            'terms.name' => 'max:255|nullable',
            'terms.address_reg' => 'max:255|nullable',
            'terms.eik' => 'max:9|nullable|min:9',
            'terms.manager' => 'max:255|nullable',
            'terms.phone' => 'nullable||min:8|numeric',
            'terms.email' => 'max:255|nullable|email',
            'terms.address' => 'max:255|nullable',
            'terms.description' => 'max:255|nullable',
        ]);

        

        $user = auth()->user();

        if (isset($data['website_settings']['raw_data'])) {
            $address = $data['website_settings']['raw_data']['formatted_address'];
            $lat = $data['website_settings']['raw_data']['geometry']['location']['lat'];
            $lng = $data['website_settings']['raw_data']['geometry']['location']['lng'];
            $data['website_settings']['lat'] = $lat;
            $data['website_settings']['lng'] = $lng;
            $data['website_settings']['formatted_address'] = $address;
            $data['website_settings']['raw_data'] = json_encode($data['website_settings']['raw_data']);
        }

        // dd($data);
        $vendorDetails = WebsiteSetting::where([
            'id' => $data['website_settings']['id'],
            'user_id' => $user->id
        ])->first();

        $vendorDetails->fill($data['website_settings']);
        $vendorDetails->save();

        $id = $data['id'];
        $terms = GeneralTerm::firstOrNew(['vendor_id' => $id]);
        $terms->fill($data['terms']);
        $terms->save();
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $user = User::find($user->id);
        $user->password = Hash::make($request->get('password'));
        $user->save();
    }

    public function getProfile()
    {
    }
}
