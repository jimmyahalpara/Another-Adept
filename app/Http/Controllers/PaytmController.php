<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Anand\LaravelPaytmWallet\Facades\PaytmWallet;

class PaytmController extends Controller
{

    public function pay(Request $request, Invoice $invoice)
    {
        // check if invoice is paid
        // dd(env('PAYTM_MERCHANT_KEY'));
        if ($invoice->invoice_state_id == 2) {
            return redirect()->back()->with('message', 'Invoice is already paid');
        }

        // check if user_id in invoice matches current user
        if ($invoice->user_id != Auth::id()) {
            return redirect()->back()->with('message', 'You are not authorized to pay this invoice');
        }

        $amount = $invoice->amount;
        $order_id = $invoice->id . '_' . time();
        $invoice_id = $invoice->id;
        $user_id = Auth::id();
        $email = Auth::user()->email;
        $mobile = Auth::user()->phone_number;
        $callback_url = route('paytm.callback');

        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->invoice_id = $invoice_id;
        $payment->order_id = $order_id;
        $payment->amount = $amount;
        $payment->payment_method = 'Paytm';
        $payment->status = 0;
        $payment->save();


        // dd()

        // dd($order_id, $payment -> id, $email, $mobile, (float)$amount, $callback_url);
        $pmt = PaytmWallet::with('receive');
        $pmt->prepare([
            'order' => $order_id,
            'user' => $payment->id,
            'mobile_number' => $mobile,
            'email' => $email, // your user email address
            'amount' => (float)$amount, // amount will be paid in INR.
            'callback_url' => $callback_url // callback URL
        ]);

        return $pmt->receive();
    }

    function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();

        // dd($response);


        $transaction->getTransactionId(); // return a transaction id

        // update the db data as per result from api call
        if ($transaction->isSuccessful()) {

            $order_id = $response['ORDERID'];
            $payment = Payment::where('order_id', $order_id)->first();
            $payment->transaction_id = $response['TXNID'];
            $payment->status = 1;
            $payment->save();

            $invoice = Invoice::find($payment->invoice_id);
            $invoice->invoice_state_id = 2;
            $invoice->save();

            // add amount to organization wallet_balance
            $organization = $invoice->service_order->service->organization;
            $organization->wallet_balance += $invoice->amount;
            $organization->save();

            return redirect()->route('invoice.index')->with('message', 'Payment Successful');
        } else if ($transaction->isFailed()) {
            return redirect()->route('invoice.index')->with('message', $response['RESPMSG']);
        } else if ($transaction->isOpen()) {
            return redirect()->route('invoice.index')->with('message', $response['RESPMSG']);
        }
        $transaction->getResponseMessage(); //Get Response Message If Available


        return redirect()->route('invoice.index')->with('message', $response['RESPMSG']);
    }
}
