<?php

use App\Models\OrganizationRole;
use Illuminate\Support\Facades\Auth;

/**
 * Check if current user has any relationtionp with 
 * UserOrganizationMembership.
 * That is if user is member of any organization
 * 
 * also checks if their organization is active
 */
function is_user_organization_member($checkInavtive = false)
{
    $user = Auth::user();
    // dd($user -> user_organization_memberships() == true);
    if (!$user){
        return false;
    }

    $mem =  $user -> user_organization_memberships -> first();
    
    if (!$mem){
        return false;
    }

    if ($checkInavtive && $mem -> organization -> organization_state_id == 1){
        return false;
    }
    if ($user) {
        if ($user->user_organization_memberships()) {
            return true;
        } else {
            return false;
        }
    } else {
        false;
    }
}

function organization_role($slug)
{

    $role_id =  OrganizationRole::select('id')->where('slug', $slug)->first()->id;
    $user  = Auth::user();
    if (!$user){
        return false;
    }
    $mem =  $user -> user_organization_memberships -> first();
    if (!$mem){
        return false;
    }

    if ($mem -> organization -> organization_state_id == 1){
        return false;
    }
    $user_role_id = Auth::user()->user_organization_memberships[0]->organization_roles[0]->id;
    return $user_role_id <= $role_id;
}


function organization_inactive(){
    if (Auth::guest()){
        return false;
    }
    return  Auth::user() -> user_organization_memberships[0] -> organization -> organization_state_id == 1;
}
