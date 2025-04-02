<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermitUser;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PermitUserController extends Controller
{
    public function store(Request $request)
    {
        // Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'last_name' => 'nullable|string',
            'first_names' => 'required|string',
            'dob' => 'nullable|date',
            'sl_license_no' => 'nullable|string',
            'int_permit_no' => 'nullable|string',
            'date_issued' => 'required|date',
            'date_expiry' => 'nullable|date',
            'vehicle_types' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Step 2: Determine identifier
        $identifierField = $request->filled('int_permit_no') ? 'int_permit_no' : 'sl_license_no';
        $identifierValue = $request->{$identifierField};

        if (!$identifierValue) {
            return response()->json(['message' => 'Either int_permit_no or sl_license_no is required.'], 422);
        }

        // Step 3: Calculate expiry date if not provided
        $dateIssued = Carbon::parse($request->date_issued);
        $dateExpiry = $request->filled('date_expiry') ? $request->date_expiry : $dateIssued->copy()->addYear()->toDateString();

        // Step 4: Find existing user
        $user = PermitUser::where($identifierField, $identifierValue)->first();

        // Step 5: If exists → update, else → create
        if ($user) {
            $user->update([
                'last_name' => $request->last_name,
                'first_names' => $request->first_names,
                'dob' => $request->dob,
                'sl_license_no' => $request->sl_license_no,
                'int_permit_no' => $request->int_permit_no,
                'date_issued' => $request->date_issued,
                'date_expiry' => $dateExpiry,
                'vehicle_types' => $request->vehicle_types,
            ]);

            return response()->json([
                'message' => 'User already existed and was updated.',
                'data' => $user
            ], 200);
        } else {
            // Step 6: Generate QR Code Identifier
            $prefix = rand(100, 999999);
            $permit = $request->int_permit_no ?: $request->sl_license_no;
            $combined = $prefix . $permit;
            $position = strpos($combined, $permit);
            $identifierDigit = $position !== false ? $position : 0;
            $qrIdentifier = $combined . $identifierDigit;

            // Step 7: Create new user
            $user = PermitUser::create([
                'last_name' => $request->last_name,
                'first_names' => $request->first_names,
                'dob' => $request->dob,
                'sl_license_no' => $request->sl_license_no,
                'int_permit_no' => $request->int_permit_no,
                'date_issued' => $request->date_issued,
                'date_expiry' => $dateExpiry,
                'vehicle_types' => $request->vehicle_types,
                'qr_code_identifier' => $qrIdentifier
            ]);

            return response()->json([
                'message' => 'User stored and QR identifier generated successfully.',
                'qr_identifier' => $qrIdentifier,
                'data' => $user
            ], 201);
        }
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
