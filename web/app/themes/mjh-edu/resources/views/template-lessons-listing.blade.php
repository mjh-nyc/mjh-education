{{--
  Template Name: Lessons Listing Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    {{-- Lessons Dropdown --}}
    @if (!empty($lessons))
        <div class="lessons">
            <p>{{ __('There are '.count($lessons).' innovative lesson plans.', 'sage') }} {{ __('Please select one to get started.', 'sage') }}</p>
            <div class="btn-group">
            @foreach ($lessons as $lesson)
                @if ($loop->first)

                    <button class="btn btn-secondary btn-lg" type="button">
                        <a href="{{get_permalink($lesson->ID)}}">{{$lesson->post_title}}</a>
                    </button>
                    <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    @if($loop->count > 1)
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @endif
                @else
                    <a class="dropdown-item" href="{{get_permalink($lesson->ID)}}">{{$lesson->post_title}}</a>
                @endif
                @if ($loop->last && $loop->count > 1)
                    </div>
                @endif
            @endforeach
            </div>
        </div>
    @endif
    @include('partials.content-page')
  @endwhile
@endsection
