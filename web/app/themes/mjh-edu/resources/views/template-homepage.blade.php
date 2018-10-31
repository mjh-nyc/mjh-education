{{--
  Template Name: Homepage Template
--}}

@extends('layouts.home')

@section('hero')
  @while(have_posts()) 
    @php(the_post()) 
  @endwhile
@endsection

@section('primary-features')
    @include('partials.homepage-primary-features')
@endsection