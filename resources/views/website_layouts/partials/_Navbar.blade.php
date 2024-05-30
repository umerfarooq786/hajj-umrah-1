<div class="bg-white w-full text-black flex items-center justify-between p-5 md:py-5 md:pr-5 lg:mt-10">

    <div class="w-full  lg:w-[20%] flex items-center justify-between md:justify-self-center">
        <a href="{{ url('home_page') }}"><img src="{{ asset('images/logo.png') }}" alt="logo" class="h-[60px]"></a>
        <img src="{{ asset('images/home/burger-icon2.png') }}" alt="" class="cursor-pointer h-[30px] lg:hidden"
            onclick="showNav()">
    </div>
    <div class=" flex-1 text-first w-full  hidden lg:flex items-center justify-center gap-6 ">
        <a href="{{ url('home_page') }}" class="font-semibold hover:underline text-sm">HOME</a>
        <a href="{{ url('about') }}" class="font-semibold hover:underline text-sm">ABOUT</a>
        <!-- <a href="/custom-package" class="font-semibold hover:underline text-sm">CALCULATE</a>     -->
        <div href="#" class="relative font-semibold text-sm py-5 cursor-pointer group">
            UMRAH
            <div
                class="absolute bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                <a href="{{ url('custom-package') }}"
                    class="font-semibold hover:bg-first hover:text-white text-first text-sm p-2 ">Personalized
                    package</a>
                <a href="{{ url('predefined-package/umrah') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">All Packages</a>
                <a href="{{ url('predefined-package/umrah/special-offer-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Special Offers</a>
                <a href="{{ url('predefined-package/umrah/5-star-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">5 Star Packages</a>
                <a href="{{ url('predefined-package/umrah/4-star-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">4 Star Packages</a>
                <a href="{{ url('predefined-package/umrah/3-star-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">3 Star Packages</a>
                <a href="{{ url('predefined-package/umrah/standard-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Standard Packages</a>
                <a href="{{ url('predefined-package/umrah/economy-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Economy Packages</a>
            </div>
        </div>
        <div href="#" class="relative font-semibold text-sm py-5 cursor-pointer group">
            HAJJ
            <div
                class="absolute bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                <a href="{{ url('custom-package-hajj') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Personalized
                    package</a>
                <a href="{{ url('predefined-package/hajj') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">All Packages</a>
                <a href="{{ url('predefined-package/hajj/special-offer-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Special Offers</a>
                <a href="{{ url('predefined-package/hajj/5-star-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">5 Star Packages</a>
                <a href="{{ url('predefined-package/hajj/4-star-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">4 Star Packages</a>
                <a href="{{ url('predefined-package/hajj/3-star-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">3 Star Packages</a>
                <a href="{{ url('predefined-package/hajj/standard-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Standard Packages</a>
                <a href="{{ url('predefined-package/hajj/economy-packages') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Economy Packages</a>
            </div>
        </div>
        <div href="#" class="relative font-semibold text-sm py-5 cursor-pointer group">
            HOTELS
            <div
                class="absolute bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                <a href="{{ url('hotel-city/makkah') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Hotels In
                    Makkah</a>
                <a href="{{ url('hotel-city/madinah') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Hotels In
                    Madinah</a>
                <a href="{{ url('hotel-city/jeddah') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Hotels In
                    Jeddah</a>

            </div>
        </div>
        <a href="{{ url('transportation') }}" class="font-semibold hover:underline text-sm">TRANSPORTATION</a>
        <div href="#" class="relative font-semibold text-sm py-5 cursor-pointer group">
            TOURS
            <div
                class="absolute bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                <a href="{{ url('tourPackage/international-tours') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">International Tours</a>
                <a href="{{ url('tourPackage/domestic-tours') }}"
                    class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Domestic Tours</a>

            </div>
        </div>
        <a href="{{ url('airlines') }}" class="font-semibold hover:underline text-sm">AIRLINES</a>
        <a href="{{ url('contact/#contactForm') }}" class="font-semibold hover:underline text-sm">CONTACT US</a>
    </div>
    <div class="hidden lg:flex items-center justify-end gap-5y gap-3 lg:gap-7 ">
        <a href="https://www.facebook.com/profile.php?id=61558157542228" target="_blank"><img
                src="{{ asset('images/home/facebook-f.svg') }}" alt=""
                class="hover:scale-90 transition-all"></a>
        <a href="https://www.instagram.com/fastline.pk/" target="_blank"><img
                src="{{ asset('images/home/instagram.svg') }}" alt=""
                class="hover:scale-90 transition-all"></a>
        <!-- <a href="#"><img src="{{ asset('images/home/youtube.svg') }}" alt="" class="hover:scale-90 transition-all"></a> -->
        <!-- <div class="flex gap-3 items-center">
                <a href="#"><img src="{{ asset('images/home/pakistan.png') }}" alt="" class=""></a>
                <p class="text-sm font-semibold">PK</p>
            </div> -->
    </div>
</div>
{{-- Red Patti --}}
{{-- <div class="bg-first text-white w-full h-[70px] hidden md:flex items-center justify-center gap-10 ">
    <a href="{{ url('home_page') }}" class="font-semibold hover:underline text-sm">HOME</a>
    <a href="{{ url('about') }}" class="font-semibold hover:underline text-sm">ABOUT</a>
    <!-- <a href="/custom-package" class="font-semibold hover:underline text-sm">CALCULATE</a>     -->
    <div href="#" class="relative font-semibold text-sm py-5 cursor-pointer group">
        UMRAH
        <div
            class="absolute bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
            <a href="{{ url('custom-package') }}"
                class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Personalized package</a>
            <a href="{{ url('predefined-package/umrah') }}"
                class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Packages</a>
        </div>
    </div>
    <div href="#" class="relative font-semibold text-sm py-5 cursor-pointer group">
        HAJJ
        <div
            class="absolute bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
            <a href="{{ url('custom-package-hajj') }}"
                class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Personalized package</a>
            <a href="/predefined-package/hajj"
                class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Packages</a>
        </div>
    </div>
    <div href="#" class="relative font-semibold text-sm py-5 cursor-pointer group">
        HOTELS
        <div
            class="absolute bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
            <a href="{{ url('hotel-city/makkah') }}"
                class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Hotels In
                Makkah</a>
            <a href="{{ url('hotel-city/madinah') }}"
                class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Hotels In
                Madinah</a>
            <a href="{{ url('hotel-city/jeddah') }}"
                class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Hotels In
                Jeddah</a>
        </div>
    </div>
    <a href="{{ url('airlines') }}" class="font-semibold hover:underline text-sm">AIRLINES</a>
    <a href="{{ url('contact') }}" class="font-semibold hover:underline text-sm">CONTACT US</a>
</div> --}}

<!-- Mobile Menu starts -->
<div id="mobileMenu" class="fixed top-0 left-0 w-full h-screen overflow-hidden lg:hidden">
    <div class="bg-white text-black w-full h-full flex flex-col items-center justify-start px-10 py-10">
        <div class="w-full flex items-center justify-between">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-[60px]">
            <img src="{{ asset('images/home/cross-icon3.png') }}" alt=""
                class="h-[30px] lg:hidden cursor-pointer" onclick="hideNav()">
        </div>

        <div class="w-full py-10 flex flex-1 flex-col items-center justify-center gap-3">
            <a href="{{ url('home_page') }}" class="text-lg hover:underline">HOME</a>
            <a href="{{ url('about') }}" class="text-lg hover:underline">ABOUT</a>
            <div href="#" class="relative text-lg  cursor-pointer group">
                UMRAH
                <div
                    class="absolute z-10 bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                    <a href="{{ url('custom-package') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Personalized package</a>
                    <a href="{{ url('predefined-package/umrah') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">All Packages</a>
                    <a href="{{ url('predefined-package/umrah/special-offer-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Special Offers</a>
                    <a href="{{ url('predefined-package/umrah/5-star-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">5 Star
                        Packages</a>
                    <a href="{{ url('predefined-package/umrah/4-star-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">4 Star
                        Packages</a>
                    <a href="{{ url('predefined-package/umrah/3-star-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">3 Star
                        Packages</a>
                    <a href="{{ url('predefined-package/umrah/standard-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Standard
                        Packages</a>
                    <a href="{{ url('predefined-package/umrah/economy-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Economy
                        Packages</a>
                </div>
            </div>
            <div href="#" class="relative text-lg  cursor-pointer group">
                HAJJ
                <div
                    class="absolute z-10 bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                    <a href="{{ url('custom-package-hajj') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Personalized package</a>
                    <a href="{{ url('predefined-package/hajj') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">All Packages</a>
                    <a href="{{ url('predefined-package/hajj/special-offer-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Special Offers</a>
                    <a href="{{ url('predefined-package/hajj/5-star-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">5 Star
                        Packages</a>
                    <a href="{{ url('predefined-package/hajj/4-star-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">4 Star
                        Packages</a>
                    <a href="{{ url('predefined-package/hajj/3-star-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">3 Star
                        Packages</a>
                    <a href="{{ url('predefined-package/hajj/standard-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Standard
                        Packages</a>
                    <a href="{{ url('predefined-package/hajj/economy-packages') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Economy
                        Packages</a>
                </div>
            </div>
            <div href="#" class="relative text-lg  cursor-pointer group">
                HOTELS
                <div
                    class="absolute z-10 bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                    <a href="{{ url('hotel-city/makkah') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">Hotels In
                        Makkah</a>
                    <a href="{{ url('hotel-city/madinah') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Hotels In
                        Madinah</a>
                    <a href="{{ url('hotel-city/jeddah') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Hotels In
                        Jeddah</a>

                </div>
            </div>

            <a href="{{ url('transportation') }}" class="text-lg hover:underline">TRANSPORTATION</a>
            <div href="#" class="relative text-lg  cursor-pointer group">
                TOURS
                <div
                    class="absolute z-10 bg-white w-[200px] text-black hidden group-hover:flex flex-col border border-r-gray-200 shadow-md top-[100%] left-0  ">
                    <a href="{{ url('tourPackage/international-tours') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 ">International Tours</a>
                    <a href="{{ url('tourPackage/domestic-tours') }}"
                        class="font-semibold hover:bg-first hover:text-white text-sm p-2 text-first">Domestic Tours</a>
                </div>
            </div>
            <a href="{{ url('airlines') }}" class="text-lg hover:underline">AIRLINES</a>
            <a href="{{ url('contact/#contactForm') }}" class="text-lg hover:underline">CONTACT US</a>
        </div>

        <div class="flex items-center gap-5 ">
            <a href="https://www.facebook.com/profile.php?id=61558157542228"><img
                    src="{{ asset('images/home/facebook-f.svg') }}" alt="" class=""></a>
            <a href="https://www.instagram.com/fastline.pk/"><img src="{{ asset('images/home/instagram.svg') }}"
                    alt="" class=""></a>
        </div>


    </div>
</div>
<!-- Mobile Menu ends -->



<script>
    window.onload = function() {
        hideNav();
    }

    function hideNav() {
        document.getElementById("mobileMenu").style.display = 'none';
    }

    function showNav() {
        document.getElementById("mobileMenu").style.display = 'block';
    }
</script>
