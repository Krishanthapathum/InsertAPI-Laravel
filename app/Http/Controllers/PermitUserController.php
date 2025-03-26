<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermitUser;

class PermitUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required|string',
            'first_names' => 'required|string',
            'dob' => 'required|date',
            'sl_license_no' => 'nullable|string',
            'int_permit_no' => 'nullable|string',
            'date_issued' => 'required|date',
            'date_expiry' => 'required|date',
            'vehicle_types' => 'required|string',
        ]);

        // Determine which identifier to use
        $identifierField = $request->filled('int_permit_no') ? 'int_permit_no' : 'sl_license_no';
        $identifierValue = $request->{$identifierField};

        $user = PermitUser::firstOrCreate(
            [$identifierField => $identifierValue],
            [
                'last_name' => $request->last_name,
                'first_names' => $request->first_names,
                'dob' => $request->dob,
                'sl_license_no' => $request->sl_license_no,
                'int_permit_no' => $request->int_permit_no,
                'date_issued' => $request->date_issued,
                'date_expiry' => $request->date_expiry,
                'vehicle_types' => $request->vehicle_types,
            ]
        );

        return response()->json([
            'message' => $user->wasRecentlyCreated ? 'User stored successfully.' : 'User already exists.',
            'data' => $user
        ]);
    }

    public function findByPermit($int_permit_no)
    {
        $int_permit_no = trim($int_permit_no);

        $user = PermitUser::where('int_permit_no', $int_permit_no)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['data' => $user]);
    }



}
