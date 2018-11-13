@php
  $status = App::evalEventStatus(App::get_field('event_start_date'),App::get_field('event_end_date'));
  if ($status) {
    $status = 'past';
  }
@endphp
<article @php post_class() @endphp>
  <header>
    @include('partials.content-share')
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
    {{-- @include('partials/entry-meta') --}}
    @include('partials.entry-taxonomy-categories')
  </header>

  <!-- event info -->
  <div class="event-info {{ $status }}">
    <h3 class="subhead">
      @php _e("Event details","sage"); @endphp
    </h3>
    <!--row -->
    <div class="row">
      <div class="col-12">
        @if (App::get_field('event_start_date'))
          <!--event dates -->
          <div class="event-dates item">
            <div class="event-dates-content">
              <strong>
                @if (App::get_field('event_end_date'))
                  {!! App::cleanDateOutput(App::get_field('event_start_date'),App::get_field('event_end_date')) !!}
                @else
                  {!! App::get_field('event_start_date') !!}
                @endif
              </strong>
              @if (App::get_field('event_type') == 'onetime')
                <br> {{ App::get_field('event_start_time') }}
                @if (App::get_field('event_end_time'))
                  &#8211; {{ App::get_field('event_end_time') }}
                @endif
              @endif
            </div>
          </div>
          <!-- //event dates -->

        @elseif (App::get_field('event_type') == 'recurring')
          <div class="event-dates item">
            <div class="event-dates-content">
              {{ App::get_field('event_recurrence') }}
            </div>
          </div>
        @endif
        
        @if (App::get_field('event_has_location'))
          <div class="event-location item">
            <div>{{App::get_field('event_location')}}</div>
            <div>{{App::get_field('event_street')}} <span style="display: block;">{{App::get_field('event_secondary_street')}}</span></div>
            <div>{{App::get_field('event_city')}}, {{App::get_field('event_state')}} {{App::get_field('event_zip_code')}}</div>
          </div>
        @endif
      </div>
    </div>
    <!--//end row -->

    <!-- row -->
    <div class="row">
      @if (App::get_repeater_field('event_pricing'))
        <div class="col-12">
          <div class="event-pricing item">
            <ul>
              @foreach (App::get_repeater_field('event_pricing') as $event_pricing)
                <li>
                <span class="bold">
                @if(!empty($event_pricing['event_price_alternate']))
                @if($event_pricing['event_price_alternate'] == 'Other')
                {{ $event_pricing['event_price_alternate_other'] }}
                @else
                {{ $event_pricing['event_price_alternate'] }}
                @endif
                </span>
                @else
                ${{ $event_pricing['event_price'] }}
                </span> {{$event_pricing['event_price_label'] }}
                @endif
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    </div>
    <!-- //end row -->

    <!-- row -->
    <div class="row">
      @if (App::get_field('event_ticket_url') && !$status)
        <div class="col-12">
          <div class="buy-tix item">
            <a href="{!! App::get_field('event_ticket_url') !!}" target="_blank" class="cta cta-black cta-icon cta-arrow">{!! App::get_field('event_ticket_button_label') !!}</a>
          </div>
        </div>
      @endif
    </div>
    <!-- //end row -->

  </div>
  <!-- //end event info -->

  <div class="entry-content">
    @php the_content() @endphp
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
