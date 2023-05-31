<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Enrollment;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function index()
    {
        return PaymentResource::collection(Payment::all());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $enrollment = Enrollment::findOrFail($input['enrollment_id']);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                Payment::create([
                    'payment_gateway_id' => $response['id'],
                    'gateway' => 'razorpay',
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $response['amount'] / 100,
                    'json_response' => json_encode((array)$response),
                    'enrollment_id' => $enrollment->id,
                ]);
                $response['res_type'] = 'success';
                $enrollment->update([
                    'status' => 'paid',
                    'description' => 'Enrolled',
                    'payment_method' => $response['method'],
                ]);
                return response()->json($response);
            } catch (Exception $e) {
                $enrollment->update([
                    'status' => 'failed',
                    'description' => 'Payment Failed',
                ]);
                return response()->json(array('res_type' => 'error', 'message' => $e->getMessage()));
            }
        }
    }
}
