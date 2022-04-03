<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class PriceType extends Model
{
    use HasFactory;
    use Sortable;


    public $sortable = [
        'name'
    ];


    public function services()
    {
        return $this -> hasMany(Service::class);
    }

    
}
