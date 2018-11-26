<div class="lessons-listing">
    @include('partials.page-header')
    {{-- Lessons Dropdown --}}
    @if (!empty($lessons))
        <div class="lessons-listing__select">
            <p>{{ __('There are '.count($lessons).' innovative lesson plans.', 'sage') }} {{ __('Please select one to get started.', 'sage') }}</p>
            <div class="dropdown">
              <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Select a Lesson Plan to Get Started!', 'sage') }}
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($lessons as $lesson)
                    <a class="dropdown-item animsition-link" href="{{get_permalink($lesson->ID)}}">{!! $lesson->post_title !!}</a>
                @endforeach
              </div>
            </div>
        </div>
    @endif
    {{-- Lessons Dropdown --}}
    <div class="lessons-listing__content">
        @include('partials.content-page')
    </div>
</div>