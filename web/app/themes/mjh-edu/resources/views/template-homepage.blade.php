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
    @if( !empty($lessons))
        @include('partials.homepage-lessons')
    @endif
    @if( !empty($feature_secondary_features))
        @include('partials.homepage-secondary-features')
    @endif
@endsection