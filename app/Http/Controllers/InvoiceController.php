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
        $this -> middleware('organization.role:manager', ['except' => ['index', 'view_pdf_admin', 'generate_pdf']]);
        $this -> middleware('permission:read_invoices', ['only' => ['view_pdf_admin']]);
    }
    /**
     * Method to Delete Invoice. Only organization managers, or admins can delete invoices
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
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
     * Method to return list of invoices for current user with simplepagination.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Select Invoice where user_id = current user id
        $invoices = Invoice::where('user_id', $user -> id)
            -> orderBy('invoice_state_id')
            -> orderBy('created_at', 'desc')
            -> simplePaginate(10);
        
        return view('invoice.index', compact(
            'invoices'
        ));
    }


    /**
     * Method to download a pdf for an invoice, which has all the information about the invoice, and all the transaction
     * history for that invoice. This method can be accessed by anyone who is logged in. 
     * 
     * @param Invoice $invoice
     * 
     * @return \Illuminate\Http\Response
     */
    public function generate_pdf(Invoice $invoice)
    {

        if ($invoice -> user_id != Auth::id()){
            return redirect() -> back() -> with('message', 'You are not authorized to view this invoice');
        }
        
        $pdf = PDF::loadView('invoice.viewpdf', compact(
            'invoice',
            
        ));

        return $pdf -> download('bill.pdf');
    }

    /**
     * Method to viwe pdf of any invoice from admin side. This method can be accessed by anyone who has permission to read invoice
     * in our company. 
     * 
     * @param Invoice $invoice
     * 
     * @return \Illuminate\Http\Response
     */
    public function view_pdf_admin(Invoice $invoice){
        $pdf = PDF::loadView('invoice.viewpdf', compact(
            'invoice',
            
        ));

        return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));
    }



    


}
