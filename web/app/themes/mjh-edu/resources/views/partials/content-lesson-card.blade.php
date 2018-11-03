{{-- You must pass the post ID to this template as $item_id --}}
<div class="slide-card lesson-card" @if ($header) data-header="{{ $header }}" @endif>
    <div class="card-image" style="background-image:url({{App::featuredImageSrc('square@1x',$item_id)}})">
        <span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
    </div>
    <h3 class="card-title">{{ App::truncateString(get_the_title($item_id), 8) }}</h3>
    <div class="details">
        <a class="cta cta-white cta-icon cta-arrow animsition-link" href="{!! get_the_permalink($item_id); !!}">{{ __('Get this lesson', 'sage') }}</a>
    </div>
</div>