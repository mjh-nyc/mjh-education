{{--
  Template Name: Registration Template
--}}

@extends('layouts.app')

@php acf_form_head() @endphp

@section('content')
    @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    @endwhile
    @if( !empty($updated))
        <h3>{{ __('Thank you for registering!', 'sage') }}</h3>
        <p>{{ __('Please check your email to verify your account and login information.', 'sage') }}</p>
    @else
        <div class="users-login"><a href="{!! get_home_url()!!}/login">{!! __("Log in if you are already registered","sage")!!}</a></div>
        <form method="post" class="users-register">
            <input type="hidden" name="register" value="register" />
           @php acf_form('new-user') @endphp
        </form>
    @endif
@endsection