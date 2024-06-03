<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exchange;
use Illuminate\Support\Facades\Auth;
use App\Models\Goods;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'requested_by' => 'required|integer',
            'goods_owner_ID' => 'required|integer',
            'my_goods' => 'required|integer',
            'barter_with' => 'required|integer',
            'status' => 'required|string',
        ]);

        // Create a new exchange record
        $exchange = Exchange::create($validatedData);

        if ($exchange) {
            return response()->json(['message' => 'Exchange created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create exchange'], 500);
        }
    }

    public function confirmExchange($exchangeId)
    {
        $exchange = Exchange::find($exchangeId);
        if ($exchange && $exchange->goods_owner_ID == Auth::id()) {
            $exchange->status = 'Accepted';
            $exchange->save();
            return response()->json(['message' => 'Exchange accepted']);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function rejectExchange($exchangeId)
    {
        $exchange = Exchange::find($exchangeId);
        if ($exchange && $exchange->goods_owner_ID == Auth::id()) {
            $exchange->status = 'Rejected';
            $exchange->save();
            return response()->json(['message' => 'Exchange rejected']);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function updateStatus(Request $request, Exchange $exchange)
    {
        $request->validate([
            'status' => 'nullable|string',
            'meet_up_at' => 'nullable|date',
            'exchanged_at' => 'nullable|date',
            'reason_reject' => 'nullable|string',
            'meeting_agree' => 'nullable|string',
        ]);

        if ($request->meeting_agree === 'Offline') {
            $exchange->status = 'Accepted';
            $exchange->meeting_agree = 'Offline';
        }
        
        if ($request->meeting_agree === 'Online') {
            if ($request->status === 'Shipping') {
                $exchange->status = 'Shipping';
                $exchange->meeting_agree = 'Online';
            }
            elseif ($request->status === 'Completed') {
                $exchange->status = 'Completed';
                $exchange->confirmed_at = now();
                $exchange->meet_up_at = $request->meet_up_at;
                $exchange->exchanged_at = $request->exchanged_at;
                $exchange->reason_reject = null;
                $exchange->meeting_agree = 'Online';
            } elseif ($request->status === 'Rejected') {
                $exchange->status = 'Rejected';
                $exchange->confirmed_at = now();
                $exchange->meet_up_at = $request->meet_up_at;
                $exchange->exchanged_at = $request->exchanged_at;
                $exchange->reason_reject = $request->reason_reject;
                $exchange->meeting_agree = 'Online';
            } else {
                $exchange->status = 'Accepted';
                $exchange->meeting_agree = 'Online';
            }
        }

        if ($request->status === 'Completed') {
            $exchange->status = 'Completed';
            $exchange->confirmed_at = now();
            $exchange->meet_up_at = $request->meet_up_at;
            $exchange->exchanged_at = $request->exchanged_at;
            $exchange->reason_reject = null;
            $exchange->meeting_agree = 'Offline';
        } elseif ($request->status === 'Rejected') {
            $exchange->status = 'Rejected';
            $exchange->confirmed_at = now();
            $exchange->meet_up_at = $request->meet_up_at;
            $exchange->exchanged_at = $request->exchanged_at;
            $exchange->reason_reject = $request->reason_reject;
            $exchange->meeting_agree = $request->meeting_agree;
        } elseif ($request->status === 'Goods Received') {
            $exchange->status = 'Goods Received';
            $exchange->meeting_agree = 'Offline';
        } elseif ($request->status === 'Canceled Meeting') {
            $exchange->status = 'Canceled Meeting';
            $exchange->meeting_agree = 'Offline';
        } elseif ($request->status === 'Rejected') {
            $exchange->status = 'Rejected';
            $exchange->confirmed_at = now();
            $exchange->meet_up_at = $request->meet_up_at;
            $exchange->exchanged_at = $request->exchanged_at;
            $exchange->reason_reject = $request->reason_reject;
            $exchange->meeting_agree = $request->meeting_agree;
        } else {
            $exchange->status = $request->status;
            $exchange->confirmed_at = null;
            $exchange->meet_up_at = null;
            $exchange->exchanged_at = null;
            $exchange->reason_reject = null;
        }

        $exchange->save();

        return response()->json(['success' => true, 'message' => 'Exchange status updated successfully.']);
    }

    public function removeExchange(Request $request, Exchange $exchange)
    {
        try {
            // Logic to remove the exchange from the database
            $exchange->delete();

            return response()->json(['success' => true, 'message' => 'Exchange canceled successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to remove exchange.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
