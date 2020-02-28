<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model {
    //
    protected $table = 'invites';

    protected $guarded = ['id'];
    protected $hidden = ["created_at", "updated_at"];

    protected $fillable = ['email', 'phone', 'reason'];

}
