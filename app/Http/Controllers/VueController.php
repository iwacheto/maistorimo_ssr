<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\VendorDetail;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
// use Artesaos\SEOTools\Facades\JsonLd;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\Auth;


class VueController extends Controller
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

    public function __invoke()
    {
        $currentURL = \Request::fullUrl();
        $user = Auth::user();
        // dd($user->name);
        $parameters = \Request::segment(1);
        $id = \Request::segment(3);
        $url = 'maistorimo.bg';

        if ($parameters === 'project') {
            $project = Project::with(['projectGalleries'])->where('id', $id)->first();
            $description = strip_tags(str_limit($project->description, 150));
            // dd($project->projectGalleries[0]->url);
            $title = $project->title;
            SEOMeta::setTitle($project->title);
            SEOMeta::setDescription($description);

            OpenGraph::setTitle($project->title);
            // OpenGraph::setUrl($url);
            OpenGraph::setSiteName($currentURL);
            $imgSize = getimagesize($project->projectGalleries[0]->url);
            $width = $imgSize[0];
            $height = $imgSize[1];
            OpenGraph::addImage($project->projectGalleries[0]->url, ['height' => $width, 'width' => $height]);
            OpenGraph::setDescription($description);

            $localBusiness = Schema::localBusiness()
                ->name($project->title)
                ->email('g.prusiyski@webrika.bg')
                ->url($currentURL)
                ->logo($project->projectGalleries[0]->url)
                ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
                ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));
        } elseif ($parameters === 'service') {
            $servise = Service::where('id', $id)->first();
            $description = strip_tags(str_limit($servise->first_description, 150));
            $title = $servise->name;
            SEOMeta::setTitle($servise->name);
            SEOMeta::setDescription($description);

            OpenGraph::setTitle($servise->name);
            OpenGraph::setUrl($url);
            OpenGraph::setSiteName($currentURL);
            $imgSize = getimagesize($servise->image_url);
            $ser_width = $imgSize[0];
            $ser_height = $imgSize[1];
            OpenGraph::addImage($servise->image_url, ['height' => $ser_width, 'width' => $ser_height]);
            OpenGraph::setDescription($description);

            $localBusiness = Schema::localBusiness()
                ->name($servise->name)
                ->email('g.prusiyski@webrika.bg')
                ->url($currentURL)
                ->logo($servise->image_url)
                ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
                ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));
        } else if($parameters === 'profile') {
            $id = \Request::segment(2);
            $profile = VendorDetail::where('id', $id)->first();
            $title = $profile->company_name;
            SEOMeta::setTitle($profile->company_name);
            SEOMeta::setDescription($profile->company_name);

            OpenGraph::setTitle($profile->company_name);
            OpenGraph::setUrl($url);
            OpenGraph::setSiteName($currentURL);
            $imgSize = getimagesize($profile->profile_image);
            $ser_width = $imgSize[0];
            $ser_height = $imgSize[1];
            OpenGraph::addImage($profile->profile_image, ['height' => $ser_width, 'width' => $ser_height]);
            OpenGraph::setDescription($profile->company_name);

            $localBusiness = Schema::localBusiness()
                ->name($profile->company_name)
                ->email('g.prusiyski@webrika.bg')
                ->url($currentURL)
                ->logo($profile->profile_image)
                ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
                ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone($profile->phone_number)->email($profile->email_address));
        } else {
            $title = 'Maistorimo';
            SEOMeta::setTitle('Maistorimo');
            SEOMeta::setDescription('Майсторимо.БГ е платформа предоставяща на своите потребители съдържание и възможност за пласиране на техните услуги');

            OpenGraph::setTitle('Майсторимо.БГ');
            OpenGraph::setUrl($url);
            OpenGraph::setSiteName($currentURL);
            OpenGraph::addImage('https://maistorimo.bg/images/main-search-background-01.webp');
            OpenGraph::setDescription('Майсторимо.БГ е платформа предоставяща на своите потребители съдържание и възможност за пласиране на техните услуги');

            $localBusiness = Schema::localBusiness()
                ->name('Maistorimo')
                ->email('g.prusiyski@webrika.bg')
                ->url('https://maistorimo.bg')
                ->logo('https://res.cloudinary.com/maistorimo/image/upload/v1571682662/5dadf96522354.jpg')
                ->address(Schema::PostalAddress()->streetAddress('19 Ruse str')->addressRegion('Pleven')->postalCode(5800)->addressCountry('Bulgaria'))
                ->contactPoint(Schema::contactPoint()->contactType('customer support')->telephone(+561 - 526 - 8457)->email('g.prusiyski@webrika.bg'));
        }
        // dd($currentURL);
        return view('vue', [
            'packages' => $this->getPackages(),
            'localBusiness' => $localBusiness,
            'title' => $title,
        ]);
    }

    public function admin()
    {
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
