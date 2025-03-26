<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Driver Information - International Permit Lookup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    {{-- <link rel="stylesheet" href="css/style.css" /> --}}
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Poppins:wght@400&family=Roboto:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://unpkg.com/html5-qrcode"></script>
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

        #start-scan-btn {
            background-color: #e19528;
            color: white;
            font-weight: bold;
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        #start-scan-btn:hover {
            background-color: #d18521;
            transform: scale(1.05);
        }

        #scanner-container {
            display: none;
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

    <main class="container my-5 text-center">
        <button id="start-scan-btn">📷 Scan QR Code Using Camera</button>

        <div id="scanner-container" class="mt-4">
            <div id="qr-reader" style="width: 320px; margin: 0 auto;"></div>
            <p id="scanner-status" class="text-primary fw-bold mt-3">Initializing scanner...</p>
        </div>

        <div id="driver-card" class="card mt-5 mx-auto shadow-sm" style="display: none; max-width: 900px;">
            <div class="card-header text-center">
                <h4 class="fw-bold mb-0">Permit Holder Information</h4>
            </div>
            <div class="card-body text-start">
                <div class="row mb-3"><div class="col-md-5 fw-semibold">Surname</div><div class="col-md-7" id="surname">-</div></div>
                <div class="row mb-3"><div class="col-md-5 fw-semibold">Other Names</div><div class="col-md-7" id="other_names">-</div></div>
                <div class="row mb-3"><div class="col-md-5 fw-semibold">Date of Birth</div><div class="col-md-7" id="dob">-</div></div>
                <div class="row mb-3"><div class="col-md-5 fw-semibold">Sri Lankan Driving License Number</div><div class="col-md-7" id="sl_license">-</div></div>
                <div class="row mb-3"><div class="col-md-5 fw-semibold">International Driving Permit Number</div><div class="col-md-7" id="int_permit">-</div></div>
                <div class="row mb-3"><div class="col-md-5 fw-semibold">Issued Date</div><div class="col-md-7" id="issued_date">-</div></div>
                <div class="row mb-3"><div class="col-md-5 fw-semibold">Expiry Date</div><div class="col-md-7" id="expiry_date">-</div></div>
                <div class="row"><div class="col-md-5 fw-semibold">Vehicles Valid</div><div class="col-md-7" id="vehicles">-</div></div>
            </div>
            <div class="card-footer text-end">
                <button id="rescan-btn" class="btn btn-warning fw-bold">Scan Another</button>
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

    <div id="qr-reader-temp" style="display:none;"></div>

    <script>
        let qrReader;

        function startScanner() {
            document.getElementById("scanner-container").style.display = "block";
            document.getElementById("driver-card").style.display = "none";
            document.getElementById("start-scan-btn").style.display = "none";
            document.getElementById("scanner-status").innerText = "Initializing scanner...";

            qrReader = new Html5Qrcode("qr-reader");
            qrReader.start({ facingMode: "environment" }, { fps: 15, qrbox: 250 }, qrCodeMessage => {
                qrReader.stop().then(() => {
                    document.getElementById("scanner-status").innerText = "QR Code scanned!";
                    fetchUserDetails(qrCodeMessage.trim());
                });
            }, error => {
                document.getElementById("scanner-status").innerText = "Scanning... (hold QR in view)";
            }).then(() => {
                document.getElementById("scanner-status").innerText = "Scanner ready. Hold QR code in the box.";
            }).catch(() => {
                document.getElementById("scanner-status").innerText = "Failed to start scanner.";
            });
        }

        function fetchUserDetails(permitNo) {
            fetch(`/api/user-by-permit/${permitNo}`)
                .then(response => {
                    if (!response.ok) throw new Error("User not found");
                    return response.json();
                })
                .then(data => {
                    const user = data.data;
                    document.getElementById("surname").innerText = user.last_name;
                    document.getElementById("other_names").innerText = user.first_names;
                    document.getElementById("dob").innerText = user.dob;
                    document.getElementById("sl_license").innerText = user.sl_license_no;
                    document.getElementById("int_permit").innerText = user.int_permit_no;
                    document.getElementById("issued_date").innerText = user.date_issued;
                    document.getElementById("expiry_date").innerText = user.date_expiry;
                    document.getElementById("vehicles").innerText = user.vehicle_types;

                    document.getElementById("scanner-container").style.display = "none";
                    document.getElementById("driver-card").style.display = "block";
                })
                .catch(err => {
                    document.getElementById("scanner-status").innerHTML = `<span style='color:red;'>${err.message}</span>`;
                    document.getElementById("driver-card").style.display = "none";
                });
        }

        document.getElementById("start-scan-btn").addEventListener("click", startScanner);
        document.getElementById("rescan-btn").addEventListener("click", startScanner);
    </script>
</body>

</html>
