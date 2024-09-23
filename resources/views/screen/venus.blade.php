@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }} | {{ __('content.Venus') }}
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li><a href="{{ route('cities.index') }}">{{ __('content.Venus') }}</a></li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
            </ul>
        </div>
    </div>

    {{-- Search Section --}}
    <div class="hero-container hero-venus">
        <div class="container">
            <div>
                <h1>{{ __('content.Explore Our Venue') }}</h1>
            </div>
            @include('includes.search-form', ['searchRoute' => route('cities.index')])
        </div>
    </div>

    {{-- Search Results --}}
    @include('includes.search-results', ['timings' => $timings])

    {{-- Venus List --}}
    <section>
        <div class="container">
            <div class="venus-cards-container">
                @foreach ($cities as $city)
                    <a class="venus-card" href="{{ route('city.show', ['slug' => $city->slug]) }}">
                        <img src="{{ $city->getFirstMediaUrl('images') }}" alt="{{ $city->image_alt }}" class="card-img" />
                        <div>
                            <span href="{{ route('city.show', ['slug' => $city->slug]) }}">
                                <img src="{{ asset('assets/icons/arrow.svg') }}" alt="" />
                            </span>
                            <h3>{{ $city->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
