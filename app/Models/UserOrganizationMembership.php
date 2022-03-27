<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganizationMembership extends Model
{
    use HasFactory;


    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function organization(){
        return $this -> belongsTo(Organization::class);
    }

    public function organization_roles(){
        return $this -> belongsToMany(OrganizationRole::class, 'user_organization_membership_roles');
    }

    
}
