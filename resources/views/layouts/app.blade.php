<!DOCTYPE html>

@if (LaravelLocalization::getCurrentLocale() == 'en')
    <html lang="en">
@else
    <html lang="en" dir="rtl">
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <!-- Css File -->
    <link rel="icon" href="{{ asset('assets/favIcon.svg') }}" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('ar.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('css/city.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/course.css') }}">
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/privacy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sitemap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/venus.css') }}">
    @yield('style')
    <!-- Swiper js CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <a href="https://api.whatsapp.com/send?phone=971506252099&text=Check%20out%20this%20message%20with%20the%20image%20link%3A%20http%3A%2F%2Fexample.com%2Fpath%2Fto%2Fimage.jpg"
        target="_blank">
        <img class="whats-app" src="{{ asset('assets/imgs/whats.webp') }}" alt="whats-img"
            style="width:125px;height:auto;">
    </a>

    @include('includes.nav')
    {{-- @include('layouts.flashMessage') --}}
    @yield('content')

    @include('includes.footer')

    @yield('scripts')

    <script>
        document.querySelectorAll('a').forEach(function(a) {
            if (!a.textContent.trim() && !a.children.length) {
                a.remove();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>

    <script src="{{ asset('main.js') }}"></script>
    <script src="{{ asset('navBar.js') }}"></script>
    <script src="{{ asset('js/blog.js') }}"></script>
    <script src="{{ asset('js/course.js') }}"></script>
    <script src="{{ asset('js/courses.js') }}"></script>
    <script src="{{ asset('js/createCardGrid.js') }}"></script>
    <script src="{{ asset('js/dropdown.js') }}"></script>
    <script src="{{ asset('js/phoneNumber.js') }}"></script>
    <script src="{{ asset('js/slideCards.js') }}"></script>
    <script src="{{ asset('js/statistics.js') }}"></script>
    <script src="{{ asset('js/venus.js') }}"></script>
</body>

</html>
