<div class="row">
  @if($lessons)
    <h3>{{ __('Lesson Plans', 'sage') }}</h3>
    <p>{{ __('Lorem Ipsum.', 'sage') }}</p>
    <ul>
        @foreach ($lessons as $lesson)
            @include('partials.content-lesson-card', ['item_id'=>$lesson->ID,'header'=>__('Lesson Plans', 'sage')] )
        @endforeach
    </ul>
  @endif
</div>