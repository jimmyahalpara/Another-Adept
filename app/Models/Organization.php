<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Organization extends Model
{
    use HasFactory;
    use Sortable;
    use SoftDeletes;

    protected $sortable = [
        'name'
    ];
    protected $fillable = [
        'name',
        'description',
        'organization_state_id'
    ];

    
    public function organization_state(){
        return $this -> belongsTo(OrganizationState::class);
    }

    public function user_organization_memberships(){
        return $this -> hasMany(UserOrganizationMembership::class);
    }

    public function images(){
        return $this -> morphMany(Image::class, 'imageable');
    }

    public function documents(){
        return $this -> morphMany(Document::class, 'documentable');
    }

    public function organization_payment_information(){
        return $this -> hasOne(OrganizationPaymentInformation::class);
    }

    public function organization_payouts(){
        return $this -> hasMany(OrganizationPayout::class);
    }
}
