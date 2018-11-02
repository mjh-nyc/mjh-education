<div class="row features features__primary">
  <div class="col-lg-6">
    <div class="video-container card-shadow feature">
      {!! App::get_group_field('features','video_embed') !!}
    </div>
  </div>
  <div class="col-md-6 col-lg-3 feature">
    @if( !empty($feature_lesson_plan))
      @include('partials.content-card', ['item_id'=>$feature_lesson_plan['ID'],'header'=>'Featured Lesson Plan'])
    @endif

  </div>
  <div class="col-md-6 col-lg-3 feature">
    @if( !empty($feature_custom_feature))
      @include('partials.content-card', ['item_id'=>$feature_custom_feature['ID'],'header'=>$feature_custom_feature['post_type_label']])
    @endif    
  </div>
</div>