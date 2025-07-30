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

        .btn-group-sm>.btn {
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
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form class="form-label-left input_mask" method="post" id="cred-form">
                    @csrf
                    <div class="row">

                        <div class="col-md-6  mb-3">
                            <label class="form-label">API URL</label>
                            <input class="form-control" name="prod_url" value="{{ $prod_url ?? '' }}">
                        </div>
                        <div class="col-md-6  mb-3">
                            <label class="form-label">GraphQL URL</label>
                            <input class="form-control" name="graphql_url" value="{{ $graphql_url ?? '' }}">
                        </div>
                        <div class="col-md-6  mb-3">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control" name="user_name" value="{{ $user_name ?? '' }}">
                        </div>
                        <div class="col-md-6  mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ $password ?? '' }}">
                            <span class="fa fa-fw toggle-password fa-eye-slash"></span>
                        </div>
                        <div class="col-md-6  mb-3">
                            <label class="form-label">Access Token</label>
                            <input type="password" class="form-control" name="access_token" value="{{ $token ?? '' }}" >
                            <span class="fa fa-fw toggle-password fa-eye-slash"></span>
                        </div>
                        <div class="col-md-6  mb-3">
                            <label class="form-label">Refresh Token</label>
                            <input type="password" class="form-control" name="refresh_token" value="{{ $refresh_token ?? '' }}" >
                            <span class="fa fa-fw toggle-password fa-eye-slash"></span>
                        </div>

                        <div class="col-md-12 mb-3 text-end">
                            @if(!empty($user_name) && !empty($password))
                                <button type="button" id="refresh-token" class="btn btn-info">Generate New Token</button>
                            @endif
                            <button type="button" id="save-credentials" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
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

@endsection
