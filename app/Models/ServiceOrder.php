<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ServiceOrder extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function service(){
        return $this -> belongsTo(Service::class);
    }

    public function order_state(){
        return $this -> belongsTo(OrderState::class);
    }
}
