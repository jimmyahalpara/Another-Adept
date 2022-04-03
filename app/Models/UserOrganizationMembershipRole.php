<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOrganizationMembershipRole extends Model
{
    use HasFactory;
    use SoftDeletes;


    function organization_role(){
        return $this -> belongsTo(OrganizationRole::class, 'organization_role_id');
    }

    function user_organization_membership(){
        return $this -> belongsTo(UserOrganizationMembership::class);
    }
}
