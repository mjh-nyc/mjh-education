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
        <h3>Thank you for registering!</h3>
        <p>Please check your email to verify the account and login.</p>
    @else
        <form method="post" class="users-register">
            <input type="hidden" name="register" value="register" />
           @php acf_form('new-user') @endphp
        </form>
    @endif
@endsection