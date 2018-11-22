<div class="row features features__primary">
  <div class="col-lg-6">
    @if( !empty(App::get_group_field('features','video_embed')))
    <div class="video-container card-shadow feature">
      {!! App::get_group_field('features','video_embed') !!}
    </div>
    @endif
  </div>
  <div class="col-md-6 col-lg-3 feature">
    @if( !empty($feature_lesson_plan))
      @include('partials.content-card', ['item_id'=>$feature_lesson_plan['ID'],'header'=>__('Featured Lesson Plan', 'sage'), 'feature_type'=>'primary'])
    @endif

  </div>
  <div class="col-md-6 col-lg-3 feature">
    @if( !empty($feature_custom_feature))
      @include('partials.content-card', ['item_id'=>$feature_custom_feature['ID'],'header'=>App::get_group_field('features','custom_feature_label'),'feature_type'=>'primary'])
    @endif    
  </div>
</div>