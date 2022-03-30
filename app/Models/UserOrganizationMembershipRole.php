<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganizationMembershipRole extends Model
{
    use HasFactory;


    function organization_role(){
        return $this -> belongsTo(OrganizationRole::class, 'organization_role_id');
    }

    function user_organization_membership(){
        return $this -> belongsTo(UserOrganizationMembership::class);
    }
}
