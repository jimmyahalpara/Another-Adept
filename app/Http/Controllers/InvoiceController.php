<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller
{
    public function __construct()
    {   
        $this -> middleware('organization.role:manager', ['except' => ['index', 'view_pdf_admin']]);
        $this -> middleware('permission:read_invoices', ['only' => ['view_pdf_admin']]);
    }
    /**
     * Method to Delete Invoice
     */
    public function delete(Request $request)
    {
        // validate request if it contains invoice id
        $request->validate([
            'invoice_id' => 'required|numeric',
        ]);

        // get invoice id from request
        $invoice_id = $request->input('invoice_id');

        // get invoice by id
        $invoice = Invoice::find($invoice_id);

        // check if invoice state is unpaid 
        if ($invoice -> invoice_state_id != 1){
            return redirect() -> back() -> with('message', 'Invoice is not in unpaid state');
        }

        $current_user_organization_id = organization_id();
        // check if invoice belongs to current user organization
        if ($invoice -> service_order -> service -> organization_id != $current_user_organization_id){
            return redirect() -> back() -> with('message', 'Invoice does not belong to your organization');
        }

        $invoice -> delete();
        return redirect() -> back() -> with('message', 'Invoice deleted successfully', ['except' => ['index']]);
    }

    /**
     * Method to return list of invoices for current user with simplepagination and sortable
     * @return view
     */
    public function index()
    {
        $user = Auth::user();

        // Select Invoice where user_id = current user id
        $invoices = Invoice::where('user_id', $user -> id)
            -> orderBy('invoice_state_id')
            -> orderBy('due')
            -> simplePaginate(10);
        
        return view('invoice.index', compact(
            'invoices'
        ));
    }

    public function generate_pdf(Invoice $invoice)
    {

        
        $pdf = PDF::loadView('invoice.viewpdf', compact(
            'invoice',
            
        ));

        return $pdf -> download('bill.pdf');
    }

    public function view_pdf_admin(Invoice $invoice){
        $pdf = PDF::loadView('invoice.viewpdf', compact(
            'invoice',
            
        ));

        return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));
    }



    


}
