<style>


</style>

<div>
    @if($bannerCourses->isNotEmpty())
    <section id="hero1" class="hero">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($bannerCourses as $item)
                <div class="swiper-slide">
                    <div class="img-container">
                        <img src="{{ $item['course_image'] }}" alt="{{ $item['image_alt'] }}">
                        <div class="overlay"></div>
                        <div class="content">
                            <h1 style="width: 100%;">{{ $item['h1'] }}</h1>
                            <p>{{ $item['date_from'] }}</p>
                            <p>{{ $item['city_title'] }}</p>
                                     <div class="buttons-hero">
                                        <a href="{{ route('register.index', ['id' => $item['id']]) }}"
                                            class="register-button">{{ __('content.Register Now') }}</a>
                                        <a href="{{ route('course.show', ['slug' => $item['course_slug']]) }}"
                                            class="learn-more-button">{{ __('content.Read More') }}</a>
                                    </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
    </section>
    <div class="swiper-button-next hero-btn"></div>
    <div class="swiper-button-prev hero-btn"></div>
    @else
    <script>console.log("No banner timings.");</script>
    @endif
</div>
