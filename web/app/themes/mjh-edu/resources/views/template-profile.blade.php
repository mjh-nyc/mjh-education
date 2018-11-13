{{--
  Template Name: Profile Home Template
--}}

@extends('layouts.app')

@php acf_form_head() @endphp

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    <!-- Nav pills -->
    <ul class="nav nav-pills" role="tablist">
      <li class="nav-item">
          <a class="nav-link @if(empty($updated))active @endif" data-toggle="pill" href="#home">{!! __('Home','sage') !!}</a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if(!empty($updated))active @endif" data-toggle="pill" href="#edit-profile">{!! __('Edit Profile','sage') !!}</a>
      </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane @if(empty($updated))active @else fade @endif"><br>
          @include('partials.profile-home')
      </div>
      <div id="edit-profile" class="container tab-pane @if(!empty($updated))active @else fade @endif"><br>
          @include('partials.profile-edit')
      </div>
    </div>
  @endwhile
@endsection
