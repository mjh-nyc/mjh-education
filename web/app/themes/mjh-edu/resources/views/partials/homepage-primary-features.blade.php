<div class="row">
  <div class="col-md-6">
    <div class="video-container">
      {!! App::get_group_field('features','video_embed') !!}
    </div>
  </div>
  <div class="col-md-3">
    Post object (Featured lesson here)

  </div>
  <div class="col-md-3">
    Post object (Custom feature)
    @if( !empty($feature_custom_feature))
      {!! $feature_custom_feature['title'] !!}
      {!! $feature_custom_feature['permalink'] !!}
      {!! $feature_custom_feature['post_type_label'] !!}
      {!! $feature_custom_feature['featured_image'] !!}
      {!! $feature_custom_feature['featured_image_alt'] !!}
    @endif

  </div>
</div>