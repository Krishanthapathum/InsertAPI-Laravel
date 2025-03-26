<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\PermitUser;

class QRCodeController extends Controller
{
    public function index()
    {

        $users = PermitUser::all();
        return view('qr.index', compact('users'));
    }

    public function generate(Request $request)
    {
        $selectedIds = $request->input('user_ids');
        $qrData = [];

        foreach ($selectedIds as $id) {
            $user = PermitUser::find($id);

            // Skip if already generated
            if ($user->qr_code_identifier) {
                continue;
            }

            $permit = $user->int_permit_no;

            $prefix = rand(100, 999999); // Random 3-6 digit prefix
            $combined = $prefix . $permit;

            // Find position where permit starts in combined string
            $position = strpos($combined, $permit);
            $identifierDigit = $position !== false ? $position : 0;

            // Final string = randomPrefix + permit + identifierDigit
            $randomString = $combined . $identifierDigit;

            // Save in DB
            $user->qr_code_identifier = $randomString;
            $user->save();

            // Final URL
            $url = route('qr.show', ['identifier' => $randomString]);
            $qr = QrCode::size(200)->generate($url);

            $qrData[] = [
                'user' => $user,
                'qr' => $qr,
                'url' => $url
            ];

        }

        return view('qr.generated', compact('qrData'));
    }

    public function showUserByQr($identifier)
    {
        $user = PermitUser::where('qr_code_identifier', $identifier)->first();

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('qr.user', compact('user'));
    }


}
