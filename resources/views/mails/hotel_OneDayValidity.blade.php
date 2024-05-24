<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Room Validity About To Expire In 1 Day</title>
</head>
<body>
    <h2>Hotel Rooms Validity About To Expire In 1 Day</h2>
    <p>Hotel Name: {{ $formData->hotel['name'] }}</p>
    <p>Note: {{ $formData->hotel['note'] }} </p>
    <p>City: {{ $formData->hotel['city'] }}</p>
    <p>Validity Start: {{ $formData['validity_start'] }}</p>
    <p>Validity End: {{ $formData['validity_end'] }}</p>
</body>
</html>