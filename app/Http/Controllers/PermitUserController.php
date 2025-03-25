<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermitUser;

class PermitUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required|string',
            'other_names' => 'required|string',
            'date_of_birth' => 'required|date',
            'sl_license_number' => 'required|string',
            'international_permit_number' => 'required|string',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'valid_vehicles' => 'required|string',
        ]);

        $user = PermitUser::firstOrCreate(
            ['international_permit_number' => $request->international_permit_number],
            [
                'surname' => $request->surname,
                'other_names' => $request->other_names,
                'date_of_birth' => $request->date_of_birth,
                'sl_license_number' => $request->sl_license_number,
                'issued_date' => $request->issued_date,
                'expiry_date' => $request->expiry_date,
                'valid_vehicles' => $request->valid_vehicles,
            ]
        );

        return response()->json([
            'message' => $user->wasRecentlyCreated ? 'User stored successfully.' : 'User already exists.',
            'data' => $user
        ]);
    }
}
