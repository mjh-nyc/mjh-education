{{--
  Template Name: Survivor Listing Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
  {{-- Survivors Listing --}}
    @if (!empty($survivors))
      <div class="survivors">
          <ul>
              @foreach ($survivors as $survivor)
                  <li>
                      <div class="survivor">
                      <a class="survivor--link" href="{!! $survivor['link'] !!}">
                          @if($survivor['survivors_past_image'])
                              <div class="survivor--image">
                                <img alt="{{ __('View their story', 'sage') }}" data-attr-past="{{$survivor['survivors_past_image']['url']}}" data-attr-current="{{$survivor['survivors_current_image']['url']}}" src="{{$survivor['survivors_past_image']['url']}}"/>
                              </div>
                          @else
                              <span class="survivor--no-image">{{ __('View their story', 'sage') }}</span>
                          @endif
                      </a>
                          <span class="survivor--name">{{$survivor['name']}}</span>
                      </div>

                  </li>
              @endforeach
          </ul>
      </div>
  @endif
  {{-- Survivors Listing --}}
  @endwhile
@endsection
