<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{

    const CREATED_AT = "event_date";
    const UPDATED_AT = null;
    
    protected $table = "logs";

    protected $fillable = [
        'email',
        'user_agent',
        'ip',
    ];

    protected $dates = [
        'event_date',
    ];

}
