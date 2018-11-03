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

@section('carousel')
    @if( !empty($lessons))
        @include('partials.homepage-lessons')
    @endif
@endsection

@section('secondary-features')
    @if( !empty($feature_secondary_features))
        @include('partials.homepage-secondary-features')
    @endif
@endsection