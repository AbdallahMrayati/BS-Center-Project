@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }} | {{ __('content.Categories') }}
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li><a class="main-li" href="{{ route('home.index') }}">{{ __('content.Categories') }}</a></li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
            </ul>
        </div>
    </div>

    {{-- Search --}}
    <div class="hero-container hero-categories">
        <div class="container">
            <div>
                <h1>{{ __('content.All Categories') }}</h1>
            </div>
            @include('includes.search-form', ['searchRoute' => route('categories.index')])
        </div>
    </div>

    {{-- Search Results --}}
    @include('includes.search-results', ['timings' => $timings])

    {{-- Categores list --}}
    <section class="categories-section">
        <div class="container">
            <div class="categories-cards" id="category-data" data-categories='@json($categories)'>
                @foreach ($categories as $item)
                    <a class="category-card" href="{{ route('courses.index', $item->slug) }}" title="category-name">
                        <img src="{{ $item['media_url'] }}" alt="{{ $item['image_alt'] }}">
                        <div class="card-overlay">
                            <h3>{{ $item['title'] }}</h3>
                            {!! $item['description'] !!}
                            <span class="line-card"></span>
                            <span href="{{ route('courses.index', $item->slug) }}" class="category-card-arrow"><img
                                    src="/assets/icons/arrow.svg" alt="" /></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
