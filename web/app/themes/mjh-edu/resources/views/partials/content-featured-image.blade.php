@if(App::featuredImage())
<div class="featured-image">
	@if($post->post_type == 'lessons')
    	{!! the_post_thumbnail('medium') !!}
    @else
    	{!! the_post_thumbnail('header') !!}
    @endif
    @if (wp_get_attachment_caption(get_post_thumbnail_id()))
    	<div class="featured-image--caption">{{ wp_get_attachment_caption(get_post_thumbnail_id()) }}</div>
    @endif
</div>
@endif