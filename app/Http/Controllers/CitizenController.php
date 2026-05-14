<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandRecord;
use App\Models\PropertyTax;
use App\Models\Payment;
use App\Models\LandTransferRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CitizenController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Fetch real data counts
        $properties_count = LandRecord::where('owner_id', $user->id)->count();
        $pending_tax = PropertyTax::whereHas('landRecord', function($query) use ($user) {
            $query->where('owner_id', $user->id);
        })->where('status', 'pending')->sum('total_amount');
        
        $next_due_date = PropertyTax::whereHas('landRecord', function($query) use ($user) {
            $query->where('owner_id', $user->id);
        })->where('status', 'pending')->orderBy('due_date', 'asc')->value('due_date');

        // Dummy recent activities for now
        $recent_activities = []; 

        return view('citizen.dashboard', compact('properties_count', 'pending_tax', 'next_due_date', 'recent_activities'));
    }

    public function landRecords()
    {
        $user = Auth::user();
        $records = LandRecord::where('owner_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('citizen.land-records.index', compact('records'));
    }

    public function showLandRecord($id)
    {
        $user = Auth::user();
        $record = LandRecord::where('owner_id', $user->id)->findOrFail($id);
        
        return view('citizen.land-records.show', compact('record'));
    }

    public function showTaxPayment($id)
    {
        $user = Auth::user();
        $tax = PropertyTax::whereHas('landRecord', function($q) use ($user) {
            $q->where('owner_id', $user->id);
        })->findOrFail($id);

        $payments = Payment::where('property_tax_id', $tax->id)->latest()->get();

        return view('citizen.tax.payment', compact('tax', 'payments'));
    }

    public function processTaxPayment(Request $request, $id)
    {
        $user = Auth::user();
        $tax = PropertyTax::whereHas('landRecord', function($q) use ($user) {
            $q->where('owner_id', $user->id);
        })->findOrFail($id);

        if ($tax->status === 'paid') {
            return redirect()->back()->with('error', 'Tax is already paid.');
        }

        // Dummy processing logic
        $payment = Payment::create([
            'property_tax_id' => $tax->id,
            'citizen_id' => $user->id,
            'amount_paid' => $tax->total_amount,
            'payment_method' => 'online',
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
            'payment_date' => now(),
            'receipt_number' => 'RCPT-' . strtoupper(uniqid()),
            'status' => 'success',
        ]);

        $tax->update(['status' => 'paid']);

        return redirect()->route('citizen.tax.receipt', $payment->id)->with('success', 'Payment successful.');
    }

    public function downloadReceipt($id)
    {
        $user = Auth::user();
        $payment = Payment::where('citizen_id', $user->id)->findOrFail($id);
        
        return view('citizen.tax.receipt', compact('payment'));
    }

    public function payments()
    {
        $user = Auth::user();
        $payments = Payment::where('citizen_id', $user->id)
            ->with('propertyTax.landRecord')
            ->latest()
            ->get();
            
        return view('citizen.payments', compact('payments'));
    }

    public function createTransferRequest($id)
    {
        $user = Auth::user();
        $record = LandRecord::where('owner_id', $user->id)->findOrFail($id);
        
        return view('citizen.land-records.transfer', compact('record'));
    }

    public function storeTransferRequest(Request $request, $id)
    {
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'buyer_cnic' => 'required|string|max:20',
            'buyer_email' => 'required|email|max:255',
            'transfer_reason' => 'required|string',
            'transfer_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $user = Auth::user();
        $record = LandRecord::where('owner_id', $user->id)->findOrFail($id);

        // Find or create a dummy user for the transferee so the foreign key constraint passes
        $transferee = User::firstOrCreate(
            ['email' => $request->buyer_email],
            [
                'name' => $request->buyer_name,
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'citizen',
                'phone' => '0000000000',
                'address' => 'Pending Address'
            ]
        );

        $documentPath = $request->file('transfer_document')->store('transfers', 'public');

        LandTransferRequest::create([
            'land_record_id' => $record->id,
            'from_owner_id' => $user->id,
            'to_owner_id' => $transferee->id,
            'status' => 'pending',
            'remarks' => $request->transfer_reason . ' (CNIC: ' . $request->buyer_cnic . ')',
            'document_path' => $documentPath,
        ]);

        return redirect()->route('citizen.land-records.show', $record->id)
            ->with('success', 'Land transfer application submitted successfully.');
    }
}
