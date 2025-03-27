<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Permit System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #f4c103, #f2b700);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-panel h1 {
            font-size: 36px;
            font-weight: 700;
        }

        .left-panel p {
            font-size: 14px;
            margin-top: 10px;
            max-width: 80%;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
        }

        .circle1 { width: 250px; height: 250px; top: 20%; left: -80px; }
        .circle2 { width: 120px; height: 120px; bottom: 10%; right: -40px; }

        .right-panel {
            flex: 1;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-box h4 {
            font-weight: 600;
            margin-bottom: 25px;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .input-group {
            position: relative;
        }

        .input-group input {
            padding-left: 38px;
        }

        .btn-yellow {
            background-color: #f4c103;
            color: #000;
            font-weight: 500;
            border: none;
            border-radius: 8px;
        }

        .btn-yellow:hover {
            background-color: #e6b800;
        }

        .btn-outline-dark {
            border-radius: 8px;
        }

        .form-footer {
            font-size: 13px;
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .left-panel {
                height: 250px;
                text-align: center;
            }

            .left-panel p {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Left welcome panel -->
    <div class="left-panel">
        <h1>Welcome</h1>
        <p>Access the license printing system. Please log in to manage and print international driving permits securely.</p>
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
    </div>

    <!-- Right login form panel -->
    <div class="right-panel">
        <form method="POST" action="{{ route('login') }}" class="login-box">
            @csrf

            <h4>Log in</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-3 input-group">
                <i class="bi bi-person form-icon"></i>
                <input type="email" name="email" class="form-control" placeholder="Email address" required>
            </div>

            <div class="mb-3 input-group">
                <i class="bi bi-lock form-icon"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            {{-- <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                </div>
                <a href="#" class="small text-decoration-none">Forgot password?</a>
            </div> --}}

            <button type="submit" class="btn btn-yellow w-100 mb-2">Sign in</button>

            {{-- <button type="button" class="btn btn-outline-dark w-100">Sign in with other</button> --}}

            {{-- <div class="form-footer">
                Don't have an account? <a href="#" class="text-decoration-none">Sign up</a>
            </div> --}}
        </form>
    </div>
</div>

</body>
</html>
