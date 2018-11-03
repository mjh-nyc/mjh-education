<div class="row">
  @if($feature_secondary_features)
    @foreach ($feature_secondary_features as $feature)
    <div class="col-md-3">
      {{ App::truncateString(get_the_title($feature['ID']), 6) }}
    </div>
    @endforeach
  @endif
</div>