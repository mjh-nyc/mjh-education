{{-- NOT USED / ARCHIVED --}}
{{--<div class="row features features__primary">
  <div class="col-lg-6">
    @if( !empty(App::get_group_field('features','video_embed')))
    <div class="video-container card-shadow feature">
      {!! App::get_group_field('features','video_embed') !!}
    </div>
    @endif
  </div>
  <div class="col-sm-6 col-lg-3 feature">
    @if( !empty($feature_lesson_plan))
      @include('partials.content-card', ['item_id'=>$feature_lesson_plan['ID'],'header'=>App::get_group_field('features','featured_lesson_plan_label'), 'feature_type'=>'primary', 'button_label'=>App::get_group_field('features','featured_lesson_plan_button_label')])
    @endif

  </div>
  <div class="col-sm-6 col-lg-3 feature">
    @if( !empty($feature_custom_feature))
      @include('partials.content-card', ['item_id'=>$feature_custom_feature['ID'],'header'=>App::get_group_field('features','custom_feature_label'),'feature_type'=>'primary','button_label'=>App::get_group_field('features','custom_feature_button_label')])
    @endif    
  </div>
</div>--}}