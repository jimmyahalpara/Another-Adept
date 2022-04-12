<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationPayout extends Model
{
    use HasFactory;


    protected $fillable = [
        'organization_id',
        'amount',
        'status'
    ];


    public function organization()
    {
        return $this -> belongsTo(Organization::class);
    }

}
