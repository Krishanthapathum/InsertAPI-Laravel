<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\PermitUser;
use PDF;


class QRCodeController extends Controller
{
    public function index()
    {

        $users = PermitUser::whereNotNull('qr_code_identifier')->paginate(10);
        return view('qr.index', compact('users'));
    }


    public function showUserByQr($identifier)
    {
        $user = PermitUser::where('qr_code_identifier', $identifier)->first();

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('qr.user', compact('user'));
    }


    public function markAsPrinted(Request $request)
    {
        $userIds = $request->input('ids');

        \App\Models\User::whereIn('id', $userIds)
            ->update(['printed' => true]);

        return response()->json([
            'status' => 'success',
            'updated_ids' => $userIds
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = PermitUser::findOrFail($id);

        $validated = $request->validate([
            'first_names' => 'nullable|string',
            'last_name' => 'nullable|string',
            'dob' => 'nullable|date',
            'sl_license_no' => 'required|string',
            'int_permit_no' => 'required|string',
            'date_issued' => 'required|date',
            'date_expiry' => 'nullable|date',
            'vehicle_types' => 'required|string',
        ]);

        // Handle the toggle (it won't be sent if unchecked, so use default false)
        $validated['is_valid'] = $request->has('is_valid');

        $user->update($validated);

        return redirect()->back()->with('success', 'User updated successfully.');
    }


}
