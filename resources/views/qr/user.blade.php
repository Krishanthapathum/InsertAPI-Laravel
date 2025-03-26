<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Permit Holder Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Poppins:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        header {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand,
        .header-title {
            font-family: 'Merriweather', serif;
        }
        .card {
            border-radius: 16px;
            overflow: hidden;
        }
        .card-header {
            background-color: #202020;
            color: #fff;
            padding: 20px;
        }
        .card-body {
            font-size: 15px;
            background-color: #fff;
        }
        .card-footer {
            background-color: #f8f9fa;
        }
        footer {
            background-color: #000;
            color: #eec522;
            font-size: 0.85rem;
        }
        footer a {
            color: #f8b400;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .logo {
            max-height: 70px;
            object-fit: contain;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-dark text-white">
    <div class="container py-2">
        <div class="d-flex align-items-center justify-content-between">
            <img src="{{ asset('images/AAC Logo.jpg') }}" alt="AAC logo" class="logo">
            <div class="text-center">
                <h5 class="m-0 fw-bold header-title">Republic of Sri Lanka (CEYLON)</h5>
                <p class="m-0">International Motor Traffic</p>
                <p class="m-0">International Driving Permit</p>
                <p class="m-0" style="font-size: 12px;">Convention On Road Traffic of 19 September 1949</p>
            </div>
            <img src="{{ asset('images/FIA Logo.jpg') }}" alt="FIA logo" class="logo">
        </div>
    </div>
</header>

<main class="container my-5">
    <div class="card shadow mx-auto" style="max-width: 900px;">
        <div class="card-header text-center">
            <h4 class="fw-bold mb-0">Permit Holder Information</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3"><div class="col-md-5 fw-semibold">Surname</div><div class="col-md-7">{{ $user->last_name }}</div></div>
            <div class="row mb-3"><div class="col-md-5 fw-semibold">Other Names</div><div class="col-md-7">{{ $user->first_names }}</div></div>
            <div class="row mb-3"><div class="col-md-5 fw-semibold">Date of Birth</div><div class="col-md-7">{{ $user->dob }}</div></div>
            <div class="row mb-3"><div class="col-md-5 fw-semibold">Sri Lankan Driving License Number</div><div class="col-md-7">{{ $user->sl_license_no }}</div></div>
            <div class="row mb-3"><div class="col-md-5 fw-semibold">International Driving Permit Number</div><div class="col-md-7">{{ $user->int_permit_no }}</div></div>
            <div class="row mb-3"><div class="col-md-5 fw-semibold">Issued Date</div><div class="col-md-7">{{ $user->date_issued }}</div></div>
            <div class="row mb-3"><div class="col-md-5 fw-semibold">Expiry Date</div><div class="col-md-7">{{ $user->date_expiry }}</div></div>
            <div class="row"><div class="col-md-5 fw-semibold">Vehicles Valid</div><div class="col-md-7">{{ $user->vehicle_types }}</div></div>
        </div>
    </div>
</main>

<footer class="bg-dark text-warning py-4 mt-auto">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-6">
                <p><strong>The Automobile Association of Ceylon – Sri Lanka</strong></p>
                <p>40, Sir Mohamed Macan Marker Mawatha, Colombo 03, Sri Lanka.</p>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled">
                    <li><i class="bi bi-telephone-fill"></i> +94 2446 074 | +94 2421 528-9</li>
                    <li><i class="bi bi-printer-fill"></i> +94 2446074</li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled">
                    <li><i class="bi bi-globe"></i> <a href="https://www.aaceylon.lk" target="_blank">www.aaceylon.lk</a></li>
                    <li><i class="bi bi-envelope-fill"></i> <a href="mailto:aacmotor@sltnet.lk">aacmotor@sltnet.lk</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
