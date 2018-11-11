{{-- You must pass the post ID to this template as $item_id --}}
<div class="content-wrapper" style="background-image:url({{App::featuredImageSrc('square@1x',$item_id)}})">
	<div class="content-card">
		<span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
		<p class="small">
			@if ($header) 
			{{ $header }}
			@endif
		</p>
		<h3 class="content-card__title">{!! App::truncateString(get_the_title($item_id)) !!}</h3>
		<p>{!! App::postExcerpt($item_id) !!}</p>
		<a href="{!! get_the_permalink($item_id); !!}" class="cta cta-white cta-icon cta-arrow animsition-link content-card__link">
			{{ __('View', 'sage') }}
		</a>
	</div>
</div>