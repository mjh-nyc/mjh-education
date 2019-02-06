<div class="lessons-listing">
    <!--
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
    -->
    <div class="lesson-plans">
        <div class="lesson-plans__listing row" id="pinContainer">
            <div class="col-12 listing-grid">
            @foreach ($lessons as $lesson)
                @include('partials.content-lesson-card', ['item_id'=>$lesson->ID,'header'=>''] )
            @endforeach
            </div>
        </div>
    </div>
</div>

@if (App::get_field('credits_text'))
<div class="credits">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h4>{{ App::get_field('credits_header') }}</h4>
            {!! App::get_field('credits_text') !!}
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endif