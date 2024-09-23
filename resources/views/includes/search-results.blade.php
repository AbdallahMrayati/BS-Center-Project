{{-- Search Results --}}

@if (request()->hasAny(['course_title', 'category_title', 'city_title', 'month', 'duration']))
    <section class="search-courses home-courses">
        <div class="container">
            <h2>Search Results</h2>
            @if (isset($timings) && $timings->isNotEmpty())
                <div class="search-card-container" id="search-data" data-search="{{ $timings }}">
                    <div class="card-container">
                        @foreach ($timings as $item)
                            <div class="card" href="/pages/course.html">
                                <img src="{{ $item['course_image'] }}" alt="">
                                <div class="card-content">
                                    <div class="card-title">{{ $item['course_title'] }}</div>
                                    <div class="card-dates">
                                        <img src="/assets/icons/calender2.svg" alt="" />
                                        <span>{{ $item['date_from'] }} to {{ $item['date_to'] }}</span>
                                    </div>
                                    <div class="card-location">
                                        <img src="/assets/icons/location.svg" alt="" class="location-icon" />
                                        <span>{{ $item['city_title'] }}</span>
                                    </div>
                                    <div class="card-buttons">
                                        <a href='./pages/requestInHouse.html' class="btn-primary">Register Now</a>
                                        <a href="./pages/course.html" class="btn-secondary">Learn more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                No courses found.
            @endif
        </div>
    </section>
@endif

{{-- JavaScript --}}
{{-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const timingsData = document.getElementById('search-data').getAttribute('data-search');
    const timings = JSON.parse(timingsData);

    const cardContainer = document.querySelector(".search-card-container");

    timings.forEach((timing) => {
        const card = document.createElement("a");
        card.href = `/course/${timing.course_slug}`; // Dynamic link to the course detail page
        card.classList.add("card");

        card.innerHTML = `
            <img src="${timing.course_image}" alt="${timing.course_title}">
            <div class="card-content">
                <div class="card-title">${timing.course_title}</div>
                <div class="card-dates">
                    <img src="{{ asset('assets/icons/calendar2.svg') }}" alt="" />
                    <span>${timing.date_from} to ${timing.date_to} ${new Date(timing.date_from).getFullYear()}</span>
                </div>
                <div class="card-location">
                    <img src="{{ asset('assets/icons/location.svg') }}" alt="" class="location-icon" />
                    <span>${timing.city_title}</span>
                </div>
                <div class="card-buttons">
                    <a href='/register/${timing.id}' class="btn-primary">Register Now</a>
                    <a href="/course/${timing.course_slug}" class="btn-secondary">Learn more</a>
                </div>
            </div>
        `;

        cardContainer?.appendChild(card);
    });
});
</script> --}}
