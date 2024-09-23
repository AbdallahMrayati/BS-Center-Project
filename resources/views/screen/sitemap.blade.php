@extends('layouts.app')

@section('title')
{{ config('app.name', 'BSC') }} | Sitemap
@endsection

@section('content')
    <div class="breadcrumb-bar">
    <div class="about-header container">
      <ul>
        <li><a href="/index.html">Home</a></li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>sitemap</li>
      </ul>
    </div>
  </div>

  <section class="sitemap">
    <div class="container">
      <h1>Sitemap</h1>
      <div class="site-details">
        <div class="sitemap-items-top">
          <h2>Pages</h2>
          <div class="sitemap-lists">
            <ul>
              <li>Home</li>
              <li>Categoires</li>
              <li>Venus</li>
              <li>Cities</li>
            </ul>
            <ul>
              <li>Blogs</li>
              <li>Services</li>
              <li>Contacts</li>
              <li>Trusted by</li>
            </ul>
            <ul>
              <li>privacy policy</li>
              <li>Terms & conditions</li>
              <li>frequently asked question</li>
              <li>About us</li>
            </ul>
          </div>
        </div>
        <div class="sitemap-items-center">
          <h2>Categories</h2>
          <div class="sitemap-lists">
            <ul>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
            </ul>
            <ul>
              <li>Sales and Marketing</li>
              <li>Oil & Gas and Petroleum</li>
              <li>Projects Management</li>
              <li>Sales and Marketing</li>
              <li>Oil & Gas and Petroleum</li>
              <li>Projects Management</li>
            </ul>
            <ul>
              <li>Oil & Gas and Petroleum</li>
              <li>Terms & conditions</li>
              <li>Healthcare Management</li>
              <li>Projects Management</li>
              <li>Oil & Gas and Petroleum</li>
              <li>Healthcare Management</li>
              <li>Projects Management</li>
            </ul>
          </div>
          <h2>Courses specializes</h2>
          <div class="sitemap-lists">
            <ul>
              <li class="list-title">Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
            </ul>

            <ul>
              <li class="list-title">Quality and Productivity</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
            </ul>

            <ul>
              <li class="list-title">Leadership</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
            </ul>

            <ul>
              <li class="list-title">Projects Management</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
            </ul>

            <ul>
              <li class="list-title">Healthcare Management</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
            </ul>

            <ul>
              <li class="list-title">Oil & Gas and Petroleum</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
              <li>Sales and Marketing</li>
              <li>Quality and Productivity</li>
              <li>Leadership</li>
            </ul>
          </div>
        </div>
        <div class="sitemap-items-center sitemap-items-bottom">
          <h2>Venue</h2>
          <div class="sitemap-lists">
            <ul>
              <li>Madrid</li>
              <li>Amsterdam</li>
              <li>Amman</li>
            </ul>
            <ul>
              <li>Dubai</li>
              <li>London</li>
              <li>Istanbul</li>
            </ul>
            <ul>
              <li>Kuala Lumpur</li>
              <li>Casa Blanca</li>
            </ul>
          </div>
          <h2>City</h2>
          <div class="sitemap-lists">
            <ul>
              <li class="list-titel">lorem ipsum</li>
              <li>lorem ipsum dolor</li>
              <li>lorem ipsum dolor</li>
            </ul>
            <ul>
              <li>lorem ipsum dolor</li>
              <li>lorem ipsum dolor</li>
              <li>lorem ipsum dolor</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
