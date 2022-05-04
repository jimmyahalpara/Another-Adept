<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\Area;
use App\Models\City;
use App\Models\OrganizationRole;
use App\Models\User;
use App\Models\UserOrganizationMembership;
use App\Models\UserOrganizationMembershipRole;
use App\Models\UserState;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Methods in this controller is concerned with creation, updating and deletion of all the 
 * members on any organizatoin. All these action can only be performed by the admin of the
 * organizatoin
 */
class MemberController extends Controller
{

    /**
     * ALl the requests should be performed by the admin of the organization
     * 
     * @return void
     */
    public function __construct()
    {
        $this -> middleware('organization.role:admin');
    }


    /**
     * This method check if the user who performs the action has same organiztion id as 
     * the member he wants to do the action. Basically, this method prevents any admin from 
     * one organization to make changes to the members of another organization.
     * 
     * @param  User $member
     * 
     * @return boolean
     */
    private function checkOrganization(User $member)
    {
        $member_organization = $member->get_organization();
        if (!$member_organization) {
            return false;
        }
        $current_user_organization_id = organization_id();

        if ($member_organization->id != $current_user_organization_id) {
            return false;
        }

        return true;
    }
    /**
     * Display a listing of the all members.
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num_rows = $request->input('num_rows', 10);
        // $services = User::where('organization_id', organization_id())->sortable('id')->paginate($num_rows)->withQueryString();
        $current_organization_id = organization_id(true);

        $members = UserOrganizationMembership::with('user')->where('organization_id', $current_organization_id)->sortable('user.id')->paginate($num_rows)->withQueryString();
        return view('members.index', compact(
            'members',
            'num_rows',
        ));
    }

    /**
     * Show the form for creating a new member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = City::select('state') -> distinct() -> orderBy('state') -> get();
        
        $organization_roles = OrganizationRole::orderBy('id', 'DESC')->get();
        return view('members.create', compact(
            'states',
            'organization_roles'
        ));
    }

    /**
     * Store a newly created member in storage.
     *
     * @param  UserRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        // dd($request -> all());

        $current_organization_id = organization_id();


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->area_id = $request->area_id;
        $user->user_state_id = 1;
        $user->save();

        event(new Registered($user));


        $organization_membersip = new UserOrganizationMembership();
        $organization_membersip->user_id = $user->id;
        $organization_membersip->organization_id = $current_organization_id;
        $organization_membersip->save();

        $role_id = $request->input('role', '3');
        if (empty($role_id)) {
            $role_id = '3';
        }

        $membersip_role = new UserOrganizationMembershipRole();
        $membersip_role->organization_role_id = $role_id;
        $membersip_role->user_organization_membership_id = $organization_membersip->id;
        $membersip_role->save();


        return redirect()->route('members.index')->with('message', 'Member added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }
        $states = City::select('state') -> distinct() -> orderBy('state') -> get();
        $cities = City::where('id', $member -> area -> city -> id) -> orderBy('name') -> get();
        $areas = Area::where('city_id' , $member -> area -> city -> id) -> orderBy('name') -> get();
        $user_states = UserState::get();
        return view('members.show', compact(
            'member',
            'cities',
            'states',
            'user_states',
            'areas'
        ));
    }


    /**
     * Remove the specified member from storage.
     *
     * @param  \App\Models\User  $user
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }

        $current_user = Auth::user();
        if ($current_user->id == $member->id) {
            return redirect()->route('members.index')->with('message', 'You Cannot Delete Yourself');
        }

        $member -> delete();
        return redirect() -> route('members.index') -> with('message', $member -> name . ' deleted Successfully.');
    }

    /**
     * Update name of the user
     * 
     * @param  Request $request
     * @param  \App\Models\User  $user
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateName(Request $request, User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $member->name = $request->name;
        $member->save();

        return redirect()->route('members.show', ['member' => $member->id])->with('message', 'Name Updated Successfully');
    }


    /**
     * Update Phone number of the user
     * 
     * @param  Request $request
     * @param  \App\Models\User  $member
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePhone(Request $request, User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }
        $request->validate([
            'phone_number' => ['required', 'digits_between:10,13'],
        ]);

        $member->phone_number = $request->phone_number;
        $member->save();

        return redirect()->route('members.show', ['member' => $member->id])->with('message', 'Phone Number Updated Successfully');
    }

    /**
     * Update address of the user
     * 
     * @param  Request $request
     * @param  \App\Models\User  $member
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAddress(Request $request, User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }
        $request->validate([
            'address' => ['required', 'min:5', 'max:512'],
        ]);

        $member->address = $request->address;
        $member->save();

        return redirect()->route('members.show', ['member' => $member->id])->with('message', 'Address Updated Successfully');
    }

    /**
     * Update area of the user 
     * 
     * @param  Request $request
     * @param  \App\Models\User  $member
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateArea(Request $request, User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }
        $request->validate([
            'area_id' => ['required'],
        ]);

        $member->area_id = $request->area_id;
        $member->save();

        return redirect()->route('members.show', ['member' => $member->id])->with('message', 'Area Updated Successfully');
    }

    /**
     * Update state of the user
     * 
     * @param  Request $request
     * @param  \App\Models\User  $member
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserState(Request $request, User $member)
    {
        $current_user = Auth::user();
        if ($current_user->id == $member->id) {
            return redirect()->route('members.show', ['member' => $member->id])->with('message', 'You Cannot Change Your Own State');
        }
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }
        $request->validate([
            'state_id' => ['required', 'numeric'],
        ]);

        $member->user_state_id = $request->state_id;
        $member->save();

        return redirect()->route('members.show', ['member' => $member->id])->with('message', 'User State Updated Successfully');
    }


    public function promoteMember(Request $request, User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }


        $current_user = Auth::user();

        if ($current_user->id == $member->id) {
            return redirect()->route('members.index')->with('message', 'You Cannot Promote Yourself');
        }

        $member_role = $member->user_role();
        if ($member_role->id <= 1) {
            return redirect()->route('members.index')->with('message', $member->name .  ' is already an Admin');
        }

        $membership_id = $member->user_organization_memberships->first()->id;

        $membership_role = UserOrganizationMembershipRole::where('user_organization_membership_id', $membership_id)->first();

        $membership_role->organization_role_id -= 1;
        $membership_role->save();

        return redirect()->route('members.index')->with('message', $member->name .  ' promoted to ' . $membership_role->organization_role->name);
    }

    public function demoteMember(Request $request, User $member)
    {
        if (!$this->checkOrganization($member)) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }

        $current_user = Auth::user();
        if ($current_user->id == $member->id) {
            return redirect()->route('members.index')->with('message', 'You Cannot Demote Yourself');
        }

        $member_role = $member->user_role();
        if ($member_role->id >= 3) {
            return redirect()->route('members.index')->with('message', $member->name .  ' is already a Provider');
        }

        $membership_id = $member->user_organization_memberships->first()->id;

        $membership_role = UserOrganizationMembershipRole::where('user_organization_membership_id', $membership_id)->first();

        $membership_role->organization_role_id += 1;
        $membership_role->save();


        return redirect()->route('members.index')->with('message', $member->name .  ' demoted to ' . $membership_role->organization_role->name);
    }
}
