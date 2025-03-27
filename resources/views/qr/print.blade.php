<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print QR Codes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .qr-card {
            width: 200px;
            text-align: center;
            margin: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            page-break-inside: avoid;
        }

        .qr-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .permit-no {
            font-weight: bold;
            margin-top: 10px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container py-4">
        <h4 class="text-center mb-4 no-print">QR Code Print Preview</h4>

        <div class="qr-grid">
            @foreach ($users as $user)
                <div class="qr-card">
                    {!! QrCode::size(140)->generate(url('/user/' . $user->qr_code_identifier)) !!}
                    <div class="permit-no">INT Permit: {{ $user->int_permit_no }}</div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
