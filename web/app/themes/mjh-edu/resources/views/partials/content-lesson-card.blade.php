{{-- You must pass the post ID to this template as $item_id --}}
<div class="slide-card lesson-card" @if ($header) data-header="{{ $header }}" @endif>
    @if(App::featuredImageSrc())
	    <div class="slide-card__image">
	    	<a href="{!! get_the_permalink($item_id); !!}"><img class="lazy" src="{{App::featuredImageSrc('square@1x',$item_id)}}" alt="{{ App::featuredImageAlt($item_id) }}" data-src="{{App::featuredImageSrc('square@1x',$item_id)}}|{{App::featuredImageSrc('square@2x',$item_id)}}" data-src-placeholder="@asset('images/placeholder.gif')"></a>
	    </div>
	@endif
    <h4 class="slide-card__title">{!! get_the_title($item_id) !!}</h4>
    <div class="slide-card__details">
        <a class="cta cta-white cta-icon cta-arrow animsition-link" href="{!! get_the_permalink($item_id); !!}">{{ __('Get this lesson', 'sage') }}</a>
    </div>
</div>