<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    public function price_type(){
        return $this -> belongsTo(PriceType::class);
    }

    public function area(){
        return $this -> belongsTo(Area::class);
    }

    public function organization(){
        return $this -> belongsTo(Organization::class);
    }
}
