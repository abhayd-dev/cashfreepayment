<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class CashfreePaymentController extends Controller
{
    public function create(Request $request)
    {
        return view('payment-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'mobile' => 'required',
            'amount' => 'required'
        ]);
 
        $order_id = 'order_' . rand(1111111111, 9999999999);
        $payment_id = 'payment_' . uniqid(); 
    
        $payment = Payment::create([
            'payment_id' => $payment_id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'amount' => $validated['amount'],
            'order_id' => $order_id,
        ]);
       


        $url = "https://sandbox.cashfree.com/pg/orders";
        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_API_KEY'),
            "x-client-secret: " . env('CASHFREE_API_SECRET')
        ];
        $data = json_encode([
            'order_id' => $order_id,
            'order_amount' => $payment->amount,
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => 'customer_' . rand(111111111, 999999999),
                "customer_name" => $payment->name,
                "customer_email" => $payment->email,
                "customer_phone" => $payment->mobile,
            ],
            "order_meta" => [
                "return_url" => route('cashfree.success', ['order_id' => $order_id, 'order_token' => ''])
            ],
            "payment_methods" => "upi" 
        ]);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $resp = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($resp);
        return redirect()->to($response->payment_link);
        if ($this->isPaymentSuccessful($payment)) {
            $paymentData['payment_id'] = 'payment_' . uniqid(); 
    
 
            $payment = Payment::create($payment);
        } else {
            
            return view('payment-failure');
        }
    }

    public function success(Request $request)
    {
        $order_id = $request->order_id;
    
       
        $payment = Payment::where('order_id', $order_id)->first();
    
 
        if ($payment) {
        
            $payment->update([
                'status' => 'success',
               
            ]);
    
            return view('payment-success', compact('payment'));
        } else {
         
            abort(404); 
        }
    }
    
    public function failure(Request $request)
    {
        $order_id = $request->order_id;
    
   
        $payment = Payment::where('order_id', $order_id)->first();

        if ($payment) {
         
            $payment->update([
                'status' => 'failure',
              
            ]);
    
            return view('payment-failure', compact('payment'));
        } else {
         
            abort(404); 
        }
    }
    

    public function showTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('payments.table');
    }
}
