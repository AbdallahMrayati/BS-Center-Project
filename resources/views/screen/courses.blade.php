@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }} | {{ __('content.Courses') }}
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li><a href="{{ route('categories.index') }}">{{ __('content.Categories') }}</a></li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" alt="" />
                <li>{{ $category->title }}</li>
            </ul>
        </div>
    </div>
    <div class="hero-container hero-courses">
        <div class="container">
            <h1>{{ $category->title }}</h1>
            {{ $category->description }}
        </div>
    </div>

    <div class="courses-section container">
        <div class="courses-section-head">
            <p>Courses Specializes in {{ $category->title }}</p>
            <div class="search-area">
                <input type="text" class="search-area-input" placeholder="{{ __('content.Search for courses') }}" />
                <img src="{{ asset('assets/icons/search.svg') }}" />
            </div>
        </div>
        <div class="courses-items">
            @if ($categoryCourses->count() > 0)
                @foreach ($categoryCourses as $item)
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
@endsection

@section('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slug = @json($category->slug);
            const url = `/categories/${slug}/courses`;
            console.log("in scripte -------------")
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log("in scripte -------------")
                    console.log("in scripte -------------")
                    console.log(data)
                    const container = document.querySelector(".courses-items");
                    container.innerHTML = ''; // Clear the container before adding new data

                    data.courses.forEach(item => {
                        container.innerHTML += `
                        <a class="course-item" href='/course/${item.slug}'>
                        <p>${item.title}</p>
                        <span href='/course/${item.slug}'>
                            <img src="/assets/icons/arrow.svg" alt="" />
                        </span>
                        </a>
                    `;
                    });
                })
                .catch(error => console.error('Error fetching Couses:', error));
        });
    </script> --}}
@endsection
