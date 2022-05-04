<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganizatinRequest;
use App\Jobs\NewOrganizationRequestAcceptJob;
use App\Jobs\NewOrganizationRequestJob;
use App\Jobs\NewOrganizationRequestRejectJob;
use App\Models\Document;
use App\Models\Image;
use App\Models\Organization;
use App\Models\OrganizationPaymentInformation;
use App\Models\OrganizationPayout;
use App\Models\OrganizationRole;
use App\Models\Service;
use App\Models\User;
use App\Models\UserOrganizationMembership;
use App\Models\UserOrganizationMembershipRole;
use Illuminate\Cache\RedisStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Organization Controller is concerned with all the actions related to the organization. organizatino listing, searching,
 * creating the organization, viewing organization details, updating organization details, viewing / updating organization 
 * payment information, requesting payouts, accepting / rejecting create organization request, accept / rejecting organization 
 * request. 
 */
class OrganizationController extends Controller
{

    public function __construct()
    {
        $this->middleware('organization.role:admin', ['except' => ['create', 'store', 'active_confirmation_form', 'active_confirmation', 'payout_form', 'payout_confirm', 'index', 'details']]);
        $this->middleware('permission:edit_organizations', ['only' => ['active_confirmation', 'active_confirmation_form']]);
        $this->middleware('permission:edit_organization_payouts', ['only' => ['payout_form', 'payout_confirm']]);
    }

