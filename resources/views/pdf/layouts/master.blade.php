<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: arial, sans-serif;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        #header, #footer {
            position: fixed;
        }

        #header {
            left: 0;
            top: -350px;
            right: 0;
            height: 150px;
        }

        #footer {
            text-align: justify;
            bottom: 30px;
            padding: 2px;
            font-size: 11px;
        }

        #footer td{
            font-size: 11px;
            padding: 2px;
            vertical-align: top;
        }

        .table th, .table td {
            padding: 3px;
            border: 1px solid black;
        }

        .page {
            text-align: center;
            font-size: 14px;
            margin: 0;
        }

        .pagenum:before {
            content: counter(page);
        }

        .page-break {
            page-break-after: always;
        }

        table.print-friendly tr td, table.print-friendly tr th {
            page-break-inside: avoid;
        }

    </style>

    @yield('styles')
</head>
<body>

    <div id="header">
        @section('header')

            <table>
                <tr>
                    <td style="vertical-align: bottom;">
                        <h1 style="margin: 0;">{{trans('admin.Stundennachweis')}}</h1>
                    </td>
                    <td style="text-align: right;">
                        <img src="{{ asset('assets/img/logo_big.jpg') }}" alt="" style="height:100px; width:auto; display:block;">
                    </td>
                </tr>
            </table>

            <hr>
        @show
    </div>

    <div id="footer">
        @section('footer')
            @include('pdf.partials.footer')
        @show
    </div>

    <div id="content">
        @yield('content')
    </div>

</body>
</html>
