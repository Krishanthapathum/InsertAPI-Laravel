@extends('layouts.app')

@section('content')

    <head>
        <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    </head>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3 compact-header">
            <h4 class="fw-bold">QR Code User List</h4>
            <div class="d-flex gap-2">
                <input type="text" id="searchBox" class="form-control form-control-sm" placeholder="Search...">
                <button id="printSelectedBtn" class="btn btn-sm btn-primary">Print</button>

            </div>
        </div>

        <table class="table table-custom" id="userTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>No</th>
                    <th>Name</th>
                    <th>SL License</th>
                    <th>INT Permit</th>
                    <th>Vehicle Type</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td><input type="checkbox" class="select-user" data-id="{{ $user->id }}"></td>
                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                        <td>{{ $user->first_names }} {{ $user->last_name }}</td>
                        <td>{{ $user->sl_license_no }}</td>
                        <td>{{ $user->int_permit_no }}</td>
                        <td>{{ $user->vehicle_types }}</td>
                        <td>
                            @if ($user->qr_code_identifier)
                                <span
                                    class="badge-status {{ !$user->is_valid ? 'badge-invalid' : ($user->printed ? 'badge-printed' : 'badge-generated') }}"
                                    id="status-{{ $user->id }}">
                                    {{ !$user->is_valid ? 'Invalid' : ($user->printed ? 'Printed' : 'Generated') }}
                                </span>
                            @else
                                <span class="badge-status badge-pending">Pending</span>
                            @endif

                        </td>

                        <td class="text-center">
                            @if ($user->qr_code_identifier)
                                <button class="action-btn" data-bs-toggle="modal"
                                    data-bs-target="#qrModal{{ $user->id }}" title="QR">
                                    <i class="bi bi-qr-code-scan"></i>
                                </button>
                                <button class="action-btn" data-bs-toggle="modal"
                                    data-bs-target="#profileModal{{ $user->id }}" title="Profile">
                                    <i class="bi bi-person"></i>
                                </button>
                            @endif
                            <a href="#" class="action-btn" title="Edit" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $user->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                        </td>
                    </tr>

                    <!-- QR Modal -->
                    <div class="modal fade" id="qrModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="qrModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="qrModalLabel{{ $user->id }}">QR Code - {{ $user->first_names }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $qrLink = url('/user/' . $user->qr_code_identifier);
                                    @endphp

                                    <a href="{{ $qrLink }}" target="_blank" class="d-inline-block">
                                        {!! QrCode::size(200)->generate($qrLink) !!}
                                    </a>

                                    <a href="{{ $qrLink }}" target="_blank" class="mt-2 small text-decoration-none d-block text-primary">
                                        {{ $qrLink }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Profile Modal -->
                    <div class="modal fade" id="profileModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="profileModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="profileModalLabel{{ $user->id }}">User Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Name:</strong> {{ $user->first_names }} {{ $user->last_name }}</p>
                                    <p><strong>DOB:</strong> {{ $user->dob }}</p>
                                    <p><strong>SL License No:</strong> {{ $user->sl_license_no }}</p>
                                    <p><strong>INT Permit No:</strong> {{ $user->int_permit_no }}</p>
                                    <p><strong>Date Issued:</strong> {{ $user->date_issued }}</p>
                                    <p><strong>Expiry Date:</strong> {{ $user->date_expiry }}</p>
                                    <p><strong>Vehicle Types:</strong> {{ $user->vehicle_types }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg for wider layout -->
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-check form-switch mb-4">
                                            <input class="form-check-input" type="checkbox" name="is_valid"
                                                id="isValidSwitch{{ $user->id }}"
                                                {{ $user->is_valid ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isValidSwitch{{ $user->id }}">
                                                Mark QR as Valid
                                            </label>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>First Names</label>
                                                <input type="text" class="form-control" name="first_names"
                                                    value="{{ $user->first_names }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ $user->last_name }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>DOB</label>
                                                <input type="date" class="form-control" name="dob"
                                                    value="{{ $user->dob }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>SL License No</label>
                                                <input type="text" class="form-control" name="sl_license_no"
                                                    value="{{ $user->sl_license_no }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>INT Permit No</label>
                                                <input type="text" class="form-control" name="int_permit_no"
                                                    value="{{ $user->int_permit_no }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Date Issued</label>
                                                <input type="date" class="form-control" name="date_issued"
                                                    value="{{ $user->date_issued }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Date Expiry</label>
                                                <input type="date" class="form-control" name="date_expiry"
                                                    value="{{ $user->date_expiry }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Vehicle Types</label>
                                                <input type="text" class="form-control" name="vehicle_types"
                                                    value="{{ $user->vehicle_types }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div id="printContainer" style="display: none;"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchBox').addEventListener('input', function() {
                const value = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    row.style.display = rowText.includes(value) ? '' : 'none';
                });
            });

            document.getElementById('selectAll').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.select-user');
                checkboxes.forEach(cb => cb.checked = this.checked);
            });


        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


    <script>
        document.getElementById('printSelectedBtn').addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.select-user:checked')).map(cb => cb.dataset
                .id);
            if (selectedIds.length === 0) {
                alert("Please select at least one user to print.");
                return;
            }

            const users = @json($users->keyBy('id'));
            const printContainer = document.getElementById('printContainer');
            printContainer.innerHTML = ''; // Clear previous QR blocks

            selectedIds.forEach(id => {
                const user = users[id];
                if (!user.qr_code_identifier) return;

                const wrapper = document.createElement('div');
                wrapper.className = 'qr-block';
                wrapper.style.textAlign = 'center';
                wrapper.style.marginBottom = '30px';

                const qrDiv = document.createElement('div');
                qrDiv.id = `qrcode-${user.id}`;

                const permitP = document.createElement('p');
                permitP.innerHTML = `${user.int_permit_no}`;

                wrapper.appendChild(qrDiv);
                wrapper.appendChild(permitP);
                printContainer.appendChild(wrapper);

                new QRCode(qrDiv, {
                    text: `{{ url('/user') }}/` + user.qr_code_identifier,
                    width: 100,
                    height: 100
                });
            });

            setTimeout(() => {
                const printWindow = window.open('', '', 'width=600,height=800');
                printWindow.document.write(`
                        <html>
                        <head>
                            <title>Print QR Codes</title>
                            <style>
                                @page {
                                    size: 80mm auto;
                                    margin: 0;
                                }

                                @media print {
                                    html, body {
                                        width: 80mm;
                                        margin: 0;
                                        padding: 0;
                                    }
                                }

                                body {
                                    width: 80mm;
                                    margin: 0;
                                    padding: 0;
                                    font-family: Arial, sans-serif;
                                }

                                .qr-block {
                                    width: 100%;
                                    height: 100%;
                                    padding: 0px 0;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                    text-align: center;
                                    page-break-after: always;
                                }

                                .qr-block p {
                                    font-size: 12px;
                                    margin: 5px 0 0;
                                    word-break: break-word;
                                }

                                img {
                                    max-width: 100%;
                                }
                            </style>
                        </head>
                        <body>${printContainer.innerHTML}</body>
                        </html>
                    `);

                printWindow.document.close();
                printWindow.focus();

                // Wait to ensure all QR codes load
                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 1500);
            }, 1000);

            // ✅ 1. Update UI badges
            selectedIds.forEach(id => {
                const badge = document.getElementById('status-' + id);
                if (badge) {
                    badge.innerText = 'Printed';
                    badge.classList.remove('badge-generated');
                    badge.classList.add('badge-printed');
                }
            });

            // ✅ 2. Send AJAX request to backend to update DB
            fetch("{{ route('qr.markAsPrinted') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        ids: selectedIds
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log('Marked as printed:', data);
                });
        });
    </script>
@endpush
