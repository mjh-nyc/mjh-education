@if (!empty($themes))
<div class="post-categories">
<h2>{{ __('Themes', 'sage') }}</h2>
    <ul>
    @foreach ($themes as $theme)
            <li><a href="{!! $theme['link'] !!}">{{$theme['name']}}</a></li>
    @endforeach
    </ul>
</div>
@endif