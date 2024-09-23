{{-- Form --}}
<form action="{{ $searchRoute }}" method="GET" class="search-courses-form">
    {{-- Row 1 --}}
    <div class="row1">
        <div class="search-courses-form-input">
            <input type="text" name="course_title" id="course_title" placeholder="{{ __('content.Search For Course') }}"
                value="{{ request('course_title') }}">
            <img src="{{ asset('assets/icons/search.svg') }}" alt="">
        </div>
        <div class="custom-select-wrapper">
            <div class="custom-select">
                <div class="custom-select-trigger">
                    <span>{{ request('category_title', __('content.category')) }}</span>
                    <img src="{{ asset('assets/icons/arrow-down-2.svg') }}" alt="Arrow Down">
                </div>
                <div class="custom-options">
                    @foreach ($categories as $category)
                        <span class="custom-option" data-value="{{ $category->title }}">{{ $category->title }}</span>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="category_title" id="category_title_input"
                value="{{ request('category_title') }}">
        </div>
        {{-- <input class="category-input" type="text" name="category_title" id="category_title" placeholder="Categories" value="{{ request('category_title') }}"> --}}
    </div>

    {{-- Row 2 --}}
    <div class="row2">
        <div class="custom-select-wrapper">
            <div class="custom-select">
                <div class="custom-select-trigger">
                    <span>{{ request('city_title', __('content.Venue')) }}</span>
                    <img src="{{ asset('assets/icons/arrow-down-2.svg') }}" alt="Arrow Down">
                </div>
                <div class="custom-options">
                    @foreach ($cities as $city)
                        <span class="custom-option" data-value="{{ $city->title }}">{{ $city->title }}</span>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="city_title" id="city_title_input" value="{{ request('city_title') }}">
        </div>

        <div class="custom-select-wrapper">
            <div class="custom-select">
                <div class="custom-select-trigger">
                    <span>{{ request('month', __('content.Month')) }}</span>
                    <img src="{{ asset('assets/icons/arrow-down-2.svg') }}" alt="Arrow Down">
                </div>
                <div class="custom-options">
                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <span class="custom-option" data-value="{{ strtolower($month) }}">{{ $month }}</span>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="month" id="month_input" value="{{ request('month') }}">
        </div>

        <div class="custom-select-wrapper">
            <div class="custom-select">
                <div class="custom-select-trigger">
                    <span>{{ request('duration', __('content.Duration')) }}</span>
                    <img src="{{ asset('assets/icons/arrow-down-2.svg') }}" alt="Arrow Down">
                </div>
                <div class="custom-options">
                    @foreach ($durations as $duration)
                        <span class="custom-option" data-value="{{ $duration }}">{{ $duration }}</span>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="duration" id="duration_input" value="{{ request('duration') }}">
        </div>
    </div>

    {{-- Row 3 --}}
    <div class="row3">
        <button type="submit">{{ __('content.Search') }}
            <img src="{{ asset('assets/icons/arrow-right.svg') }}" alt="">
        </button>
        <button type="button" onclick="resetForm()">{{ __('content.Reset') }}
            <img src="{{ asset('assets/icons/reload.svg') }}" alt="">
        </button>
    </div>
</form>

{{-- Java Script --}}
<script>
    function resetForm() {
        const form = document.querySelector('.search-courses-form');

        // Reset form inputs
        form.reset();

        // Clear the query string by reloading the page without query parameters
        window.location.href = window.location.pathname;
    }

    document.querySelectorAll('.custom-option').forEach(option => {
        option.addEventListener('click', function() {
            const select = this.closest('.custom-select');
            const hiddenInput = select.parentElement.querySelector('input[type="hidden"]');

            if (hiddenInput) {
                // Update the hidden input with the selected value
                hiddenInput.value = this.getAttribute('data-value');
                console.log('Updated input:', hiddenInput.name, hiddenInput.value);

                // Update the trigger text with the selected option's text
                select.querySelector('.custom-select-trigger span').textContent = this.textContent;
            } else {
                console.error('Hidden input not found for:', select);
            }
        });
    });
</script>
