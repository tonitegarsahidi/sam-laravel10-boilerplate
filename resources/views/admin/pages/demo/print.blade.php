@extends('admin.template-blank', ['searchNavbar' => false])

@section('page-title', 'Detail of User')

@section('header-code')

    <style>
        @media print {
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
            }

            /* Adjust print margins */
            @page {
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
            padding: 10mm;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .printable-content-a4-landscape {
            width: 297mm;
            min-height: 210mm;
            margin: 0 auto;
            padding: 10mm;
            box-sizing: border-box;
        }
    </style>

    <script>
        function printPdf() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p', 'mm', 'a4');

    html2canvas(document.querySelector('.printable-content-a4-portrait')).then(canvas => {
        let imgData = canvas.toDataURL('image/png');
        doc.addImage(imgData, 'PNG', 10, 10, 190, 297);  // Adjust these dimensions as needed
        doc.save('user-detail.pdf');
    });
}

    </script>

@endsection

{{-- MAIN CONTENT PART --}}
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- FOR BREADCRUMBS --}}


        {{-- Print and PDF buttons --}}
        <div class="mb-1">
            @include('admin.components.breadcrumb.simple', $breadcrumbs)
            <button class="btn btn-primary no-print" onclick="window.print()">Print A4</button>
            <button class="btn btn-secondary no-print" id="downloadPdfBtn" onclick="printPdf()">Download PDF</button>
        </div>
    </div>

    {{-- Printable Content --}}
    <div class="printable-content-a4-portrait">

        {{-- FIRST ROW,  FOR TITLE --}}
        <div class="d-flex justify-content-between">
            <div class="bd-highlight">
                <h3 class="card-header">Detail of User with id : {{ $data->id }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col" class="bg-dark text-white">Name</th>
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
                            <tr>
                                <th scope="col" class="bg-dark text-white">Created At</th>
                                <td>{{ $data->created_at->isoFormat('dddd, D MMMM Y - HH:mm:ss') }}</td>
                            </tr>
                            <tr>
                                <th scope="col" class="bg-dark text-white">Updated At</th>
                                <td>{{ $data->updated_at->isoFormat('dddd, D MMMM Y - HH:mm:ss') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
    </div>

    </div>

@endsection

@section('footer-code')
    <script>
        function printPdf() {
            const {
                jsPDF
            } = window.jspdf;

            // Create a new jsPDF document
            const doc = new jsPDF('p', 'mm', 'a4');

            // Select the printable content
            let printableContent = document.querySelector('.printable-content-a4-portrait').innerHTML;

            // Sanitize the content using DOMPurify to prevent XSS
            let sanitizedContent = DOMPurify.sanitize(printableContent);

            // Use the sanitized content to generate the PDF
            doc.html(sanitizedContent, {
                callback: function(doc) {
                    doc.save('user-detail.pdf');
                },
                x: 10,
                y: 10,
                width: 190
            });
        }
    </script>


@endsection
