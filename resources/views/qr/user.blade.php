@extends('layouts.app')

@section('content')
<main class="container my-5">


        @if (!$user->is_valid)
        <div class="custom-alert-blocked d-flex align-items-start p-3 rounded">
            <div class="icon me-3 mt-1">
                <i class="bi bi-x-circle-fill fs-5 text-danger"></i>
            </div>
            <div class="content">
                <div class="fw-semibold text-white">Your QR is Invalid</div>
                <div class="small text-secondary">Please contact us for further assistance</div>
            </div>
        </div>


        @else
        <div class="card shadow mx-auto" style="max-width: 900px;">
            <div class="card-header text-center">
                <h4 class="fw-bold mb-0">Permit Holder Information</h4>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5 fw-semibold">Surname</div>
                    <div class="col-md-7">{{ $user->last_name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5 fw-semibold">Other Names</div>
                    <div class="col-md-7">{{ $user->first_names }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5 fw-semibold">Date of Birth</div>
                    <div class="col-md-7">{{ $user->dob }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5 fw-semibold">Sri Lankan Driving License Number</div>
                    <div class="col-md-7">{{ $user->sl_license_no }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5 fw-semibold">International Driving Permit Number</div>
                    <div class="col-md-7">{{ $user->int_permit_no }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5 fw-semibold">Issued Date</div>
                    <div class="col-md-7">{{ $user->date_issued }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5 fw-semibold">Expiry Date</div>
                    <div class="col-md-7">{{ $user->date_expiry }}</div>
                </div>
                <div class="row">
                    <div class="col-md-5 fw-semibold">Vehicles Valid</div>
                    <div class="col-md-7">{{ $user->vehicle_types }}</div>
                </div>
            </div>
        </div>
        @endif


</main>
@endsection
