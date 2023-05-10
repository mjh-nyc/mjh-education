@php  $carousel_items = get_field('hero_area_features_collection');
      if(!empty($carousel_items)) {
        $carousel_total = count($carousel_items);
      }
@endphp
@if(!empty($carousel_items))
<div class="wrap hero-slider mjh-slider jumbotron-fluid">
    <div class="hero-carousel row">
      <div class="col-12 wrapper">
        <div id="hero-carousel-{{get_row_index()}}" class="hero-carousel-container mjh-slider">
            @while (have_rows('hero_area_features_collection')) @php(the_row())
              <div class="slide-wrapper">
                <div class="slide-image-box" role="img" aria-label="{{ get_sub_field('hero_area_image')['alt'] }}">
                  <img src="@asset('images/placeholder.png')" data-lazy="{{ get_sub_field('hero_area_image')['sizes']['square@1x'] }}" data-src-md="{{ get_sub_field('hero_area_image')['sizes']['medium'] }}" data-src-lg="{{ get_sub_field('hero_area_image')['sizes']['large'] }}" alt="{{ get_sub_field('hero_area_image')['alt'] }}" width="1" height="1">


                  <div class="container for-callout">
                    <div class="callout">
                      @if(get_sub_field('hero_area_image_title'))
                        <div class="title">
                          {{ get_sub_field('hero_area_image_title') }}
                        </div>
                      @endif
                      @if(get_sub_field('hero_area_image_description'))
                        <div class="copy">
                          {{ get_sub_field('hero_area_image_description') }}
                        </div>
                      @endif
                      @if(get_sub_field('hero_area_image_button_link'))
                        <div class="button-container">
                          <a class="cta cta-white cta-icon cta-arrow animsition-link" href="{{ get_sub_field('hero_area_image_button_link')['url'] }}" target="@if(get_sub_field('hero_area_image_button_link')['target']){{get_sub_field('hero_area_image_button_link')['target']}}@else{{_e('_self')}}@endif">{{ get_sub_field('hero_area_image_button_link')['title'] }}</a>
                        </div>
                      @endif

                    </div>

                  </div>
                </div>
              </div>
            @endwhile
        </div>
      </div>
    </div>
</div>
@endif
