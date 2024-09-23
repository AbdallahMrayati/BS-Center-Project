@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }} | {{ __('content.Blogs') }}
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li><a href="{{ route('blogs.index') }}">{{ __('content.Blogs') }}</a></li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
            </ul>
        </div>
    </div>

    <div class="hero-container hero-blogs">
        <div class="container">
            <h1>{{ __('content.Explore Our Blogs') }}</h1>
        </div>
    </div>

    <section class="blogs-container container blogs-page">
        {{-- <swiper-container class="mySwiper swiper-cards" init="false"> --}}
        <!-- Swiper slides will be added dynamically -->
        @foreach ($blogs as $item)
            <div class="card-blogs">
                <img src="../assets/imgs/card-blog.png" alt="{{ $item['title'] }}" class="card-blog-img" />
                <div class="card-blog-content">
                    <h3>
                        {{ $item['title'] }}
                    </h3>
                    <div class="card-blog-desc">
                        @if (strlen($item->description) > 125)
                            <p>{{ Str::limit($item->description, 125, '...') }}</p>
                            <a href="{{ route('blog.show', $item->slug) }}">more</a>
                        @else
                            <p>{{ $item->description }}</p>
                        @endif
                    </div>
                    <div class="card-blog-footer">
                        <button><a href="{{ route('blog.show', $item->slug) }}">{{ __('content.Read More') }}</a></button>
                        <div class="card-blog-views">
                            <img src="../assets/icons/view.svg" alt="" />
                            <span>{{ $item['number_of_views'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- </swiper-container> --}}
        <div class="blogs-arrows">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
@endsection
