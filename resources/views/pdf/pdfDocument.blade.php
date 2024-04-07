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

            <tr class="heading">
                <td>Item</td>

                <td>Price</td>
            </tr>

            <tr class="item">
                <td>Makkah Hotel Room Cost </td>
                <td>{{ $makkah_hotel_room_price }} SAR</td>
            </tr>

            <tr class="item">
                <td>Makkah Hotel Room Cost Per Day </td>
                <td>{{ $makkah_hotel_room_perday_price }} SAR</td>
            </tr>

            <tr class="item">
                <td>Madinah Hotel Room Cost </td>
                <td>{{ $madinah_hotel_room_price }} SAR</td>
            </tr>

            <tr class="item">
                <td>Makkah Hotel Room Cost Per Day </td>
                <td>{{ $madinah_hotel_room_perday_price }} SAR</td>
            </tr>

            <tr class="item">
                <td>Meal Cost </td>
                <td>{{ $mealPrices }} SAR</td>
            </tr>

            <tr class="item">
                <td>Transport Cost </td>
                <td>{{ $transport_cost }} SAR</td>
            </tr>

            <tr class="item">
                <td>Total Visa Cost </td>
                <td>{{ $visa }} SAR</td>
            </tr>

            <tr class="item">
                <td>Visa Cost Per Person</td>
                <td>{{ number_format($visa_per_person, 0, '.', '') }} SAR</td>
            </tr>

            <tr class="total">
                <td></td>

                <td>Total: {{ $total_cost }} SAR</td>
            </tr>
        </table>
    </div>
</body>

</html>
