<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastLine (Travel & Tours)</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script src="{{ asset('js/app.js') }}"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    @include('admin_layouts.partials._script_admin')
    @yield('custom_styles')

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</head>

<body>
    @include('website_layouts.partials._HeroSlider')
    @yield('content')
    @include('website_layouts.partials._FooterSection')

    {{-- Fixed whatsapp button --}}
    <div class="fixed right-5 bottom-5 z-50">
        <a href="https://wa.me/923218430304?text=Hello%2C%20I%20am%20contacting%20you%20from%20the%20website!"
            target="_blank"> <img src="{{ asset('images/footer-whatsapp.png') }}" alt="" height="60"
                width="60"> </a>
    </div>
</body>

</html>
