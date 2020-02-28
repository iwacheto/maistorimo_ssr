<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Project;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailForm;
use GuzzleHttp\Client;
use Zttp\Zttp;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use App\User;

class BrowseController extends Controller
{

    public function browse(Request $request)
    {
        $projects = Project::with([
            'projectGalleries',
        ])->get();

        foreach ($projects as &$project) {
            $project['mainImage'] = $project['ProjectMainImage']['url'];
        }

        return $projects;
    }

    public function setContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'msg' => 'required',
            'token' => 'required',
        ]);
        $data = $request->all();
        $token = $data['token'];
        $email = 'iwacheto@abv.bg';
        
        if ($token) {
            $response = Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => '6Lc9f8kUAAAAAGk56Km6EWWPTfZ7ri7Hjng9OBi2',
                'response' => $token,

            ]);

            if (!$response->json()['success']) {
                return 'Изпращането е неуспешно!';
            } else {
                Mail::to($email)->send(new OrderShipped($data));
                return "Съобщението беше изпратено успешно!";
            }
        }
    }

    // Queue Emails
    public function setQueueContact(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'msg' => 'required',
            'token' => 'required',
        ]);

        $data = $request->all();
        $token = $data['token'];
        $email = 'iwacheto@abv.bg';
        
        if ($token) {
            $response = Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => '6Lc9f8kUAAAAAGk56Km6EWWPTfZ7ri7Hjng9OBi2',
                'response' => $token,

            ]);

            if (!$response->json()['success']) {
                return 'Изпращането е неуспешно!';
            } else {
                SendEmailJob::dispatch($data,$email)->delay(Carbon::now()->addSeconds(1));
                return "Съобщението беше изпратено успешно!";
            }
        }
    }

    public function setSession(Request $request)
    {
       $request->session()->put('name', 'maistorimo');
       return 'Session set';
    }

    public function checkUsername(Request $request){
        $name=$request->validate([
            'username'=>'required|string|min:5|max:50'
        ]);
        $row=User::where('name', $name)->get();
        if(count($row)>=1){
            return 'Съжаляваме,но потрбителското име вече е заето!';
        } 
    }

    public function checkEmail(Request $request){
        $email=$request->validate([
            'email'=>'required|email|min:6|max:150'
        ]);
        $row=User::where('email', $email)->get();
        if(count($row)>=1){
            return 'Съжаляваме,но имейла вече е зает!';
        } 
    }
}
