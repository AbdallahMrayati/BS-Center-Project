@extends('layouts.app')

@section('title')
{{ config('app.name', 'BSC') }} | Enquire Now
@endsection

@section('content')
<div class="breadcrumb-bar">
    <div class="about-header container">
      <ul>
        <li><a href="./categories.html">Categories</a></li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>courses</li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>Healthcare Management</li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>Risk Management for Medical Devices</li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>Enquire</li>
      </ul>
    </div>
</div>

<div class="hero-container hero-forms">
    <div class="container">
      <h1>Enquire Now</h1>
      <p>{{ $course->h1 }}</p>
    </div>
</div>

<section class="form-container">
    <form action="{{ route('enquire.store') }}" method="POST">
    @csrf
      <div>
        <div class="form-title">
          <h2>Contact Information</h2>
        </div>
        <div class="form-inputs">
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

          <div class="input-container" style="position: relative">
            <label for="course">Course</label>
            <!-- Hidden input to include course_id -->
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
            <label for="company">Company </label>
            <input
              type="text"
              placeholder="Company"
              id="company"
              name="company"
            />
          </div>
          <div class="input-container">
            <label for="city">City</label>
            <input type="text" placeholder="Dubai" id="city" name="city" />
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
<script>
      const dropItem = document.querySelectorAll(".drop-down");
      const lists = document.querySelectorAll(".drop-list");
      const listItems = document.querySelectorAll(".drop-list li");
      dropItem.forEach((el, index) => {
        el.addEventListener("click", () => {
          lists[index].classList.toggle("show-list");
        });
      });
      listItems.forEach((li, index) => {
        li.addEventListener("click", () => {
          document.getElementById("course").value = li.innerHTML;
          lists.forEach((el, index) => {
            lists[index].classList.remove("show-list");
          });
        });
      });
</script>
@endsection
