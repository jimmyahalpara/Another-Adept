<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServiceLike extends Model
{
    use HasFactory;


    public function service()
    {
        $this -> belongsTo(Service::class);
    }

    public function user(){
        $this -> belongsTo(User::class);
    }
}
