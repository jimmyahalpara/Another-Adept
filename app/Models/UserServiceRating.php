<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class UserServiceRating extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = [
        'updated_at',
        'rating',
        'id'
    ];

    protected $fillable = [
        'user_id',
        'service_id'
    ];
    public function service()
    {
        return $this -> belongsTo(Service::class);
    }

    public function user(){
        return $this -> belongsTo(User::class);
    }   
}
