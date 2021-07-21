<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model 
{
    use HasFactory;

     //referencia a una tabla
     protected $table="Sessions";
     protected $primaryKey="id";
 
     //pongo los caampos para permitir insert multiple
     protected $fillable=[ 
        "user_id",
        "ip_address",
        "user_agent",
        "payload",
        "last_activity"
    ];
}
 