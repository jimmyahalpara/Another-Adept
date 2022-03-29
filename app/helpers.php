<?php

use App\Models\OrganizationRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/**
 * Check if current user has any relationtionp with 
 * UserOrganizationMembership.
 * That is if user is member of any organization
 * 
 * also checks if their organization is active
 * 
 * @param bool $checkInactive - if true, then it returns false even if user is member of an organization, which is 
 * not active
 */
function is_user_organization_member($checkInavtive = false)
{
    $user = Auth::user();
    if (!$user) {
        return false;
    }

    $mem =  $user->user_organization_memberships->first();

    if (!$mem) {
        return false;
    }

    if ($checkInavtive && $mem->organization->organization_state_id == 1) {
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


/**
 * Organization roles check if the user has the permission, same or greator than what is 
 * specified by the slug 
 * 
 * @param string $slug 
 * 
 * @return boolean 
 */
function organization_role($slug)
{

    $role_id =  OrganizationRole::select('id')->where('slug', $slug)->first()->id;
    $user  = Auth::user();
    if (!$user) {
        return false;
    }
    $mem =  $user->user_organization_memberships->first();
    if (!$mem) {
        return false;
    }

    if ($mem->organization->organization_state_id == 1) {
        return false;
    }
    $user_role_id = Auth::user()->user_organization_memberships[0]->organization_roles[0]->id;
    return $user_role_id <= $role_id;
}

/**
 * function to check if users organization is inactive or not. 
 * If user is not part of any organization then false is returned 
 * 
 * @return boolean
 */
function organization_inactive()
{
    if (Auth::guest()) {
        return true;
    }

    $mem = Auth::user()->user_organization_memberships;
    if (!$mem) {
        return true;
    }


    $org = $mem[0]->organization;
    if (!$org) {
        return true;
    }


    return  $org->organization_state_id == 1;
}



/**
 * Get organization id of current user
 */
function organization_id($validation = false)
{
    if ($validation){
        if (Auth::guest()) {
            return false;
        }
    
        $mem = Auth::user()->user_organization_memberships;
        if (!$mem) {
            return true;
        }
    
        return $mem[0]->organization_id;
    } else {
        return Auth::user()->user_organization_memberships[0] -> organization_id;
    }
}


/**
 * -------------------------------------------------------------
 * -------------------------------------------------------------
 */
