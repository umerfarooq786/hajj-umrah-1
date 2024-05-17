<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" type="text/css"> --}}
    <style>
        .invoice-box {
            max-width: 1300px;
            /* width: 100%; */
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            color: #555;
        }


        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        /* tables start */
        .accomodation-table {
            width: 100%;
        }

        .transportation-table {
            width: 60% !important;
        }

        .total-table {
            width: 60% !important;
        }

        .accomodation-table,
        .transportation-table,
        .total-table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* Style for table headers */
        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: left;
            border-bottom: 2px solid #ddd;
            font-size: 14px;
            /* Bottom border for header */
        }

        /* Style for table rows */
        td {
            padding: 8px;
            font-size: 12px !important;
            text-align: left !important;
            border-bottom: 1px solid #ddd;
            /* Bottom border for rows */
        }

        /* Alternate row color */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Hover effect */
        tr:hover {
            background-color: #ddd;
        }

        /* Style for first column */
        td:first-child {
            font-weight: bold;
        }

        /* tables end */
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
                sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                {{-- <img src="{{ asset('images/logo.png') }}" style="width: 100%; max-width: 200px" /> --}}
                                <img src="https://res.cloudinary.com/ddxbvngpc/image/upload/v1712501587/nej3hzcul3cenxlqkfnp.png"
                                    style="width: 100%; max-width: 200px" />

                            </td>

                            <td style="">
                                Created: {{ now()->format('d-m-Y') }} <br />
                                Invoice #: <span style="font-size: 10px !important">{{ $unique_invoice }}</span> <br>
                                Email: <span style="font-size: 10px !important">{{ $email }}</span><br>
                                Contact #: <span style="font-size: 10px !important">{{ $contact }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- logic starts --}}
        <div class="report">
            @if ($currency == 'SAR')
                @if ($show_detail == '1')
                    <h4 class="">Accomodation Details</h4>
                    <div class="">
                        {{-- Accomodation Table --}}
                        <table class="accomodation-table">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        City
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Hotel Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Room Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Meals
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check In
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check Out
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rate
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        M.Rate
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($hotelBookingResults)

                                    @foreach ($hotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makkah_rate'>
                                                <b>SAR</b> {{ $result['rate'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makkah_m_rate'>
                                                <b>SAR</b> {{ $result['meal_rate'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($hotelBookingResults)
                                    @foreach ($MadinahhotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='madinah_rate'>
                                                <b>SAR</b> {{ $result['rate'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makdinah_m_rate'>
                                                <b>SAR</b> {{ $result['meal_rate'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($hotelBookingResults)
                                    @foreach ($JeddahhotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='jaddah_rate'>
                                                <b>SAR</b> {{ $result['rate'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='jaddah_m_rate'>
                                                <b>SAR</b> {{ $result['meal_rate'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Transportation table starts --}}
                    <h4 class="">Transportation Details</h4>
                    <div class="">
                        {{-- Accomodation Table --}}
                        <table class="transportation-table">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Route
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Vehicle
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rate
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($RoutesData)
                                    @foreach ($RoutesData as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['date'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['route'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['vehicle'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id="vehicle_rate">
                                                <b>SAR</b> {{ $result['rate'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- Grand Total table starts --}}
                <h4 class="">Total Charges</h4>
                <div class="">
                    {{-- Accomodation Table --}}
                    <table class="total-table">
                        <tbody>
                            @foreach ($grandtotal as $result)
                                <tr class="">
                                    <th scope="row" class="">
                                        Accommodation
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="accommodation">
                                        <b>SAR</b> {{ $result['accommodation'] }}
                                        {{-- {{ $result->accommodation }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Meals
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="meals">
                                        <b>SAR</b> {{ $result['meals'] }}
                                        {{-- {{ $result->meals }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Transportation
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="transportation">
                                        <b>SAR</b> {{ $result['transportation'] }}
                                        {{-- {{ $result->transportation }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Total Visa Charges
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="visacharges">
                                        <b>SAR</b> {{ $result['visa'] }}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Grand Total Payable
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="total">
                                        <b>SAR</b> {{ $result['grandtotal'] }}
                                        {{-- {{ $result->grandtotal }} --}}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if ($currency == 'PKR')
                @if ($show_detail == '1')
                    <h4 class="">Accomodation Details</h4>
                    <div class="">
                        {{-- Accomodation Table --}}
                        <table class="accomodation-table">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        City
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Hotel Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Room Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Meals
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check In
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check Out
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rate
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        M.Rate
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($hotelBookingResults)

                                    @foreach ($hotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makkah_rate'>
                                                <b>PKR</b> {{ $result['rate'] * $sar_to_pkr}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makkah_m_rate'>
                                                <b>PKR</b> {{ $result['meal_rate'] * $sar_to_pkr }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($hotelBookingResults)
                                    @foreach ($MadinahhotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='madinah_rate'>
                                                <b>PKR</b> {{ $result['rate'] * $sar_to_pkr}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makdinah_m_rate'>
                                                <b>PKR</b> {{ $result['meal_rate'] * $sar_to_pkr}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($hotelBookingResults)
                                    @foreach ($JeddahhotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='jaddah_rate'>
                                                <b>PKR</b> {{ $result['rate'] * $sar_to_pkr}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='jaddah_m_rate'>
                                                <b>PKR</b> {{ $result['meal_rate'] * $sar_to_pkr}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Transportation table starts --}}
                    <h4 class="">Transportation Details</h4>
                    <div class="">
                        {{-- Accomodation Table --}}
                        <table class="transportation-table">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Route
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Vehicle
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rate
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($RoutesData)
                                    @foreach ($RoutesData as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['date'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['route'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['vehicle'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id="vehicle_rate">
                                                <b>PKR</b> {{ $result['rate'] * $sar_to_pkr}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- Grand Total table starts --}}
                <h4 class="">Total Charges</h4>
                <div class="">
                    {{-- Accomodation Table --}}
                    <table class="total-table">
                        <tbody>
                            @foreach ($grandtotal as $result)
                                <tr class="">
                                    <th scope="row" class="">
                                        Accommodation
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="accommodation">
                                        <b>PKR</b> {{ $result['accommodation'] * $sar_to_pkr}}
                                        {{-- {{ $result->accommodation }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Meals
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="meals">
                                        <b>PKR</b> {{ $result['meals'] * $sar_to_pkr}}
                                        {{-- {{ $result->meals }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Transportation
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="transportation">
                                        <b>PKR</b> {{ $result['transportation'] * $sar_to_pkr}}
                                        {{-- {{ $result->transportation }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Total Visa Charges
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="visacharges">
                                        <b>PKR</b> {{ $result['visa'] * $sar_to_pkr}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Grand Total Payable
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="total">
                                        <b>PKR</b> {{ $result['grandtotal'] * $sar_to_pkr}}
                                        {{-- {{ $result->grandtotal }} --}}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if ($currency == 'USD')
                @if ($show_detail == '1')
                    <h4 class="">Accomodation Details</h4>
                    <div class="">
                        {{-- Accomodation Table --}}
                        <table class="accomodation-table">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        City
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Hotel Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Room Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Meals
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check In
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Check Out
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rate
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        M.Rate
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($hotelBookingResults)

                                    @foreach ($hotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makkah_rate'>
                                                <b>USD</b> {{ $result['rate'] * $sar_to_usd}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makkah_m_rate'>
                                                <b>USD</b> {{ $result['meal_rate'] * $sar_to_usd}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($hotelBookingResults)
                                    @foreach ($MadinahhotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='madinah_rate'>
                                                <b>USD</b> {{ $result['rate'] * $sar_to_usd}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='makdinah_m_rate'>
                                                <b>USD</b> {{ $result['meal_rate'] * $sar_to_usd}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($hotelBookingResults)
                                    @foreach ($JeddahhotelBookingResults as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['city'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['hotel'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['room_type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['meals'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkin'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['checkout'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='jaddah_rate'>
                                                <b>USD</b> {{ $result['rate'] * $sar_to_usd}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id='jaddah_m_rate'>
                                                <b>USD</b> {{ $result['meal_rate'] * $sar_to_usd}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Transportation table starts --}}
                    <h4 class="">Transportation Details</h4>
                    <div class="">
                        {{-- Accomodation Table --}}
                        <table class="transportation-table">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Route
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Vehicle
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rate
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($RoutesData)
                                    @foreach ($RoutesData as $result)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['date'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['route'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                                {{ $result['vehicle'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                                id="vehicle_rate">
                                                <b>USD</b> {{ $result['rate'] * $sar_to_usd}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- Grand Total table starts --}}
                <h4 class="">Total Charges</h4>
                <div class="">
                    {{-- Accomodation Table --}}
                    <table class="total-table">
                        <tbody>
                            @foreach ($grandtotal as $result)
                                <tr class="">
                                    <th scope="row" class="">
                                        Accommodation
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="accommodation">
                                        <b>USD</b> {{ $result['accommodation'] * $sar_to_usd}}
                                        {{-- {{ $result->accommodation }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Meals
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="meals">
                                        <b>USD</b> {{ $result['meals'] * $sar_to_usd}}
                                        {{-- {{ $result->meals }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Transportation
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="transportation">
                                        <b>USD</b> {{ $result['transportation'] * $sar_to_usd}}
                                        {{-- {{ $result->transportation }} --}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Total Visa Charges
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="visacharges">
                                        <b>USD</b> {{ $result['visa'] * $sar_to_usd}}
                                    </th>

                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Grand Total Payable
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                        id="total">
                                        <b>USD</b> {{ $result['grandtotal'] * $sar_to_usd}}
                                        {{-- {{ $result->grandtotal }} --}}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        {{-- logic ends --}}
    </div>
</body>

</html>
