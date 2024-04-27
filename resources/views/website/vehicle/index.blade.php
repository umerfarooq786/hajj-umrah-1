<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles and Transports</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Assuming you are using Laravel Mix for CSS -->
</head>

<body>
    <div class="container mt-4">
        <h1>Vehicles and Their Transports</h1>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Vehicle Name</th>
                    <th>Image</th>
                    <th>Route Name</th>
                    <th>Route Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicle as $vehicle)
                    <tr>
                        <td>{{ $vehicle->name }}</td>
                        <td>
                            @if ($vehicle->image)
                                <img src="{{ asset('uploads/' . $vehicle->image) }}" alt="Vehicle Image" width="100">
                            @else
                                No image available
                            @endif
                        </td>
                        @if ($vehicle->transport)
                            @foreach ($vehicle->transport as $transport)
                                <td>{{ $transport->route->name }}</td>
                                <td>{{ $transport->costs->last()->cost }}</td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
