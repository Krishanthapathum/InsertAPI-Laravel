<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AACeylon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/AAC Logo.jpg') }}" type="image/jpeg">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Poppins:wght@400&display=swap"
        rel="stylesheet">


    <style>
        /* body {
            font-family: 'Poppins', sans-serif;
            background-color: #0f1112;
            color: #ffffff;
        } */

        .body-dark {
            background-color: #0f1112;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .body-light {
            background-color: #ffffff;
            color: #000000;
            font-family: 'Poppins', sans-serif;
        }


        header {
            background-color: #1c1e20;
            border-bottom: 3px solid #f4c103;
        }

        .header-title {
            font-family: 'Merriweather', serif;
        }

        .logo {
            max-height: 65px;
            object-fit: contain;
        }

        .card {
            background-color: #1e1f20;
            border: 1px solid #2c2f33;
            border-radius: 12px;
        }

        .card-header {
            background-color: #f4c103;
            color: #000;
        }

        .card-body {
            font-size: 16px;
            color: #ffffff;
        }

        .fw-semibold {
            color: #f4c103;
        }

        footer {
            background-color: #000;
            color: #f4c103;
        }

        footer a {
            color: #f4c103;
        }

        footer a:hover {
            text-decoration: underline;
        }

        h3 {
            margin-top: 30px;
        }

        table th,
        table td {
            vertical-align: middle !important;
        }


        .custom-alert-blocked {
            background-color: #431a24;
            border-radius: 10px;
            max-width: 500px;
            margin: 20px auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .custom-alert-blocked .icon i {
            color: #8c7be4;
        }

        .custom-alert-blocked .text-light-emphasis {
            color: #ffffff;
            font-size: 16px;
        }

        .custom-alert-blocked .text-muted {
            color: #f2f2f2;
            font-size: 14px;
        }
    </style>
</head>

<body class="{{ request()->routeIs('qr.show') ? 'body-dark' : 'body-light' }} d-flex flex-column min-vh-100">

    <!-- Light Topbar with Logout -->
    <div class="bg-dark py-1">
        <div class="container-fluid px-3 d-flex justify-content-between align-items-center">
            @if (Auth::check())
                <div class="text-white small">
                    👋 Hi, {{ Auth::user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm text-white" style="font-size: 13px; font-weight: 300;">
                        Logout
                    </button>
                </form>
            @endif
        </div>
    </div>




    <!-- Main Dark Header -->
    <header>
        <div class="container py-2">
            <div class="d-flex align-items-center justify-content-between">
                <img src="{{ asset('images/AAC Logo.jpg') }}" alt="AAC logo" class="logo">

                <div class="text-center d-none d-md-block">
                    <h5 class="m-0 fw-bold header-title text-white">Republic of Sri Lanka (CEYLON)</h5>
                    <p class="m-0 text-light">International Motor Traffic</p>
                    <p class="m-0 text-light">International Driving Permit</p>
                    <p class="m-0 text-secondary" style="font-size: 12px;">Convention On Road Traffic of 19 September
                        1949</p>
                </div>

                <div class="text-center d-block d-md-none">
                    <h6 class="m-0 fw-bold text-white">Automobile Association of Ceylon</h6>
                </div>

                <img src="{{ asset('images/FIA Logo.jpg') }}" alt="FIA logo" class="logo">
            </div>
        </div>
    </header>


    @yield('content')

    <footer class="py-4 mt-auto " style="background-color: #000;">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- Left Column -->
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="fw-bold">Issued At</h6>
                    <p class="mb-1">The Automobile Association of Ceylon – Sri Lanka</p>
                    <p class="mb-0">40, Sir Mohamed Macan Marker Mawatha, Colombo 03, Sri Lanka.</p>
                </div>

                <!-- Middle Column: Contact -->
                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="fw-bold">Contact</h6>
                    <ul class="list-unstyled mb-0">
                        <li><i class="bi bi-telephone-fill me-2"></i>+94 2446 074 / +94 2421 528-9</li>
                        <li><i class="bi bi-printer-fill me-2"></i>+94 2446074</li>
                    </ul>
                </div>

                <!-- Right Column: Links -->
                <div class="col-md-3">
                    <h6 class="fw-bold">Connect</h6>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <i class="bi bi-globe me-2"></i>
                            <a href="https://www.aaceylon.lk" target="_blank" class="text-warning text-decoration-none">www.aaceylon.lk</a>
                        </li>
                        <li>
                            <i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:aacmotor@sltnet.lk" class="text-warning text-decoration-none">aacmotor@sltnet.lk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>

</html>
