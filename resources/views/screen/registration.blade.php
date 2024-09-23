@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }} | Registration
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
                <li>courses</li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
                <li>{{ $timing->course->title }}</li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
                <li>{{ $timing->title }}</li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
                <li>Registration</li>
            </ul>
        </div>
    </div>

    <div class="hero-container hero-forms">
        <div class="container">
            <h1>Registration</h1>
            <p>{{ $timing->title }}</p>
        </div>
    </div>

    <section class="form-container">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div>
                <div class="form-title">
                    <h2>Contact Information</h2>
                </div>
                <div class="form-inputs">
                    <div class="input-container">
                        <label for="name">Full Name</label>
                        <input type="text" placeholder="Full Name" id="name" name="full_name" />
                        <input type="hidden" placeholder="Course timing" id="timing_id" name="timing_id"
                            value={{ $timing->id }} />
                    </div>
                    <div class="input-container">
                        <label for="number">Phone number</label>
                        <div class="select-box" id="select-box-1">
                            <div class="selected-option">
                                <div>
                                    <span class="callcode"></span>
                                </div>
                                <input type="tel" name="phone_number" id="tel" class="tel"
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
                        <input type="email" placeholder="hello@creative-tim.com" name="email" id="email" />
                    </div>
                    <div class="input-container">
                        <label for="position">Position</label>
                        <input type="text" placeholder="Position" id="position" name="position" />
                    </div>
                </div>
            </div>

            <div>
                <div class="form-title">
                    <h2>Company Information</h2>
                </div>
                <div class="form-inputs">
                    <div class="input-container">
                        <label for="company">CompanyName</label>
                        <input type="text" placeholder="Full Name" id="company" name="company_name" />
                    </div>
                    <div class="input-container">
                        <label for="city">City</label>
                        <input type="text" placeholder="Dubai" id="city" name="city" />
                    </div>
                    <div class="input-container">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="hello@creative-tim.com" />
                    </div>
                </div>
            </div>

            <div>
                <div class="form-title">
                    <h2>Instructor</h2>
                    <p>
                        The person who responsible for training and development in your
                        company
                    </p>
                </div>
                <div class="form-inputs">
                    <div class="input-container">
                        <label for="name2">Full Name</label>
                        <input type="text" placeholder="Full Name" id="name2" name="instructor_name" />
                    </div>
                    <div class="input-container">
                        <label for="number">Phone number</label>
                        <div class="select-box" id="select-box-2">
                            <div class="selected-option">
                                <div>
                                    <span class="callcode"></span>
                                </div>
                                <input type="tel" name="instructor_phone_number" placeholder="Phone Number" />
                            </div>
                            <div class="options" id="options-2">
                                <input type="text" class="search-box" placeholder="Search Country Name" />
                                <ol></ol>
                            </div>
                        </div>
                    </div>
                    <div class="input-container">
                        <label for="email2">Email</label>
                        <input type="email" placeholder="hello@creative-tim.com" name="instructor_email" id="email2" />
                    </div>
                    <div class="input-container">
                        <label for="position2">Position</label>
                        <input type="text" placeholder="Position" name="instructor_position" id="position2" />
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit">Send</button>
                {{-- <div class="g-recaptcha" data-sitekey="your_site_key"></div> --}}
            </div>
        </form>
    </section>
@endsection


@section('scripts')
    <!--recaptcha library  -->
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
    <script src="/navBar.js"></script>
    <script>
        // function onSubmit(token) {
        //     document.getElementById("demo-form").submit();
        // }
    </script>
    {{-- <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script> --}}
    {{-- <script
  src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
  async
  defer
></script> --}}
@endsection
