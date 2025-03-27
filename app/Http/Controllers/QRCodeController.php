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


}
