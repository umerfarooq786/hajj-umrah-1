<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Room Validity About To Expire In 3 Days</title>
</head>
<body>
    <h2>Hotel Room Validity About To Expire In 3 Day</h2>
    <p>Hotel Name: {{ $formData->hotel['name'] }}</p>
    <p>Note: {{ $formData->hotel['note'] }} </p>
    <p>City: {{ $formData->hotel['city'] }}</p>
    <p>Validity: {{ $formData['validity_end'] }}</p>
    <p>Price: {{ $formData['weekdays_price'] }}</p>
</body>
</html>