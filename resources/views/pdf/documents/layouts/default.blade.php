<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">

    <style>

        body {
            font-family: arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        @page {
            margin: 160px 50px 140px;
        }

        #header, #footer {
            position: fixed;
        }

        #header {
            left: 0;
            top: -160px;
            height: 160px;
        }

        #footer {
            text-align: justify;
            padding: 2px;
            font-size: 11px;
            bottom: -140px;
            height: 140px;
        }

        #footer td{
            font-size: 11px;
            padding: 2px;
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
        <table style="margin-top: 30px;">
            <tr>
                <td style="vertical-align:bottom;">
                    <small><strong>Servite GmbH</strong>, Hohenzollernring 57, 50674 Köln</small>
                </td>
                <td style="text-align:right;">
                    <img src="{{ asset('assets/img/logo_big.jpg') }}" alt="Servite" style="height:100px; width:auto; display:block; margin-bottom: 10px">
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
