<div class="lesson-plan container">
    <div class="header">
        <h3>{{ __('Lesson Plans', 'sage') }}</h3>
        <p>{{ __('Lorem Ipsum.', 'sage') }}</p>
    </div>
    <div class="lesson-plan--listing row">
        <div class="lesson-plan--carousel slider">
        @foreach ($lessons as $lesson)
            @include('partials.content-lesson-card', ['item_id'=>$lesson->ID,'header'=>__('Lesson Plans', 'sage')] )
        @endforeach
        </div>
    </div>
</div>