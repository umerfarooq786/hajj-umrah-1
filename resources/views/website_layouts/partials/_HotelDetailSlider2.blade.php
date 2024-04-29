<swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
    thumbs-swiper=".mySwiper2" space-between="10" navigation="true">
    {{-- @foreach ($hotel_images as $image) --}}
    <swiper-slide>
        <img src="{{ asset('uploads/WhatsApp Image 2024-02-21 at 12.27.15_c83d03ef.jpg') }}">
    </swiper-slide>
    <swiper-slide>
        <img src="{{ asset('uploads/WhatsApp Image 2024-02-21 at 12.27.15_c83d03ef.jpg') }}">
    </swiper-slide>
    {{-- @endforeach --}}
</swiper-container>

<swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true" watch-slides-progress="true">
    {{-- @foreach ($hotel_images as $image) --}}
    <swiper-slide>
        <img src="{{ asset('uploads/WhatsApp Image 2024-02-21 at 12.27.15_c83d03ef.jpg') }}">
    </swiper-slide>
    <swiper-slide>
        <img src="{{ asset('uploads/WhatsApp Image 2024-02-21 at 12.27.15_c83d03ef.jpg') }}">
    </swiper-slide>
    {{-- @endforeach --}}


</swiper-container>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
