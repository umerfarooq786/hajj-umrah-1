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
            max-width: 800px;
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

                            <td>
                                Created: {{ now()->format('d-m-Y') }} <br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>

                            </td>

                            <td>
                                To:
                                Guest User<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- logic starts --}}
        <div class="currency-content">
            @if ($show_detail == '1')
                <h4 class="font-bold self-start mt-5">Accomodation Details</h4>
                <div class="relative overflow-x-auto  border border-gray1 w-full self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                <h4 class="font-bold self-start mt-5">Transportation Details</h4>
                <div class="relative overflow-x-auto w-auto border border-gray1 self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
            <h4 class="font-bold mt-5 self-start">Total Charges</h4>
            <div class="relative overflow-x-auto w-auto border border-gray1 self-start ">
                {{-- Accomodation Table --}}
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @foreach ($grandtotal as $result)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Accommodation
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="accommodation">
                                    {{-- <b>SAR</b> {{ $result['accommodation'] }} --}}
                                    {{ $result->accommodation }}
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
                                    {{-- <b>SAR</b> {{ $result['meals'] }} --}}
                                    {{ $result->meals }}
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
                                    {{-- <b>SAR</b> {{ $result['transportation'] }} --}}
                                    {{ $result->transportation }}
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
                                    {{-- <b>SAR</b> {{ $result['grandtotal'] }} --}}
                                    {{ $result->grandtotal }}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- logic ends --}}
    </div>
</body>

</html>
