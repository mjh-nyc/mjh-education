@if(get_field('show_all_lessons'))
    <div class="lesson-plans">
        <header class="lesson-plans__header">
            <h3>{!! App::get_field('lesson_plans_homepage_header','option') !!}</h3>
            <div class="lesson-plans__teaser">
                <p>{!! App::get_field('lesson_plans_homepage_teaser','option') !!}</p>
            </div>
        </header>
        <div class="row" id="pinContainer">
            <div class="carousel lessons-slider horizontal-scroll-wrapper squares" id="slideContainer">
            @foreach ($lessons as $lesson)
                @include('partials.content-lesson-card', ['item_id'=>$lesson->ID,'header'=>__('Lesson Plans', 'sage')] )
            @endforeach
            </div>
        </div>
    </div>
@endif