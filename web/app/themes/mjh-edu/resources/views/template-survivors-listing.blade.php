{{--
  Template Name: Survivor Listing Template
--}}

@extends('layouts.survivors')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile
@endsection

@section('survivors')
  @include('partials.survivors-listing')
@endsection

@section('content-footer')
  {!! App::get_field('survivor_story_content_footer') !!}
@endsection
