@extends('website_layouts.master')

@section('content')
    <div class="w-[95%] md:w-[80%]   mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 my-20">
        <a href="https://www.piac.com.pk" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/1-piac.png') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">PAKISTAN INTERNATIONAL AIRLINE</h4>
        </a>

        <a href="https://www.emirates.com/pk" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/2-emirates.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">EMIRATES AIRLINE</h4>
        </a>

        <a href="https://www.etihad.com/en" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/3-etihad.svg') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">ETIHAD AIRWAYS</h4>
        </a>

        <a href="https://www.qatarairways.com/en/book.html" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/4-qatar.PNG') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">QATAR AIRWAYS</h4>
        </a>

        <a href="https://www.thaiairways.com/en_TH/index.page" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/5-thai.png') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">THAI AIRWAYS</h4>
        </a>

        <a href="https://www.turkishairlines.com/en-int/flights/booking/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/6-turkish.PNG') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">TURKISH AIR</h4>
        </a>

        <a href="https://www.saudia.com/pages/BookNow " target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/7-saudia.png') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">SAUDI AIRLINE</h4>
        </a>

        <a href="https://www.airsial.com/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/8-airsial.png') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">AIR SIAL</h4>
        </a>

        <a href="https://www.airblue.com/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/9-airblue.svg') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">AIR BLUE</h4>
        </a>

        <a href="https://www.gulfair.com/en/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/10-gulf.PNG') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">GULF AIRLINE</h4>
        </a>

        <a href="https://www.omanair.com/en" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/11-oman.svg') }}" class="h-full w-full object-contain" alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">OMAN AIR</h4>
        </a>

        <a href="https://wwws.airfrance.ae/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/12-airfrance.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">AIR FRANCE</h4>
        </a>

        <a href="https://www.kenya-airways.com/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/13-kenya.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">KENYA AIRWAYS</h4>
        </a>

        <a href="https://www.kuwaitairways.com/en/book-a-flight" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/14-kuwait.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">KUWAIT AIRWAYS</h4>
        </a>

        <a href="https://www.egyptair.com/en/pages/homepage.aspx" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/15-egypt.png') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">EGYPT AIRWAYS</h4>
        </a>

        <a href="https://www.aa.com/homePage.do?locale=en_US" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/16-american.png') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">AMERICAN AIRLINE</h4>
        </a>

        <a href="https://www.singaporeair.com/en" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/17-singapore.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">SINGAPORE AIRLINES</h4>
        </a>

        <a href="https://www.qantas.com/au/en.html" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/18-kantas.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">QANTAS</h4>
        </a>

        <a href="https://www.flysaa.com/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/19-south.png') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">SOUTH AFRICAN AIRWAYS</h4>
        </a>

        <a href="https://www.swiss.com/de/de/homepage" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/20-swiss.svg') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">SWISS AIR</h4>
        </a>

        <a href="https://www.flyjinnah.com/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/21-flyjinnah.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">FLY JINNAH</h4>
        </a>

        <a href="https://www.srilankan.com/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/22-srilankan.png') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">SIRILANKAN AIRLINES</h4>
        </a>

        <a href="https://www.britishairways.com/travel/home/public/en_pk/" target="_blank"
            class="w-full border border-red-300 p-6 rounded-xl flex flex-col items-center justify-center gap-5  hover:shadow-lg">
            <div class=" h-[80px] w-[160px] ">
                <img src="{{ asset('images/airlines/23-british.PNG') }}" class="h-full w-full object-contain"
                    alt="">
            </div>
            <h4 class="text-red-500 font-semibold text-[16px] text-center">BRITISH AIRWAYS</h4>
        </a>


    </div>
@endsection


@section('script')
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
    @if (Session::get('success'))
        <script>
            $(document).ready(function() {
                toastr.success('<?php echo Session::get('success'); ?>', 'Zindawork Says', {
                    timeOut: 2000
                })
            });
        </script>
    @endif
@endsection
