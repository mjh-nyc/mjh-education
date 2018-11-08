@if (!empty($themes))
<div class="post-categories">
	<h4>{{ __('Related Content', 'sage') }}</h4>
	<ul>
		@foreach ($themes as $theme)
			<li>
				<a href="{!! $theme['link'] !!}">{{$theme['name']}}</a>
			</li>
		@endforeach
	</ul>
</div>
@endif