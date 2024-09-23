@extends('layouts.app')

@section('title')
{{ config('app.name', 'BSC') }} | Contact
@endsection

@section('content')

<div class="breadcrumb-bar">
    <div class="about-header container">
      <ul></ul>
    </div>
</div>

<section class="contact">
  <div class="map-desktop">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28883.73386784415!2d55.261109!3d25.187478!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69d0d69e8d93%3A0x8f0fe5aa20493ae4!2sThe%20Prism!5e0!3m2!1sen!2sse!4v1723002947827!5m2!1sen!2sse"
      width="100%"
      height="880"
      style="border: 0"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
  </div>

    <section class="contact-form">
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div>
                <div class="form-title">
                    <h2>Contact us</h2>
                </div>
                <div class="form-inputs">
                    <div class="input-container">
                        <label for="name">Full Name</label>
                        <input type="text" placeholder="Name" id="name" name="full_name" />
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
                        <label for="country">Country</label>
                        <input
                            type="text"
                            placeholder="Country"
                            id="country"
                            name="country"
                        />
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
                        <label for="subject">Subject</label>
                        <input
                            type="text"
                            placeholder="Subject"
                            id="subject"
                            name="subject"
                        />
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
</section>

<div class="map-mobile">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28883.73386784415!2d55.261109!3d25.187478!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69d0d69e8d93%3A0x8f0fe5aa20493ae4!2sThe%20Prism!5e0!3m2!1sen!2sse!4v1723002947827!5m2!1sen!2sse"
      width="100%"
      height="100%"
      style="border: 0"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
</div>

@endsection
