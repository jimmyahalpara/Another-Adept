<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function invoice_state()
    {
        return $this -> belongsTo(InvoiceState::class);
    }

    public function service_order()
    {
        return $this -> belongsTo(ServiceOrder::class);
    }

    // hasMany relation to Payment
    public function payments()
    {
        return $this -> hasMany(Payment::class);
    }

    
}
