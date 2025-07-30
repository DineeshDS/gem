@extends('layouts.app')

@section('page-title', 'Overview')

@section('head')
    <!-- Slick -->
    <link rel="stylesheet" href="{{ url('libs/slick/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('libs/dataTable/datatables.min.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .child-table {
            padding: 0 !important;
            background-color: #f8f9fa;
        }

        .child-table .table {
            margin-bottom: 0;
        }

        tr.details td {
            background-color: #f8f9fa;
        }

        .child-row td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
        }

        .details-control {
            cursor: pointer;
            text-align: center;
        }

        .badge {
            font-size: 0.85em;
        }

        .toggle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: none;
            font-size: 12px;
            padding: 0;

        }

        .toggle-btn .bi-plus {
            color: black;
            /* Changed to black */
        }

        .toggle-btn .bi-dash {
            color: black;
            /* Changed to black */
        }

        .toggle-btn.collapsed {
            background-color: #8d8b8b;
            border-color: #8d8b8b;
            box-shadow: 0 0 5px rgba(141, 139, 139, 0.5);
        }

        .toggle-btn.expanded {
            background-color: #8d8b8b;
            border-color: #8d8b8b;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
        }

        .table.table-custom,
        .table-responsive {
            overflow-x: scroll !important;
        }

        .btn-group-sm > .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }


        .toast-error {
            background-color: #d32f2f !important;
            color: #ffffff !important;
            border-color: #b71c1c !important;
            padding: 15px 20px 15px 50px !important;
            min-height: 60px !important;
            position: relative !important;
        }

        .toast-error .toast-title {
            color: #ffffff !important;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
            padding-left: 10px !important;
        }

        .toast-error .toast-message {
            color: #ffffff !important;
            font-size: 14px;
            line-height: 1.4;
            padding-left: 10px !important;
        }

        .toast-error .toast-close-button {
            color: #ffffff !important;
            opacity: 0.8;
            position: absolute !important;
            right: 10px !important;
            top: 10px !important;
        }

        .toast-error .toast-close-button:hover {
            opacity: 1;
        }

        .toast-error:before {
            content: "!" !important;
            font-family: inherit !important;
            font-size: 24px !important;
            font-weight: bold !important;
            color: #ffffff !important;
            position: absolute !important;
            left: 15px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            width: 30px !important;
            height: 30px !important;
            text-align: center !important;
            line-height: 30px !important;
        }

        .detail-card {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .detail-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 500;
            margin-top: 0.25rem;
        }

        .order-badge {
            font-size: 0.875rem;
            padding: 0.35em 0.65em;
            font-weight: 600;
        }

        .table-custom th {
            background-color: #f8f9fa;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            color: #495057;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: none !important;
        }

        .dataTables_wrapper .dataTables_info {
            display: none !important;
        }

        .dataTables_wrapper .dataTables_length {
            display: none !important;
        }

        .dataTables_wrapper .dataTables_filter {
            display: none !important;
        }

        #shiphero-warning-banner .alert {
            border-left: 4px solid #ffc107;
            background-color: #fff9e6;
        }

        #shiphero-warning-banner .alert-heading {
            color: #856404;
        }

        #warning-message {
            font-size: 0.95rem;
        }
    </style>
@endsection


@section('content')
    <div class="mb-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('orders.list') }}">
                        <i class="bi bi-globe2 small me-2"></i> Orders
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex gap-4 align-items-center">
                        <div class="d-none d-md-flex">Orders</div>
                        <div class="d-md-flex gap-3 align-items-center">
                            <form class="d-flex flex-grow-1 gap-3 align-items-center">
                                <!-- Page Length Select -->
                            </form>
                        </div>
                        <div class="ms-auto">
                            <a class="btn btn-primary" href="{{ route('orders.create') }}" id="syncAmOrdersBtn">
                                <i class="fas fa-sync-alt me-1"></i> Create Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-custom table-lg mb-0" id="orders">
                    <thead>
                    <tr>
                        <th width="10%">Sl No</th>
                        <th width="10%">Customer Name</th>
                        <th width="10%">Item</th>
                        <th width="10%">price</th>
                        <th width="10%">Status</th>
                        <th width="10%">Date Created</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Logs Modal -->
    <div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="logsModalLabel">

                        Order Logs
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Logs content will be loaded here via AJAX -->
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading logs...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Apex chart -->
    <script src="{{ url('libs/charts/apex/apexcharts.min.js') }}"></script>

    <!-- Slick -->
    <script src="{{ url('libs/slick/slick.min.js') }}"></script>

    <!-- Examples -->
    <script src="{{ url('dist/js/examples/dashboard.js') }}"></script>

    <script src="{{ url('libs/dataTable/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>

        $(document).ready(function () {

            var table = $("#orders").DataTable({
                "processing": true,
                "lengthChange": true,
                "serverSide": true,
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                "paging": true,
                "scrollX": false,
                // "responsive":true,
                'stateSave': true,
                "autoWidth": false,
                "ajax": {
                    url: "{{ route('orders.list') }}",
                    type: 'GET',
                    data: function (d) {

                    },
                },
                columns: [
                    {
                        "data": "id",
                        searchable: false,
                        orderable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'customer_name', name: 'customer_name', orderable: false, searchable: false},
                    {data: 'item_name', name: 'item_name', orderable: false, searchable: false},
                    {data: 'price', name: 'price', orderable: false, searchable: false},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}

                ],
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                initComplete: function () {

                },
                "fnDrawCallback": function (oSettings) {

                },
                buttons: []
            })
        });

        function delete_order(id) {
            var urlS = "{{ url('api/orders') }}/:id";
            var url = urlS.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    call_api(url);
                }
            });
        }

        function call_api(url) {
            $.ajax({
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                type: 'DELETE',
                success: function (response) {
                    if (response) {
                        $('#orders').DataTable().ajax.reload();
                        if (response.success === true) {
                            alert("Deleted successfully");
                        }
                    }
                },
                error: function (data) {
                },
            });
        }
    </script>
@endsection
