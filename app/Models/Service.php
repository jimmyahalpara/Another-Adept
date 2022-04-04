<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

    public $sortable = [
        'id',
        'name',
        'price',
        'created_at',
        'updated_at'
    ];



    public function price_type(){
        return $this -> belongsTo(PriceType::class);
    }

    public function organization(){
        return $this -> belongsTo(Organization::class);
    }

    public function images(){
        return $this -> morphMany(Image::class, 'imageable');
    }

    public function service_category(){
        return $this -> belongsTo(ServiceCategory::class);
    }

    public function areas(){
        return $this -> belongsToMany(Area::class, 'service_area_availablities');
    }



    public function user_service_ratings(){
        return $this -> hasMany(UserServiceRating::class);
    }

    public function user_service_ratings_stat(){
        return $this -> user_service_ratings() -> selectRaw('avg(rating) as average, count(rating) as count') -> groupBy('service_id') -> having('service_id', $this -> id) -> first();
    }

    public function users(){
        return $this -> belongsToMany(User::class, 'user_service_likes');
    }

    public function areas_count(){
        return $this -> belongsToMany(Area::class, 'service_area_availablities') -> count();
    }

    public function service_orders(){
        return $this -> hasMany(ServiceOrder::class);
    }
}
