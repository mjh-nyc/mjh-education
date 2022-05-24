{{--
  Template Name: Homepage Template
--}}

@extends('layouts.home')


@section('hero-slider')
    @include('partials.homepage-hero-slider')
@endsection

@section('lessons-carousel')
    @if( !empty($lessons))
        @include('partials.homepage-lessons')
    @endif
@endsection

@section('custom-carousel')
    @if( have_rows('custom_carousel') )
        @while( have_rows('custom_carousel') ) @php(the_row())
            @include('partials.homepage-custom-carousel')
        @endwhile
    @endif
@endsection