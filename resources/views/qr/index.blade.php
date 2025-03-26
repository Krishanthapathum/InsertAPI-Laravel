<form action="{{ route('qr.generate') }}" method="POST">
    @csrf
    <h3>Select Users to Generate QR</h3>
    <table>
        <tr>
            <th>Select</th>
            <th>Name</th>
            <th>Permit No</th>
            <th>QR Generated</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>
                    @if(!$user->qr_code_identifier)
                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                    @else
                        ✓
                    @endif
                </td>
                <td>{{ $user->first_names }} {{ $user->last_name }}</td>
                <td>{{ $user->int_permit_no }}</td>
                <td>{{ $user->qr_code_identifier ? 'Yes' : 'No' }}</td>
            </tr>
        @endforeach
    </table>
    <button type="submit">Generate QR Codes</button>
</form>
