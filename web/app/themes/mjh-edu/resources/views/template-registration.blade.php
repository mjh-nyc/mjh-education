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
    <form method="post">
        <h3>Don't have an account?<br /> Create one now.</h3>
        <p><label>Last Name</label></p>
        <p><input type="text" value="" name="last_name" id="last_name" /></p>
        <p><label>First Name</label></p>
        <p><input type="text" value="" name="first_name" id="first_name" /></p>
        <p><label>Email</label></p>
        <p><input type="text" value="" name="email" id="email" /></p>
        <p><label>Username</label></p>
        <p><input type="text" value="" name="username" id="username" /></p>
        <p><label>Password</label></p>
        <p><input type="password" value="" name="pwd1" id="pwd1" /></p>
        <p><label>Password again</label></p>
        <p><input type="password" value="" name="pwd2" id="pwd2" /></p>
       @php acf_form('new-user') @endphp
        <input type="hidden" name="task" value="register" />
    </form>
@endsection