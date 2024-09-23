@extends('layouts.app')

@section('title')
{{ config('app.name', 'BSC') }} | Request Online
@endsection

@section('content')
    <div class="breadcrumb-bar">
    <div class="about-header container">
      <ul>
        <li><a href="./categories.html">Categories</a></li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>courses</li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>{{ $course->category->title }}</li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>{{ $course->title }}</li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>Request Online</li>
      </ul>
    </div>
  </div>

  <div class="hero-container hero-forms">
    <div class="container">
      <h1>Request Online</h1>
      <p><li>{{ $course->title }}</li></p>
    </div>
  </div>

  <section class="form-container form-online-container">
    <form action="{{ route('request-online.store') }}" method="POST">
    @csrf
      <div>
        <div class="form-title">
          <h2>Contact Information</h2>
        </div>
        <div class="form-inputs online">
          <div class="input-container">
            <label for="name">Full Name</label>
            <input
              type="text"
              placeholder="Full Name"
              id="name"
              name="full_name"
            />
          </div>
          <div class="input-container">
            <label for="number">Phone number</label>
            <div class="select-box" id="select-box-1">
              <div class="selected-option">
                <div>
                  <span class="callcode"></span>
                </div>
                <input
                  type="tel"
                  name="phone_number"
                  id="tel"
                  class="tel"
                  placeholder="Phone Number"
                />
              </div>
              <div class="options" id="options-1">
                <input
                  type="text"
                  class="search-box"
                  placeholder="Search Country Name"
                />
                <ol></ol>
              </div>
            </div>
          </div>
          <div class="input-container">
            <label for="email">Email</label>
            <input
              type="email"
              placeholder="hello@creative-tim.com"
              id="email"
              name="email"
            />
          </div>
          <div class="input-container">
            <label for="company">Company</label>
            <input
              type="text"
              placeholder="Company"
              id="company"
              name="company_name"
            />
          </div>
          <div class="input-container">
            <label for="subject">Subject</label>
            <input
              type="text"
              placeholder="123456789"
              name="subject"
              id="subject"
            />
          </div>
          <div class="input-container">
            <label for="location">Location</label>
            <input
              type="text"
              placeholder="Dubai"
              name="location"
              id="location"
            />
          </div>
          <div class="input-container" style="position: relative">
            <label for="category">Category</label>
            <input
              type="hidden"
              value="{{ $course->category->id }}"
              id="category"
              name="category_id"
            />
            <input
              type="text"
              value="{{ $course->category->title }}"
              id="category"
              readonly
            />
          </div>
          <div class="input-container" style="position: relative">
            <label for="course">Course</label>
            <input
              type="hidden"
              value="{{ $course->id }}"
              id="course_id"
              name="course_id"
            />
            <input
              type="text"
              value="{{ $course->title }}"
              id="course"
              readonly
            />
          </div>
          </div>
          <div class="input-container">
            <label for="date">Date</label>
            <input type="date" placeholder="12-5" id="date" name="date" />
          </div>
        </div>
        <div class="textarea">
          <label for="message">How can we help you?</label>
          <textarea
            id="message"
            name="message"
            placeholder="Describe your problem in at least 250 characters"
          ></textarea>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit">Send</button>
        <div class="g-recaptcha" data-sitekey="your_site_key"></div>
      </div>
    </form>
  </section>

@endsection

@section('scripts')
<!--recaptcha library  -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
  function onSubmit(token) {
    document.getElementById("demo-form").submit();
  }
</script>
<script
  src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
  async
  defer
></script>
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
@endsection
