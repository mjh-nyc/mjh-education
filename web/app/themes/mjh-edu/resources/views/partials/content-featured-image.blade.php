@if(App::featuredImage())
<div class="featured-image">
	@if($post->post_type == 'lessons')
    	{!! the_post_thumbnail('square@2x') !!}
    @else
    	{!! the_post_thumbnail('header') !!}
    @endif
    <div class="featured-image--caption">{{ wp_get_attachment_caption(get_post_thumbnail_id()) }}</div>
</div>
@endif