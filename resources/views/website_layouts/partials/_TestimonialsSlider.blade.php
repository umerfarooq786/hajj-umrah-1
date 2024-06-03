<swiper-container class="testimonialsSwiperContainer mt-5 " pagination="true" pagination-clickable="true" space-between="30"
    style="--swiper-navigation-color: red; --swiper-pagination-color: red">
    @foreach ($testimonial as $index => $testi)
        <swiper-slide>
            <div
                class="border border-gray-200 rounded-[5px] h-[400px] flex flex-col items-center justify-center p-[10px] text-center w-[400px] gap-5">
                <div class="flex mt-10 space-x-3">
                    <div class="h-[60px] w-[60px] rounded-full overflow-hidden">
                        @if ($testi->image != null)
                            <img src="{{ asset('uploads/' . $testi->image) }}" alt=""
                                class="h-full w-full object-cover object-top">
                        @else
                            <img src="{{ asset('app-assets/images/profile/profile_picture.jpeg') }}" alt=""
                                class="h-full w-full object-cover object-top">
                        @endif
                    </div>
                    <div class="pt-1 text-start">
                        <h4 class="text-red-500 font-semibold">{{ $testi->first_name }} {{ $testi->last_name }}</h4>
                        <p class="text-[12px]">{{ $testi->designation }}</p>
                    </div>
                </div>
                <p class="text-gray-500 text-[15px]">
                    @if (strlen($testi->content) > 100)
                        {{ substr($testi->content, 0, 100) }}
                        <span id="dots-{{ $index }}">...</span><span id="more-{{ $index }}"
                            class="hidden">{{ substr($testi->content, 100) }}</span>
                        <button onclick="toggleReadMore({{ $index }})" id="readMoreBtn-{{ $index }}"
                            class="text-blue-500 hover:text-blue-700 focus:outline-none">Read more</button>
                    @else
                        {{ $testi->content }}
                    @endif
                </p>
            </div>
        </swiper-slide>
    @endforeach

</swiper-container>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<script>
    const swiperE2 = document.querySelector('.testimonialsSwiperContainer')
    Object.assign(swiperE2, {
        slidesPerView: 1,
        // spaceBetween: 40,

        // navigation: { 
        //   clickable: true,        
        // },

        breakpoints: {
            "@0.00": {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            "@0.75": {
                slidesPerView: 2,
                spaceBetween: 0,
            },
            "@1.00": {
                slidesPerView: 2,
                spaceBetween: 0,
            },
            "@1.50": {
                slidesPerView: 3,
                spaceBetween: 0,
            },
        },
    });


    swiperE2.initialize();



    // for showing read more content on testimonial
    function toggleReadMore(index) {
        var dots = document.getElementById("dots-" + index);
        var moreText = document.getElementById("more-" + index);
        var btnText = document.getElementById("readMoreBtn-" + index);

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.classList.add("hidden");
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.classList.remove("hidden");
        }
    }
</script>
