@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }} | {{ __('content.Course') }}
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li><a href="{{ route('categories.index') }}">{{ __('content.categories') }}</a></li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" alt="" />
                <li>
                    @if ($course->category && $course->category->slug)
                        <a href="{{ route('courses.index', ['slug' => $course->category->slug]) }}">{{ __('content.Courses') }}</a>
                    @else
                        <a href="#">{{ __('content.Courses') }}</a>
                    @endif
                </li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" alt="" />
                <li>{{ $course->title }}</li>
            </ul>
        </div>
    </div>
    
<section class="hero-single-course">
    @if ($course->image)
        <img src="{{ asset($course->image) }}" alt="{{ $course->image_alt }}" />
    @else
        @php
            // Check if the category has media and get the first one
            $firstImageUrl = null;
            if ($course->category->media->isNotEmpty()) {
                $firstImage = $course->category->media->first(); // Use the first() method to get the first media item
                $firstImageUrl = $firstImage->original_url; // Get the original URL attribute of the first media item
            }
        @endphp
        @if ($firstImageUrl)
            <img src="{{ asset($firstImageUrl) }}" alt="{{ $course->image_alt }}" />
        @else
            <img src="/assets/imgs/bg-blog.webp" alt="default image" />
        @endif
    @endif
    <div class="course-hero-title">
        <div>
            <h1>{{ $course->h1 }}</h1>
            <p>{{ $course->title }}</p>
        </div>
    </div>
</section>



       <section class="course-table container">
        <div class="flex-between">
            <div class="popup-bg" onclick="hidePopup()"></div>
            <div id="popup-3" class="form-popup popup">
                <form action="{{ route('download.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div>
                        <div class="form-title">
                            <h2>Download Brochure</h2>
                        </div>
                        <div class="form-inputs">
                            <div class="input-container">
                                <label for="name">Full Name</label>
                                <input type="text" placeholder="Full Name" id="name" name="name" />
                            </div>
                            <div class="input-container">
                                <label for="number">Phone number</label>
                                <div class="select-box" id="select-box-1">
                                    <div class="selected-option">
                                        <div>
                                            <span class="callcode"></span>
                                        </div>
                                        <input type="tel" name="phone" id="tel" class="tel"
                                            placeholder="Phone Number" />
                                    </div>
                                    <div class="options" id="options-1">
                                        <input type="text" class="search-box" placeholder="Search Country Name" />
                                        <ol></ol>
                                    </div>
                                </div>
                            </div>
                            <div class="input-container">
                                <label for="email">Email</label>
                                <input type="email" placeholder="hello@creative-tim.com" name="email" id="position" />
                            </div>
                            <div class="input-container">
                                <label for="company">Company</label>
                                <input type="text" placeholder="Company" id="company" name="company_name" />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit">Send</button>
                        <div class="g-recaptcha" data-sitekey="your_site_key"></div>
                    </div>
                </form>
            </div>
            <div class="course-buttons">
                <button class="btn-primary" type="button">
                    <a
                        href="{{ route('request-in-house.index', ['slug' => $course->slug]) }}">{{ __('content.Request In House') }}</a>
                </button>
                <button class="btn-primary" type="button">
                    <a href="{{ route('request-online.index', ['slug' => $course->slug]) }}">
                        {{ __('content.Request Online') }}</a>
                </button>
            </div>
        </div>
        <div class="table-container" data-slug="{{ $course->slug }}">
            <table id="row-table">
                <tr>
                    <th>{{ __('content.City') }}</th>
                    <th>{{ __('content.Start Date') }}</th>
                    <th>{{ __('content.End Date') }} </th>
                    <th>{{ __('content.Price') }}</th>
                    <th>{{ __('content.Register') }}</th>
                    <th>{{ __('content.Enquire') }}</th>
                    <th>{{ __('content.Download & Print') }}</th>
                </tr>
                @foreach ($timings as $item)
                    <tr>
                        <td>{{ $item->city->title }}</td>
                        <td>{{ $item['date_from'] }}</td>
                        <td>{{ $item['date_to'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>
                            <a href="{{ route('register.index', $item['id']) }}"
                                class="table-btn">{{ __('content.Register') }}</a>
                        </td>
                        <td>
                            <a href="{{ route('enquire.index', $item->course->slug) }}"
                                class="table-btn">{{ __('content.Enquire') }}</a>
                        </td>
                        <td>
                            <a style="cursor: pointer" class="table-btn"
                                onclick="showPopup()">{{ __('content.Download & Print') }}
                                <img src="/assets/icons/download.svg" class="downloadIcon" />
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
        <button class="btn-primary see-more-btn">{{ __('content.See More') }}</button>
    </section>

    <section class="container">
        <div class="course-content">
            <h3>{{ __('content.Overview') }}</h3>
            <ul class="group-1">
                {{ $course->overview }}
            </ul>
        </div>
        <div class="course-content">
            <h3>{{ __('content.Objective') }}</h3>
            <ul>
                {{ $course->objectives }}
            </ul>
        </div>
        <span
            style="
        display: block;
        width: 89%;
        margin: auto;
        height: 1px;
        background-color: #d9d9d9;
      "></span>
    </section>

    <section class="search-courses">
        <div class="container">
            <div class="course-card-title">
                <h2>Related Courses</h2>
                @if ($course->category && $course->category->slug)
                    <a href="{{ route('courses.index', ['slug' => $course->category->slug]) }}">{{ __('content.See All') }}</a>
                @else
                    <a href="#">{{ __('content.See All') }}</a>
                @endif
            </div>
            <div class="courses-container">
                @foreach ($relatedCourses as $item)
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
@endsection

