{{--
  Template Name: Events Listing
--}}
@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    <div class="event-form">
      <form id="event-listing-form" name="event-listing-form" method='get' action="{!! APP::getPermalink() !!}">
        <div class="wrap">
          <label for="event-category">@php _e("Display","sage"); @endphp</label>
          <div class="styled-select slate">
            <select name="event-category" id="event-category">
              <option value="">@php _e("All categories","sage"); @endphp</option>
            </select>
          </div>
        </div>
      </form>
    </div>

  @if( $events )
    <div class="listing-wrapper row">
      @foreach ($events as $event)
        <article @php(post_class())>
          @include('partials.content-event-card', ['item_id'=>$event->ID])
        </article>
      @endforeach
    </div>
 @else
    <div style="margin-bottom: 100px;">
      <div class="alert alert-warning">{!! __("There are no events to display","sage") !!} </div>
      {!! get_search_form(false) !!}
    </div>
  @endif

  @endwhile
@endsection
