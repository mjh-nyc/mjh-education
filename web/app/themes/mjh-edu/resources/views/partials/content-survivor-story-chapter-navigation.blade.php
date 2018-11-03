@if($survivor_stories_chapters)
<nav class="nav">
    @foreach($survivor_stories_chapters as $chapter)
        <a class="nav-link @if($chapter->ID == $post->ID) active @endif" href="{!! get_permalink($chapter->ID) !!}">{{ __('Chapter', 'sage') }} {{$loop->iteration}}</a>
    @endforeach
</nav>
@endif