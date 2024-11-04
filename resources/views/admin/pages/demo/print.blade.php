@extends('admin.template-base', ['searchNavbar' => false])

@section('page-title', 'Demo Print Detail of User')

@section('header-code')

    <style>
        @media print {

            html,
            body {
                height: 100%;
                overflow: visible !important;
            }

            table,
            tr,
            th,
            td {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            table {
                width: 100%;
            }

            body {
                width: 210mm;
                height: 297mm;
                margin: 0;
                /* remove margin */
                padding: 0;
                /* remove padding */
            }

            .page-break {
                page-break-after: always;
            }

            .container-xxl {
                max-width: 100%;
            }

            .no-print {
                display: none;
            }

            /* Force background colors to print */
            .printable-content-a4-portrait {
                background-color: #ffffff;
                width: 210mm;
                min-height: 297mm;
                /* padding: 10mm; */
                box-sizing: border-box;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                page-break-inside: avoid;
                position: relative;
                top: 0;
                left: 0;
                page-break-before: auto;
                page-break-after: auto;
                padding: 0;
            }

            /* Force background colors to print */
            .printable-content-a4-landscape {
                background-color: #ffffff;
                width: 297mm;
                min-height: 210mm;
                /* padding: 10mm; */
                box-sizing: border-box;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                page-break-inside: avoid;
                position: relative;
                top: 0;
                left: 0;
                page-break-before: auto;
                page-break-after: auto;
                padding: 0;
            }

            /* Adjust print margins */
            @page {
                size: A4;
                margin: 0;
            }
        }

        /* For screen view to maintain margins */
        body {
            margin: 0;
            padding: 20px;
            /* Adjust this as needed for browser view */
        }

        /* Force background colors to print */
        .printable-content-a4-portrait {
            background-color: #ffffff;
            width: 210mm;
            min-height: 297mm;
            padding: 5mm;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .printable-content-a4-landscape {
            width: 297mm;
            min-height: 210mm;
            margin: 0 auto;
            padding: 5mm;
            box-sizing: border-box;
        }
    </style>

@endsection

{{-- MAIN CONTENT PART --}}
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- FOR BREADCRUMBS --}}
        {{-- Print buttons --}}
        <div class="mb-1 no-print">
            @include('admin.components.breadcrumb.simple', $breadcrumbs)
            <button class="btn btn-primary no-print" onclick="window.print()">Print A4</button>
        </div>
        {{-- Printable Content --}}
        <div class="printable-content-a4-portrait">
            {{-- FIRST ROW,  FOR TITLE --}}
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="bd-highlight">
                        <h3 class="card-header">Detail of User with id : {{ $data->id }}</h3>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 250px;"  scope="col" class="bg-dark text-white">Name</th>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Email</th>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Phone Number</th>
                                    <td>{{ $data->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Is Active</th>
                                    <td>
                                        @if ($data->is_active)
                                            <span class="badge rounded-pill bg-success"> Yes </span>
                                        @else
                                            <span class="badge rounded-pill bg-danger"> No </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col" class="bg-dark text-white">Role</th>
                                    <td>
                                        @foreach ($data->listRoles() as $role)
                                            @if (strcasecmp($role, 'ADMINISTRATOR') == 0)
                                                <span class="badge rounded-pill bg-label-danger m-1">
                                                    {{ $role }}
                                                </span>
                                            @else
                                                <span class="badge rounded-pill bg-label-primary m-1">
                                                    {{ $role }}
                                                </span>
                                            @endif
                                            <br />
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @if (config('constant.CRUD.DISPLAY_TIMESTAMPS'))
                            @include('components.crud-timestamps', $data)
                        @endif
                    </div>

                </div>


            </div>
        </div>
    </div>



    </div>

@endsection
