<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserServiceLike extends Model
{
    use HasFactory;


    protected $softDelete = true;


    public function service()
    {
        return $this -> belongsTo(Service::class);
    }

    public function user(){
        return $this -> belongsTo(User::class);
    }
}
