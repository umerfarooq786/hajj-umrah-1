<div class="flex flex-col items-center justify-center">
    <!-- <div class="bg-second w-full text-white p-5 flex flex-col items-center justify-center gap-5">
        <h4 class="text-first text-center font-bold text-3xl uppercase">FASTLINE Travel & Tours</h4>
        <p>Keep always updated with our fresh blog posts</p>
        <div class="flex flex-col md:flex-row items-center gap-3">
            <input type="email" placeholder="Enter your Email" class="bg-black py-2 px-5 rounded-md md:w-[350px] lg:w-[500px] text-white placeholder-white outline-none border border-gray1 focus:border-first">
            <button class="bg-black text-first py-2 px-7 rounded-md hover:bg-first hover:text-black">SUBSCRIBE</button>
        </div>
    </div> -->
    <div
        class="bg-[#1f1f1f] text-gray2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 w-full px-10 py-10  lg:px-40 lg:py-10 gap-10">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-[60px]">
            <p class="mt-5"><b>Fastline Travels & Tours:</b> We handle the travel, so you can focus on the experience
            </p>
        </div>
        <div>
            <h4 class="text-white">Contact Us</h4>
            <a href="https://maps.app.goo.gl/TFG3fDbW3aKDdyks6" target="_blank"
                class="mt-5 flex items-center gap-3 text-sm hover:text-first">
                <img src="{{ asset('images/footer-icon1.png') }}" alt="logo" class="h-[25px]">
                <span>14-15 Ground Floor, Ashrafi Heights, Main Market Gulberg ll, Lahore, Pakistan</span>
            </a>
            <a href="https://wa.me/923218430304?text=Hello%2C%20I%20am%20contacting%20you%20from%20the%20website!"
                target="_blank" class="mt-5 flex items-center gap-3 text-sm hover:text-first">
                <img src="{{ asset('images/footer-icon2.png') }}" alt="logo" class="h-[25px]">
                <span>+92 321-8430304</span>
            </a>
            <a href="mailto:fastlinetourss.pk@gmail.com" target="_blank"
                class="mt-5 flex items-center gap-3 text-sm hover:text-first">
                <img src="{{ asset('images/footer-icon3.png') }}" alt="logo" class="h-[25px]">
                <span>fastlinetourss.pk@gmail.com</span>
            </a>
            <div class="flex items-center justify-center gap-5 mt-5">
                <a href="https://www.facebook.com/profile.php?id=61558157542228" target="_blank"> <img
                        src="{{ asset('images/footer-fb.png') }}" alt="" height="40" width="40"> </a>
                <a href="https://www.instagram.com/fastline.pk/" target="_blank"> <img
                        src="{{ asset('images/footer-instagram.png') }}" alt="" height="40" width="40">
                </a>
                <a href="https://wa.me/923218430304?text=Hello%2C%20I%20am%20contacting%20you%20from%20the%20website!"
                    target="_blank"> <img src="{{ asset('images/footer-whatsapp.png') }}" alt="" height="40"
                        width="40"> </a>

            </div>
            {{-- <a href="https://www.facebook.com/profile.php?id=61558157542228" target="_blank"><img
                    src="{{ asset('images/home/facebook-f.svg') }}" class="text-white bg-white" alt=""
                    class="hover:scale-90 transition-all"></a>
            <a href="https://www.instagram.com/fastline.pk/" target="_blank"><img
                    src="{{ asset('images/home/instagram.svg') }}" alt=""
                    class="hover:scale-90 transition-all"></a> --}}
        </div>
        <div class="flex flex-col gap-3">
            <h4 class="text-white mb-3">Useful Links</h4>
            <a href="{{ url('home_page') }}" class=" hover:text-first text-sm">Home</a>
            <a href="{{ url('about') }}" class=" hover:text-first text-sm">About</a>
            {{-- <a href="{{ url('home_page#special-offers') }}" class=" hover:text-first text-sm">Packages</a> --}}
            {{-- <a href="{{ url('custom-package') }}" class=" hover:text-first text-sm">Calculate</a> --}}
            {{-- <a href="{{ url('hotel-city/makkah') }}" class=" hover:text-first text-sm">Hotels in Makkah</a> --}}
            {{-- <a href="{{ url('hotel-city/madinah') }}" class=" hover:text-first text-sm">Hotels in Madinah</a> --}}
            {{-- <a href="{{ url('hotel-city/jeddah') }}" class=" hover:text-first text-sm">Hotels in Jeddah</a> --}}
            {{-- <a href="{{ url('transportation') }}" class=" hover:text-first text-sm">Transportation</a> --}}
            {{-- <a href="{{ url('airlines') }}" class=" hover:text-first text-sm">Airlines</a> --}}
            <a href="{{ url('contact/#contactForm') }}" class=" hover:text-first text-sm">Contact Us</a>
        </div>
        <div>
            <!-- <h4 class="text-white mb-5">Gallery</h4> -->
            <img src="{{ asset('images/footer-gallery.png') }}" alt="logo" class="h-[200px]">
        </div>
    </div>
    <div class="bg-[#1f1f1f] text-gray2 flex items-center justify-center w-full px-10 py-10  lg:px-40 lg:py-10 gap-10">
        <img src="{{ asset('images/certifications/certification1.png') }}" class="h-[70px] w-[100px] object-contain"
            alt="">
        <img src="{{ asset('images/certifications/certification2.png') }}" class="h-[70px] w-[100px] object-contain"
            alt="">

        <img src="{{ asset('images/certifications/certification3.png') }}" class="h-[70px] w-[100px] object-contain"
            alt="">

    </div>
    <div class="bg-first text-white w-full p-5 text-center font-semibold text-xs">
        <p>COPYRIGHT © 2024, FASTLINE TRAVEL & TOURS - ALL RIGHTS RESERVED</p>
    </div>
</div>
