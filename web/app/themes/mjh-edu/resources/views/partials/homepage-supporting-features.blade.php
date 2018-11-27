<div class="row features features__supporting">
	@php $supporting_features = App::get_repeater_field('supporting_features'); @endphp
	@if(!empty($supporting_features))

		@foreach ($supporting_features as $feature)
		<div class="col-md-4 feature">
			@include('partials.content-card', ['item_id'=>$feature['supporting_feature'], 'header'=>'','feature_type'=>'supporting','button_label'=>$feature['supporting_feature_button_label']])
		</div>
		@endforeach
	@endif
</div>