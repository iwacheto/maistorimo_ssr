<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GeneralTerm;
use App\Models\Project;
use App\Models\Service;
use App\Models\WebsiteSetting;
use App\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Spatie\SchemaOrg\Schema;

class WebsiteController extends Controller
{

    private $colors = [
        'blue' => '#2991d6',
        'brown' => '#825339',
        'chocolate' => '#ed703a',
        'gold' => '#d69942',
        'green' => '#97cc02',
        'olive' => '#a1a61a',
        'orange' => '#ff7713',
        'red' => '#ff0000',
        'sea' => '#13bfb1',
        'violet' => '#53348b',
        'yellow' => '#eea200'
    ];

    public function index($user)
    {
        $vendor = User::where('name', $user)->first();
        $projects = $vendor->projects()->orderBy('created_at', 'DESC')->get();
        // $projects = Project::where('user', $vendor->id)->orderBy('created_at', 'DESC')->get();
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        // dd($projects);
        $description = strip_tags(str_limit($settings->first_description, 150));
        SEOMeta::setTitle($settings->seo_title);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($settings->seo_title);
        OpenGraph::addImage($settings->main_image);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));

        $services = Service::where('user_id', $vendor->id)->get();
        return view('website.content.homepage', ['settings' => $settings, 'services' => $services, 'projects' => $projects, 'vendor' => $vendor, 'colors' => $this->colors, 'localBusiness' => $localBusiness]);
    }

    public function about($user)
    {
        $vendor = User::where('name', $user)->first();
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        $services = Service::where('user_id', $vendor->id)->get();
        $projects = $vendor->projects()->orderBy('created_at', 'DESC')->limit(2)->get();

        $description = strip_tags(str_limit($settings->first_description, 150));
        SEOMeta::setTitle($settings->seo_title);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($settings->seo_title);
        OpenGraph::addImage($settings->main_image);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));

        return view('website.content.about', ['projects' => $projects, 'settings' => $settings, 'services' => $services, 'vendor' => $vendor, 'colors' => $this->colors,  'localBusiness' => $localBusiness ]);
    }

    public function contact($user)
    {
        $vendor = User::where('name', $user)->first();
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        $services = Service::where('user_id', $vendor->id)->get();
        $projects = $vendor->projects()->orderBy('created_at', 'DESC')->limit(2)->get();

        $description = strip_tags(str_limit($settings->first_description, 150));
        SEOMeta::setTitle($settings->seo_title);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($settings->seo_title);
        OpenGraph::addImage($settings->main_image);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));

        return view('website.content.contacts', ['projects' => $projects, 'settings' => $settings, 'services' => $services, 'vendor' => $vendor, 'colors' => $this->colors , 'localBusiness' => $localBusiness]);
    }

    public function portfolio($user)
    {
        $vendor = User::where('name', $user)->first();
        $projects = $vendor->projects()->get();
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        $services = Service::where('user_id', $vendor->id)->get();
        // dd($projects);
        $description = strip_tags(str_limit($settings->first_description, 150));
        SEOMeta::setTitle($settings->seo_title);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($settings->seo_title);
        OpenGraph::addImage($settings->main_image);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));

        return view('website.content.portfolio.index', ['settings' => $settings, 'services' => $services, 'projects' => $projects, 'vendor' => $vendor, 'colors' => $this->colors, 'localBusiness' => $localBusiness]);
    }

    public function portfolioDetails($user, $project)
    {
        $vendor = User::where('name', $user)->first();
        $project = Project::where(['user' => $vendor->id, 'title' => $project])->first();
        $projects = $vendor->projects()->orderBy('created_at', 'DESC')->limit(2)->get();

        $description = strip_tags(str_limit($project->first_description, 150));
        SEOMeta::setTitle($project->title);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($project->name);
        OpenGraph::setDescription($description);
        OpenGraph::addImage($project->ProjectMainImage->url);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));
        // Gre6ka ot Usera
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        $services = Service::where('user_id', $vendor->id)->get();
        return view('website.content.portfolio.details', ['projects' => $projects, 'settings' => $settings, 'services' => $services, 'project' => $project, 'vendor' => $vendor, 'colors' => $this->colors, 'localBusiness' => $localBusiness]);
    }

    public function services($user)
    {
        $vendor = User::where('name', $user)->first();
        $services = Service::where('user_id', $vendor->id)->get();
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        $projects = $vendor->projects()->orderBy('created_at', 'DESC')->limit(2)->get();

        $description = strip_tags(str_limit($settings->first_description, 150));
        SEOMeta::setTitle($settings->seo_title);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($settings->seo_title);
        OpenGraph::addImage($settings->main_image);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));

        return view('website.content.service.services', ['projects' => $projects, 'settings' => $settings, 'services' => $services, 'vendor' => $vendor, 'colors' => $this->colors,  'localBusiness' => $localBusiness]);
    }

    public function serviceDetail($user, $name)
    {
        $vendor = User::where('name', $user)->first();
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        $services = Service::where('user_id', $vendor->id)->get();
        $service = Service::with([
            'projectServices',
            'projectServices.sProject'
        ])->where('name', $name)->first();
        $projects = $vendor->projects()->orderBy('created_at', 'DESC')->limit(2)->get();
        // dd($service);
        $description = strip_tags(str_limit($service->first_description, 150));
        // dd($description);
        SEOMeta::setTitle($service->name);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($service->name);
        OpenGraph::setDescription($description);
        OpenGraph::addImage($service->image_url);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->description($description)
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));

        return view('website.content.service.details', ['projects' => $projects, 'settings' => $settings, 'services' => $services, 'service' => $service, 'vendor' => $vendor, 'colors' => $this->colors, 'localBusiness' => $localBusiness]);
    }

    public function terms($user){
        $vendor = User::where('name', $user)->first();
        // dd($vendor);
        $settings = WebsiteSetting::where('user_id', $vendor->id)->first();
        $services = Service::where('user_id', $vendor->id)->get();
        $terms=GeneralTerm::where('vendor_id', $vendor->id)->get();
        $projects = $vendor->projects()->orderBy('created_at', 'DESC')->limit(2)->get();

        $description = strip_tags(str_limit($settings->first_description, 150));
        SEOMeta::setTitle($settings->seo_title);
        SEOMeta::setDescription($description);
        OpenGraph::setTitle($settings->seo_title);
        OpenGraph::addImage($settings->main_image);

        $localBusiness = Schema::localBusiness()
            ->name('Maistorimo')
            ->email('g.prusiyski@webrika.bg')
            ->url('https://maistorimo.bg')
            ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
            ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
            ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));

        return view('website.content.terms', ['projects' => $projects, 'settings' => $settings, 'services' => $services, 'vendor' => $vendor, 'colors' => $this->colors ,'terms'=>$terms, 'localBusiness' => $localBusiness]);
    }
}
