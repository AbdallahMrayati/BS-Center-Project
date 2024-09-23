@extends('layouts.app')

@section('title')
{{ config('app.name', 'BSC') }} | Terms & conditions
@endsection

@section('content')
    <div class="breadcrumb-bar">
    <div class="about-header container">
      <ul>
        <li><a href="/index.html">Home</a></li>
        <img src="{{ asset('assets/icons/arrow.svg') }}" />
        <li>Terms & conditions</li>
      </ul>
    </div>
  </div>

  <section class="privacy">
    <div class="privacy-main container">
      <div>
        <h1>Terms & conditions</h1>
        <span>lorem ipsum dolor sit amet, co</span>
      </div>
      <div class="privacy-items">
        <div class="privacy-item">
          <h2>Personal Statement</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempos Lorem ipsum dolor sitamet, consectetur adipiscing
            elit, sed do eius mod eius consectetur adipiscing elit, sed do
            eiusmod temporLorem ipsum dolor sit amet,
          </p>
        </div>
        <div class="privacy-item">
          <h2>What are ' cookies ' ?</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod pos temLorem ipsum dolor sitamet, consectetur adipiscing
            elit, sed do eiusmod s dotemporLorem ipsum dolor sit amet,
            consectetur adipiscing elit, sed do elit, sed do eiusmod tempos
            Lorem amet,consectetur adipiscing elit, sed do s amet, Lorem ipsum
            dolor sit amet, consectetur adipiscing elit, sed do eiusmod amet,
          </p>
        </div>
        <div class="privacy-item">
          <h2>Why do we use cookies ?</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempos Lorem ipsum dolor sitamet, consectetur adipiscing
            elit, sed do eius mod eius consectetur adipiscing elit, sed do
            eiusmod temporLorem ipsum dolor sit amet,
          </p>
        </div>
        <div class="privacy-item">
          <h2>What information do we gather specifically ?</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempos Lorem ipsum dolor sitamet, consectetur adipiscing
            elit, sed do eiusmod eius
          </p>
        </div>
        <div class="privacy-item">
          <h2>hat third - partius do we share your information with ?</h2>
          <p>
            consectetur adipiscing elit, sed do eiusmod temporLorem ipsum
            dolor sit amet,
          </p>
        </div>
        <div class="privacy-item">
          <h2>Website Media Disclosure of Your Information Updates</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod pos temLorem ipsum dolor sitamet, consectetur adipiscing
            elit, sed do eiusmod s dotemporLorem ipsum dolor sit amet,
            consectetur adipiscing elit, sed do elit, sed do eiusmod tempos
            Lorem amet, consectetur adipiscing elit, sed do s amet, Lorem
            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            amet,
          </p>
        </div>
        <div class="privacy-item">
          <h2>Why do we use cookies ?</h2>
          <p>
            consectetur adipiscing elit, sed do eiusmod temporLorem ipsum
            dolor sit amet,
          </p>
        </div>
      </div>
    </div>
  </section>
@endsection
