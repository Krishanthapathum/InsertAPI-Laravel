<h3 class="mb-4 fw-bold text-center">All Generated QR Codes</h3>

<div class="row">
    @foreach ($qrData as $data)
        <div class="col-md-4 mb-4">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $data['user']->first_names }} {{ $data['user']->last_name }}</h5>
                    <p class="card-text">International Permit No: <strong>{{ $data['user']->int_permit_no }}</strong></p>
                    <p><a href="{{ $data['url'] }}" target="_blank" class="btn btn-outline-primary btn-sm">View Profile</a></p>
                    <div>{!! $data['qr'] !!}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
