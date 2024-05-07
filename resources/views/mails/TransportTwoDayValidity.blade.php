<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transport Validity About To Expire In 2 Days</title>
</head>

<body>

    <?php
    $routeItem = $formData['route']; ?>


    <h2>Transport Validity About To Expire In Two Days</h2>
    <p><b>Transport Type:</b> {{ $formData->vehicles->name }}</p>

    <p><b>Route:</b> {{ $formData->route->name }}</p>

    @foreach ($formData['costs'] as $costItem)
        @php
            $validityDate = \Carbon\Carbon::parse($costItem['validity_end']);
            $currentDate = \Carbon\Carbon::now();
            $daysDifference = $validityDate->diffInDays($currentDate);
        @endphp

        @if ($daysDifference == 1)
            <p><b>Cost:</b> SAR {{ $costItem['cost'] }} </p>
            <p><b>Validit Till:</b> {{ $costItem['validity_end'] }}</p>
        @endif
    @endforeach
</body>

</html>
