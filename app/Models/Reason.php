<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Reason extends Model
{
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    public function reasonable()
    {
        return $this -> morphTo();
    }

    public function order_state()
    {
        return $this -> belongsTo(OrderState::class);
    }
}
