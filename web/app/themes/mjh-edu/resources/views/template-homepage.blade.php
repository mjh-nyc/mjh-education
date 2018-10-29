{{--
  Template Name: Homepage Template
--}}

@extends('layouts.home')

@section('hero')
  @while(have_posts()) @php(the_post())
    @include('partials.content-featured-carousel')
  @endwhile
@endsection