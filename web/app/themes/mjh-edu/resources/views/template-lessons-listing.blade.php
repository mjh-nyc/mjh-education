{{--
  Template Name: Lessons Listing Template
--}}

@extends('layouts.testimonies-and-artifacts')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile
@endsection

@section('testimonies-and-artifacts')
  @include('partials.lessons-listing')
@endsection