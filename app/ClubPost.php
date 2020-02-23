<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClubPost extends Model
{
    //
    protected $fillable = [
        'imagePath', 'text', 'club_id'
    ];
}
