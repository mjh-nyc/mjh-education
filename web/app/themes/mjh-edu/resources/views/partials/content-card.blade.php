{{-- You must pass the post ID to this template as $item_id --}}
<div class="content-wrapper" style="background-image:url({{App::featuredImageSrc('square@1x',$item_id)}})">
	<div class="content-card">
		<span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
		<p class="small">
			@if ($header != 'pages') 
				{{ $header }}
			@endif
		</p>
		<h3 class="content-card__title">
			@if ( strtolower(get_the_title($item_id)) != "timeline")
				{!! App::truncateString(get_the_title($item_id), 20) !!}
			@else 
				{!! App::postExcerpt($item_id) !!}
			@endif
		</h3>
		@if ( strtolower(get_the_title($item_id)) != "timeline")
			<p>{!! App::postExcerpt($item_id) !!}</p>
		@endif
		<a href="{!! get_the_permalink($item_id); !!}" class="cta cta-white cta-icon cta-arrow animsition-link content-card__link">
			{{ __('View', 'sage') }}
		</a>
	</div>
</div>