    /**
     * Show the form for creating a new organization.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created organization in storage.
     *
     * @param  CreateOrganizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrganizatinRequest $request)
    {

        // dd(base_path());
        $validated = $request->validated();
        $organization = Organization::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'organization_state_id' => 1
        ]);

        $organization->save();

        $user_membership = new UserOrganizationMembership();
        $user_membership->user_id = Auth::id();
        $user_membership->organization_id = $organization->id;
        $user_membership->save();

        $user_membership_role = new UserOrganizationMembershipRole();
        $user_membership_role->organization_role_id = 1;
        $user_membership_role->user_organization_membership_id = $user_membership->id;
        $user_membership_role->save();




        // save the uploaded file.
        $fileName = time() . '.' . $request->identification->extension();
        $request->identification->move(base_path() . '/private_documents/', $fileName);

        $document = new Document();
        $document->document_path = route('storage.get.document', ['filename' => $fileName]);
        $job = new NewOrganizationRequestJob(['user' => Auth::user()]);
        dispatch($job);

        $organization->documents()->save($document);
        return redirect()->home()->with('message', "Organization Created Successfully! Now you will only have to wait for it to get verified.. ");
    }

    /**
     * Display the specified organization details.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        if (organization_id() != $organization->id) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }
        return view('organizations.show', compact(
            'organization'
        ));
    }


    /**
     * Update the organization name
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateName(Request $request, Organization $organization)
    {
        if (organization_id() != $organization->id) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }

        $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
        ]);

        $organization->name = $request->name;
        $organization->save();

        return redirect()->route('organizations.show', ['organization' => $organization->id])->with('message', 'Organization Name Updated Successfully!');
    }


    /**
     * Update the organization description
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDescription(Request $request, Organization $organization)
    {
        if (organization_id() != $organization->id) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }

        $request->validate([
            'description' => ['required', 'max:1020', 'min:2'],
        ]);

        $organization->description = $request->description;
        $organization->save();


        return redirect()->route('organizations.show', ['organization' => $organization->id])->with('message', 'Organization Description Update Successfully');
    }

    /**
     * Update the organization payment information 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_organization_payment_information(Request $request, Organization $organization)
    {
        if (organization_id() != $organization->id) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }

        $payment_information = $organization->organization_payment_information;

        if ($payment_information == null) {
            $payment_information = new OrganizationPaymentInformation();
            $payment_information->organization_id = $organization->id;
        }

        $payment_information->bank_name = $request->input('bank_name', '');
        $payment_information->bank_account_number = $request->input('bank_account_number', '');
        $payment_information->ifsc = $request->input('ifsc', '');
        $payment_information->upi_id = $request->input('upi_id');

        $payment_information->save();

        return redirect()->back()->with('message', 'Payment Details Updated Successfully');
    }

    /**
     * Create new organization payout request 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function request_payout(Request $request, Organization $organization)
    {
        if (organization_id() != $organization->id) {
            return redirect()->route('home')->with('message', 'Unauthorized Action');
        }

        $payment_information = $organization->organization_payment_information;

        if ($payment_information == null) {
            return redirect()->back()->with('message', 'Please Update Payment Details');
        }

        $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
        ]);


        // check if organization wallet_balence is greater than amount
        if ($organization->wallet_balance < $request->amount) {
            return redirect()->back()->with('message', 'Insufficient Balance');
        }
        $organization_payment_request = new OrganizationPayout();
        $organization_payment_request->organization_id = $organization->id;
        $organization_payment_request->amount = $request->input('amount');
        $organization_payment_request->save();

        return redirect()->back()->with('message', 'Payment Request Submitted Successfully');
    }


    /**
     * This method is used from admin side, and will require necessary permissions, which is being checked by 
     * the middleware. This method is used to show the form to Accept or Reject the organization request. 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * 
     * it returns a view 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function active_confirmation_form(Request $request, Organization $organization)
    {
        // check if organization state id is already 2 or not 
        if ($organization->organization_state_id == 2) {
            return redirect()->back()->with('message', 'Organization Already Active');
        }

        $request->validate([
            'document_path' => 'required'
        ]);

        $document_path = $request->document_path;
        // check if current user has edit_organization permission or not 
        // $user = Auth::user();
        // if (!$user || !$user -> hasPermission('edit_organizations')){
        //     return redirect() -> back();
        // }
        return view('organizations.active_confirmation', compact(
            'organization',
            'document_path'
        ));
    }

    /**
     * This method is used from admin side and required necessary permission, which is checked by 
     * the middleare. This method takes in data from the form and updates the organization state 
     * to active or inactive depending on the data submitted. If user selects to reject the request,
     * then reason is required.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active_confirmation(Request $request, Organization $organization)
    {

        // check if organization state id is already 2 or not 
        if ($organization->organization_state_id == 2) {
            return redirect()->back()->with('message', 'Organization Already Active');
        }
        // $user = Auth::user();
        // if (!$user || !$user -> hasPermission('edit_organizations')){
        //     return redirect() -> back();
        // }

        $request->validate([
            'submit' => 'required'
        ]);

        if ($request->submit == 'accept') {
            $organization->organization_state_id = 2;
            $organization->save();

            // mailing 
            $user_organization_membership = UserOrganizationMembership::where('organization_id', $organization->id)->first();
            $job = new NewOrganizationRequestAcceptJob(['user' => $user_organization_membership->user, 'organization' => $organization]);
            dispatch($job);


            return redirect()->route('voyager.organizations.index')->with('message', 'Organization Activated Successfully');
        } else {
            $request->validate([
                'reason' => 'required'
            ]);



            $reason = $request->reason;



            // get first UserOrganizationMembership for organization id 
            $user_organization_membership = UserOrganizationMembership::where('organization_id', $organization->id)->first();


            // mailing 
            $job = new NewOrganizationRequestRejectJob(['user' => $user_organization_membership->user, 'organization' => $organization, 'reason' => $reason]);
            dispatch($job);


            // Delete from UserOrganizationMemberShipROle for user_organization_membership_id 
            $user_organization_membership_role = UserOrganizationMembershipRole::where('user_organization_membership_id', $user_organization_membership->id)->delete();

            // Delete from UserOrganizationMembership for user_organization_membership_id
            $user_organization_membership->delete();

            // Delete ORganization 
            $organization->delete();

            return redirect()->route('voyager.organizations.index')->with('message', 'Organization Deleted Successfully');
        }
    }

    /**
     * Shows Organization Payout accept or reject form 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payout_form(OrganizationPayout $payout)
    {
        // check if payout status is already 1 or not
        if ($payout->status == 1) {
            return redirect()->back()->with('message', 'Payout Already Accepted');
        }

        if ($payout->status == 2) {
            return redirect()->back()->with('message', 'Payout Already Rejected');
        }

        return view('organizations.payout_confirmation', compact(
            'payout'
        ));
    }

    /**
     * Data from the payout request form is submitted to this method. This method will update the organization 
     * payout request according to the data submitted. If option to reject the request is selected, then 
     * a reason for the rejection is required. 
     */
    public function payout_confirm(Request $request, OrganizationPayout $payout)
    {
        // check if payout status is already 1 or not
        if ($payout->status == 1) {
            return redirect()->back()->with('message', 'Payout Already Accepted');
        }

        if ($payout->status == 2) {
            return redirect()->back()->with('message', 'Payout Already Rejected');
        }
        $request->validate([
            'submit' => 'required'
        ]);


        if ($request->submit == 'accept') {
            $payout->status = 1;
            $payout->save();


            // deduct amount from organization wallet balance
            $organization = $payout->organization;
            $organization->wallet_balance = $organization->wallet_balance - $payout->amount;
            $organization->save();

            return redirect()->route('voyager.organization-payouts.index')->with('message', 'Payout Accepted Successfully');
        } else {
            $request->validate([
                'reason' => 'required'
            ]);

            $payout->status = 2;
            $payout->save();

            return redirect()->route('voyager.organization-payouts.index')->with('message', 'Payout request deleted.');
        }
    }


    /**
     * Method to view all the organization list. This method is called when user clicks 
     * organization link on the navbar
     */
    public function index(Request $request)
    {
        $organizations  = Organization::get();


        return view('organizations.index', compact(
            'organizations'
        ));
    }

    /**
     * View organization details, such has name, description, admin address / contact, and 
     * services provided by the organization. This page is opened when user clicks on the organization 
     * in organization listing. 
     */
    public function details(Request $request, Organization $organization)
    {
        $organization_admins = UserOrganizationMembership::with('user')->where('organization_id', $organization->id)->get();
        $services = Service::where('organization_id', $organization->id)->take(20)->get();
        $service_stat = null;

        // dd($organization_admins);
        return view('organizations.details', compact(
            'organization',
            'organization_admins',
            'services'
        ));
    }
}
