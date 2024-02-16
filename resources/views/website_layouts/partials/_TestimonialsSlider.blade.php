<swiper-container class="testimonialsSwiperContainer " pagination="true" pagination-clickable="true" space-between="30"
    >
    <swiper-slide>
      <div class="border border-gray-200 rounded-[5px] h-[400px] flex flex-col items-center justify-center p-[10px] text-center">
          <p class="text-gray-500 text-[15px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
          <div class="flex mt-10 space-x-3">
              <div class="h-[60px] w-[60px] rounded-full overflow-hidden">
                <img src="{{asset('images/about/team1.jpg')}}" alt="" class="h-full w-full  object-cover object-top">
              </div>
              <div class="pt-1 text-start">
                  <h4 class="text-red-500 font-semibold">Ali Hassan</h4>
                  <p class="text-[12px]">CEO</p>
              </div>
          </div>
      </div>      
    </swiper-slide>
    <swiper-slide>
      <div class="border border-gray-200 rounded-[5px] h-[400px] flex flex-col items-center justify-center p-[10px] text-center">
          <p class="text-gray-500 text-[15px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
          <div class="flex mt-10 space-x-3">
              <div class="h-[60px] w-[60px] rounded-full overflow-hidden">
                <img src="{{asset('images/about/team1.jpg')}}" alt="" class="h-full w-full  object-cover object-top">
              </div>
              <div class="pt-1 text-start">
                  <h4 class="text-red-500 font-semibold">Ali Hassan</h4>
                  <p class="text-[12px]">CEO</p>
              </div>
          </div>
      </div>      
    </swiper-slide>
    <swiper-slide>
      <div class="border border-gray-200 rounded-[5px] h-[400px] flex flex-col items-center justify-center p-[10px] text-center">
          <p class="text-gray-500 text-[15px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
          <div class="flex mt-10 space-x-3">
              <div class="h-[60px] w-[60px] rounded-full overflow-hidden">
                <img src="{{asset('images/about/team1.jpg')}}" alt="" class="h-full w-full  object-cover object-top">
              </div>
              <div class="pt-1 text-start">
                  <h4 class="text-red-500 font-semibold">Ali Hassan</h4>
                  <p class="text-[12px]">CEO</p>
              </div>
          </div>
      </div>      
    </swiper-slide>
    <swiper-slide>
      <div class="border border-gray-200 rounded-[5px] h-[400px] flex flex-col items-center justify-center p-[10px] text-center">
          <p class="text-gray-500 text-[15px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
          <div class="flex mt-10 space-x-3">
              <div class="h-[60px] w-[60px] rounded-full overflow-hidden">
                <img src="{{asset('images/about/team1.jpg')}}" alt="" class="h-full w-full  object-cover object-top">
              </div>
              <div class="pt-1 text-start">
                  <h4 class="text-red-500 font-semibold">Ali Hassan</h4>
                  <p class="text-[12px]">CEO</p>
              </div>
          </div>
      </div>      
    </swiper-slide>
    <swiper-slide>
      <div class="border border-gray-200 rounded-[5px] h-[400px] flex flex-col items-center justify-center p-[10px] text-center">
          <p class="text-gray-500 text-[15px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
          <div class="flex mt-10 space-x-3">
              <div class="h-[60px] w-[60px] rounded-full overflow-hidden">
                <img src="{{asset('images/about/team1.jpg')}}" alt="" class="h-full w-full  object-cover object-top">
              </div>
              <div class="pt-1 text-start">
                  <h4 class="text-red-500 font-semibold">Ali Hassan</h4>
                  <p class="text-[12px]">CEO</p>
              </div>
          </div>
      </div>      
    </swiper-slide>
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
</script>