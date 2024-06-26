<swiper-container class="mySwiper" autoplay-delay="2500" autoplay-disable-on-interaction="false" pagination="true"
    effect="coverflow" grab-cursor="true" centered-slides="true" slides-per-view="auto" coverflow-effect-rotate="50"
    coverflow-effect-stretch="0" coverflow-effect-depth="100" coverflow-effect-modifier="1"
    coverflow-effect-slide-shadows="true">
    @foreach ($package as $packages)
        <swiper-slide>
            <a
                href="{{ $packages->type === 'umrah' ? url('predefined-package/umrah') : url('predefined-package/hajj') }}">
                <img src="{{ asset('uploads/' . $packages->image) }}" />
            </a>
        </swiper-slide>
    @endforeach

</swiper-container>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
