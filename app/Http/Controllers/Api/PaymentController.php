<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // List all payments
    public function index()
    {
        $payments = Payment::with(['appointment', 'patient', 'doctor', 'clinic'])->get();
        return response()->json($payments);
    }

    // Store new payment
    public function store(Request $request)
    {
        $data = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'patient_id'     => 'required|exists:patients,id',
            'doctor_id'      => 'required|exists:doctors,id',
            'clinic_id'      => 'required|exists:clinics,id',
            'amount'         => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,razorpay,upi,insurance',
            'status'         => 'nullable|in:paid,pending,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $payment = Payment::create($data);

        return response()->json([
            'message' => 'Payment recorded successfully',
            'payment' => $payment
        ], 201);
    }

    // Show single payment
    public function show(Payment $payment)
    {
        $payment->load(['appointment', 'patient', 'doctor', 'clinic']);
        return response()->json($payment);
    }

    // Update payment
    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'appointment_id' => 'sometimes|required|exists:appointments,id',
            'patient_id'     => 'sometimes|required|exists:patients,id',
            'doctor_id'      => 'sometimes|required|exists:doctors,id',
            'clinic_id'      => 'sometimes|required|exists:clinics,id',
            'amount'         => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|in:cash,card,razorpay,upi,insurance',
            'status'         => 'nullable|in:paid,pending,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $payment->update($data);

        return response()->json([
            'message' => 'Payment updated successfully',
            'payment' => $payment
        ]);
    }

    // Delete payment
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json([
            'message' => 'Payment deleted successfully'
        ]);
    }
}
