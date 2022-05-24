<div class="custom-slider container no-gutters">
  <div class="row">
    <div class="col-md-12" style="text-align: center;">
      <div class="header">
        <h3>{{get_sub_field('custom_carousel_section_title')}}</h3>
      </div>
      <div class="subheader">
        {{get_sub_field('custom_carousel_section_subtitle')}}
      </div>
    </div>
  </div>
  <div class="custom-carousel row">
     <div class="col-md-12 no-gutters wrapper">
      @php($carousel_items = get_sub_field('custom_carousel_items'))
      @php($carousel_total = count($carousel_items))
      @if(!empty($carousel_items))
        <div id="slider-custom-{{get_row_index()}}" class="slider-custom mjh-slider" @if($carousel_total < 4) style="padding-bottom: 0" @endif>
          @while (have_rows('custom_carousel_items')) @php(the_row())
            @if(empty(get_sub_field('custom_carousel_section_is_custom_content')))
              @php($item_id = get_sub_field('custom_carousel_section_post'))
            @endif
            <div class="custom-card slide-card">
              <a href="@if(!empty($item_id)){!! get_the_permalink($item_id) !!}@elseif(get_sub_field('custom_carousel_link')){{get_sub_field('custom_carousel_link')['url']}}@else{{_e('#')}}@endif" class="card-link" target="@if(!empty($item_id)){{_e('_self')}}@elseif(get_sub_field('custom_carousel_link')){{get_sub_field('custom_carousel_link')['target']}}@endif">
                <div class="card-image" role="img" aria-label="@if(!empty($item_id)){{ App::featuredImageAlt($item_id) }}@else {{get_sub_field('custom_carousel_image')['alt']}} @endif">
                  <img src="@asset('images/placeholder.png')" data-lazy="@if(!empty($item_id)){{App::featuredImageSrc('square@2x',$item_id)}}@else {{get_sub_field('custom_carousel_image')['sizes']['square@2x'] }} @endif" data-mobilesrc="@if(!empty($item_id)){{App::featuredImageSrc('square@1x',$item_id)}}@else {{get_sub_field('custom_carousel_image')['sizes']['square@1x'] }} @endif">
                </div>
                <div class="info">
                  <h4 class="card-title">
                  @if(!empty($item_id)){!! get_the_title($item_id) !!}@else {{get_sub_field('custom_carousel_title')}} @endif</h4>
                </div>
                
                @if(!empty($item_id))
                  @if(has_excerpt($item_id))
                    <div class="custom-card--details card-description">
                      {!! get_the_excerpt($item_id) !!}
                    </div>
                  @endif
                @else 
                  @if(get_sub_field('custom_carousel_description'))
                    <div class="custom-card--details card-description">
                      {!! get_sub_field('custom_carousel_description') !!}
                    </div>
                  @endif
                @endif
              </a>
            </div>
            @php($item_id=0)
          @endwhile
        </div>
      @endif
       
      
    </div>
  </div>
</div>
