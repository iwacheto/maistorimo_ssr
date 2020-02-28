<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use Illuminate\Http\Request;

class InviteController extends Controller
{

    public function addInviteRequest(Request $request) {
        $data = $request->all();
        $invite = new Invite();
        $invite->email = $data['email'];
        $invite->phone = $data['phone'];
        $invite->reason = $data['reason'];
        $invite->save();
    }

}
