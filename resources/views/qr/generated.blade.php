<h3>Generated QR Codes</h3>
@foreach ($qrData as $data)
    <div style="margin-bottom: 20px;">
        <p><strong>{{ $data['user']->first_names }} {{ $data['user']->last_name }}</strong></p>
        <p>Permit No: {{ $data['user']->int_permit_no }}</p>
        <p>URL: <a href="{{ $data['url'] }}" target="_blank">{{ $data['url'] }}</a></p>
        {!! $data['qr'] !!}
        <hr>
    </div>
@endforeach
