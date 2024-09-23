@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }}
@endsection



@section('content')

<style>
    .category-link {
        text-decoration: none;
        color: inherit;
    }
    .category-link:hover,
    .category-link:focus {
        color: inherit;
        /*tline: none;*/
    }
    .category-card h3,
    .category-card p {
        color: white;
    }
</style>
    {{-- Banner courses --}}
    @include('includes.isbanner')

    {{-- Search --}}
    <section class="search-section home-search-section">
        <div class="container">
             <h2>{{ __('content.Search For Your Course') }}</h2>
            <div class="home-search">
                @include('includes.search-form', ['searchRoute' => route('search.results')])
            </div>
        </div>
    </section>

    {{-- Search Results --}}
    {{-- @include('includes.search-results', ['timings' => $timings]) --}}


    {{-- Upcoming courses --}}
    <section class="search-courses home-courses">
        <div class="container">
              <h2>{{ __('content.Upcoming Courses') }}</h2>
            <div class="card-container">
                @foreach ($upcomingCourses as $item)
                    <a href="{{ route('course.show', $item['course_slug']) }}" class="card-link">
                        <div class="card">
                            <img src="{{ $item['course_image'] }}" alt="">
                            <div class="card-content">
                                <div class="card-title">{{ $item['course_title'] }}</div>
                                                               <div class="card-dates">
                                    <img src="/assets/icons/calender2.svg" alt="" />
                                    <span>
                                        {{ __('content.From') }}
                                        {{ \Carbon\Carbon::parse($item['date_from'])->format('d M') }}
                                        {{ __('content.to') }}
                                        {{ \Carbon\Carbon::parse($item['date_to'])->format('d M') }}
                                    </span>
                                    -
                                    <span>
                                        {{ \Carbon\Carbon::parse($item['date_from'])->format('Y') }}
                                    </span>
                                </div>
                                <div class="card-location">
                                    <img src="/assets/icons/location.svg" alt="" class="location-icon" />
                                    <span>{{ $item['city_title'] }}</span>
                                </div>
                                <div class="card-buttons">
                                    <a href="{{ route('register.index', $item['id']) }}"
                                        class="btn-primary">{{ __('content.Register Now') }}</a>
                                    <a href="{{ route('course.show', $item['course_slug']) }}"
                                        class="btn-secondary">{{ __('content.Read More') }}</a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- About us --}}
    {{-- About us --}}
    <section class="search-courses about-us">
        <div class="container">
            <div class="about">
                <div class="about-left">
                    <h2>{{ __('content.About BSC Project') }}</h2>
                    <p>{{ __('content.At BSC, we believe in the power of education to unlock human potential.') }}
                        {{ __('content.Our team of passionate educators and industry experts have curated a diverse range of courses tailored to empower learners at every stage') }}
                    </p>
                    <a href="{{ route('about') }}">{{ __('content.Learn More') }}</a>
                </div>
                <div class="about-right">
                    <div class="part-about">
                        <div>
                            <img src="{{ asset('assets/imgs/about/icon1.svg') }}" alt="">
                        </div>
                        <p>{{ __('content.Certification of completion') }}</p>
                    </div>
                    <div class="part-about">
                        <div>
                            <img src="{{ asset('assets/imgs/about/icon2.svg') }}" alt="">
                        </div>
                        <p>{{ __('content.Money Back Guarantee') }}
                        </p>
                    </div>
                    <div class="part-about">
                        <div>
                            <img src="{{ asset('assets/imgs/about/icon3.svg') }}" alt="">
                        </div>
                        <p>{{ __('content.32 Modules Access on') }}
                        </p>
                    </div>
                    <div class="part-about">
                        <div>
                            <img src="{{ asset('assets/imgs/about/icon4.svg') }}" alt="">
                        </div>
                        <p>{{ __('content.Access on all devices') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories --}}

    <section class="search-courses categories-home categories">
        <div class="container">
            <div class="section-title">
                  <h2>{{ __('content.Categories') }}</h2>
                <div class="arrows">
                    <div class="swiper-button-prev arrow-btn"></div>
                    <div class="swiper-button-next arrow-btn"></div>
                </div>
            </div>
        </div>
        <div class="swiper mySwiper2">
            <div class="swiper-wrapper wrap">
                @foreach ($categories as $item)
                    <a style="z-index : 6"href="{{ route('courses.index', $item->slug) }}">
                        <div class="swiper-slide">
                            <div class="category-card mx-5 ">
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['image_alt'] }}">
                                <div class="card-overlay">
                                    <h3>{{ $item['title'] }}</h3>
                                    {!! $item['description'] !!}
                                    <span class="line-card"></span>
                                    <a href="{{ route('courses.index', $item->slug) }}" class="category-card-arrow">
                                        <img src="./assets/icons/arrow.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


    </section>

    {{-- Our Success --}}
    <section class="search-courses success">
        <div class="container">
            <h2>{{ __('content.Our Success') }}</h2>
            <div class="statistics-list">
                <div class="statistics">
                    <p>10k</p>
                    <h5>{{ __('content.Students') }}</h5>
                </div>
                <div class="statistics">
                    <p>200</p>
                    <h5>{{ __('content.Chief experts') }}</h5>
                </div>
                <div class="statistics">
                    <p>17y</p>
                    <h5>{{ __('content.experience') }}</h5>
                </div>
                <div class="statistics">
                    <p>80%</p>
                    <h5>{{ __('content.Success') }}</h5>
                </div>
            </div>

    </section>

    {{-- Our Services --}}
    <section class="search-courses services">
        <div class="container">
             <h2>{{ __('content.Our Services') }}</h2>
            <div class="service-cards">
                <div class="service-card">
                    <div class="service-svg">
                        <img src="{{ asset('assets/icons/serv-icon1.svg') }}" alt="">
                    </div>
                     <h5>{{ __('content.Public') }}</h5>
                    <p><span>Lorem ipsum dolor sit amet, </span>consectetur adipiscing elit, sed do eiusmod tempor Lorem
                        ipsum dolor sit amet, consectetur adipiscing </p>
                </div>
                <div class="service-card">
                    <div class="service-svg">
                        <img src="{{ asset('assets/icons/serv-icon2.svg') }}" alt="">
                    </div>
                    <h5>Online</h5>
                    <p><span>Lorem ipsum dolor sit amet, </span>consectetur adipiscing elit, sed do eiusmod tempor Lorem
                        ipsum dolor sit amet, consectetur adipiscing </p>
                </div>
                <div class="service-card">
                    <div class="service-svg">
                        <img src="{{ asset('assets/icons/serv-icon3.svg') }}" alt="">
                    </div>
                    <h5>In-house</h5>
                    <p><span>Lorem ipsum dolor sit amet, </span>consectetur adipiscing elit, sed do eiusmod tempor Lorem
                        ipsum dolor sit amet, consectetur adipiscing </p>
                </div>
            </div>
    </section>

    {{-- FAQ  --}}
    <section class="search-courses faqs">
        <div class="container">
            <h2>FAQ</h2>
        </div>
        <div class="faqs-container">
               <h4>{{ __('content.frequently asked question') }}</h4>
            <div class="faq-container"></div>
        </div>
    </section>

    {{-- Trusted by  --}}
    <section class="search-courses trusted">
        <div class="container">
               <h2>{{ __('content.Trusted By') }}</h2>
        </div>
        <div class="swiper mySwiper-about">
            <div class="swiper-wrapper wrap2">
                <div class="swiper-slide"><img src="{{ asset('assets/imgs/logos/logo1.png') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/imgs/logos/logo2.png') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/imgs/logos/logo3.png') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/imgs/logos/logo4.png') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/imgs/logos/logo1.png') }}" alt=""></div>

            </div>
        </div>
    </section>
@endsection
