<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        h3 {
            margin-top: 30px;
        }

        table th,
        table td {
            vertical-align: middle !important;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center fw-bold">Generate QR Codes for Permit Users</h3>

        <div class="row mt-4 mb-3">
            <div class="col-md-4">
                <input type="text" id="searchBox" class="form-control" placeholder="Search by name or permit...">
            </div>
            <div class="col-md-8 text-end">
                <a href="{{ route('qr.export.pdf') }}" class="btn btn-outline-danger me-2">Export to PDF 🧾</a>
                {{-- <button class="btn btn-outline-secondary" onclick="window.print()">Print Cards 🖨️</button> --}}
            </div>
        </div>

        <form action="{{ route('qr.generate') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle" id="userTable">
                    <thead class="table-dark">
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Generated</th>
                            <th>Name</th>
                            <th>Permit No</th>
                            <th>QR Generated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                        class="user-checkbox">
                                </td>

                                <td>
                                    @if (!$user->qr_code_identifier)
                                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                            class="user-checkbox">
                                    @else
                                        <span class="text-success fw-bold">✓</span>
                                    @endif
                                </td>
                                <td>{{ $user->first_names }} {{ $user->last_name }}</td>
                                <td>{{ $user->int_permit_no }}</td>
                                <td>
                                    @if ($user->qr_code_identifier)
                                        <a href="{{ url('/user/' . $user->qr_code_identifier) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">View QR</a>
                                    @else
                                        <span class="text-muted">No</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-success fw-bold">Generate Selected QR Codes</button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script>
        // Select All Checkbox Logic
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        // Search Filter
        document.getElementById('searchBox').addEventListener('keyup', function() {
            const value = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const permit = row.cells[2].textContent.toLowerCase();

                if (name.includes(value) || permit.includes(value)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>
