{{--
  Template Name: Registration Template
--}}

@extends('layouts.app')

@php acf_form_head() @endphp

@section('content')
    @if( !empty($updated))
        <h1>{{ __('Thank you for registering!', 'sage') }}</h1>
        <p>{{ __('Please check your email to verify your account and login information.', 'sage') }}</p>
    @else
        @while(have_posts()) @php the_post() @endphp
        @include('partials.page-header')
        @include('partials.content-page')
        @endwhile
        <div class="users-login"><a href="{!! get_home_url()!!}/login">{!! __("Already have an account? Log in","sage")!!} &#8594;</a></div>
        <div class="users-reset-link"><a href="{!! get_home_url()!!}/wp/wp-login.php?action=lostpassword">{!!__("Forgot your password?","sage")!!} &#8594;</a></div>
        <form method="post" class="users-register">
            <input type="hidden" name="register" value="register" />
           @php acf_form('new-user') @endphp
        </form>
    @endif
@endsection