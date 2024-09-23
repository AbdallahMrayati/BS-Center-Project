@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }}
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li>
                    <a href="{{ route('cities.index') }}">Venus</a>
                </li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" alt="" />
                <li>Training Courses in {{ $city->title }}</li>
            </ul>
        </div>
    </div>
    <section class="hero-single-course">
        <img src="{{ asset($city->image) }}" alt="" />
        <div class="course-hero-title">
            <div>
                <h1>Training courses in {{ $city->title }}</h1>
                <p>select categories in {{ $city->title }}</p>
            </div>
        </div>
    </section>

    <section class="categories-section">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
                {{-- <p>select categories in {{ $city->title }}</p> --}}
            </div>
<div class="categories-cards" id="category-data">
    @foreach ($categoriesByCity as $item)
    <a class="category-card" href="{{ route('showCoursesViaCity.index', [$city->slug, $item->slug]) }}" title="category-name">

            <img src="{{ $item->media_url }}" alt="{{ $item->image_alt }}">
            <div class="card-overlay">
                <h3>{{ $item->title }}</h3>
                <p>{!! $item->description !!} </p>
                <span class="line-card"></span>
                <span href="{{ route('courses.index', $item->slug) }}" class="category-card-arrow">
                    <img src="/assets/icons/arrow.svg" alt="" />
                </span>
            </div>
        </a>
    @endforeach
</div>


        </div>
    </section>

    <section>
        <div class="section-title container">
            <h2>All courses in {{ $city->title }}</h2>
        </div>
        <div class="courses-section container city">
            <div class="courses-section-head">
                <p>Courses Specializes in {{ $city->title }}</p>
                <div class="search-area">
                    <input type="text" class="search-area-input" placeholder="Search for courses" />
                    <img src="{{ asset('assets/icons/search.svg') }}" />
                </div>
            </div>
            <div class="courses-items">
                @if ($coursesByCity->count() > 0)
                    @foreach ($coursesByCity as $item)
                        <a class="course-item" href="{{ route('course.show', $item['slug']) }}">
                            <p>{{ $item->title }}</p>
                            <span href="{{ route('course.show', $item['slug']) }}">
                                <img src="/assets/icons/arrow.svg" alt="" />
                            </span>
                        </a>
                    @endforeach
                @else
                    <a class="course-item" href="">
                        <p style="color:rgb(121, 121, 121)">No courses available</p>
                    </a>
                @endif

            </div>
        </div>
    </section>
@endsection

