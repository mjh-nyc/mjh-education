<div class="row features features__secondary">
  @foreach ($feature_secondary_features as $feature)
  <div class="col-md-6 feature">
    @include('partials.content-card', ['item_id'=>$feature['ID'],'header'=>''])
  </div>
  @endforeach
</div>