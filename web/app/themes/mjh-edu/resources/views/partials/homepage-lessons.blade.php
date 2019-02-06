<div class="lesson-plans">
    <header class="lesson-plans__header">
        <h3>{{ App::get_field('lesson_plans_homepage_header','option') }}</h3>
        <p>{{ App::get_field('lesson_plans_homepage_teaser','option') }}</p>
    </header>
    <div class="row" id="pinContainer">
        <div class="carousel slider horizontal-scroll-wrapper squares" id="slideContainer">
        @foreach ($lessons as $lesson)
            @include('partials.content-lesson-card', ['item_id'=>$lesson->ID,'header'=>__('Lesson Plans', 'sage')] )
        @endforeach
        </div>
    </div>
</div>