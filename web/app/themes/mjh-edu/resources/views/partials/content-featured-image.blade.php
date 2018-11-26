@if(App::featuredImage())
	<div class="featured-image">
		{!! the_post_thumbnail('header') !!}
	</div>
	@if (wp_get_attachment_caption(get_post_thumbnail_id()))
    	<div class="featured-image--caption">{{ wp_get_attachment_caption(get_post_thumbnail_id()) }}</div>
    @endif
@endif