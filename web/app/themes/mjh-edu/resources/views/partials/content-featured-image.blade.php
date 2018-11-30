@if(App::featuredImage())
	
		@if(!empty($post) && $post->post_type == 'lessons')
			<div class="featured-image" style="background-image: url({!! App::featuredImageSrc('square@2x') !!})">
				<div class="sr-only">{{get_the_ID()}} {!! App::featuredImageAlt( get_the_ID() ) !!}</div>
			</div>
		@else
			<div class="featured-image">
				{!! the_post_thumbnail('header') !!}
			</div>
			@if (wp_get_attachment_caption(get_post_thumbnail_id()))
		    	<div class="featured-image--caption">{{ wp_get_attachment_caption(get_post_thumbnail_id()) }}</div>
		    @endif
		@endif
	
	
@endif