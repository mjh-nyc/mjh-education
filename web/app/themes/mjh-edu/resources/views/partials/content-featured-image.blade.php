@if(App::featuredImage())
	<div class="featured-image">
		@if(!empty($post) && $post->post_type == 'lessons')
			{!! the_post_thumbnail('lessons-header') !!}
		@else
			{!! the_post_thumbnail('header') !!}
		@endif
	</div>
	@if (wp_get_attachment_caption(get_post_thumbnail_id()))
    	<div class="featured-image--caption">{{ wp_get_attachment_caption(get_post_thumbnail_id()) }}</div>
    @endif
@endif