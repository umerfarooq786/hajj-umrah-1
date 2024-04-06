<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" type="text/css">
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('images/logo.png') }}" style="width: 100%; max-width: 200px" />
                            </td>

                            <td>
                                Created: {{ now() }} <br />
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
                <td>Makkah Hotel Room Price </td>
                <td>300 SAR</td>
            </tr>

            <tr class="item">
                <td>Makkah Hotel Room Cost </td>
                <td>300 SAR</td>
            </tr>
            <tr class="item">
                <td>Makkah Hotel Room Per Day Cost </td>
                <td>300 SAR</td>
            </tr>
            <tr class="item">
                <td>Meals Cost </td>
                <td>300 SAR</td>
            </tr>
            <tr class="item">
                <td>Transport Cost </td>
                <td>300 SAR</td>
            </tr>
            <tr class="item">
                <td>Visa Cost </td>
                <td>300 SAR</td>
            </tr>
            <tr class="item">
                <td>Visa Cost Per Person </td>
                <td>300 SAR</td>
            </tr>

            <tr class="total">
                <td></td>

                <td>Total: $385.00</td>
            </tr>
        </table>
    </div>
</body>

</html>
