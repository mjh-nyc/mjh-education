<div class="row">
  @foreach ($feature_secondary_features as $feature)
  <div class="col-md-3">
    {!! $feature['title'] !!}
  </div>
  @endforeach
</div>