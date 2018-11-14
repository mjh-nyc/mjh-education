{{--
  Template Name: Profile Home Template
--}}

@extends('layouts.app')

@php acf_form_head() @endphp

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    
    <!-- Nav pills -->

    <ul class="nav nav-pills" role="tablist">
      <li class="nav-item">
          <a class="nav-link @if(empty($updated))active @endif" data-toggle="pill" href="#home"><i class="fa fa-home"></i> {!! __('Home','sage') !!}</a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if(!empty($updated))active @endif" data-toggle="pill" href="#edit-profile"><i class="fa fa-drivers-license"></i> {!! __('Edit Profile','sage') !!}</a>
      </li>
      <li class="nav-item"><a href="{{wp_logout_url( '/login/' )}}" class="nav-link"><i class="fa fa-power-off"></i> {!! __('Log Out','sage') !!}</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="tab-pane @if(empty($updated))active @else fade @endif"><br>
          @include('partials.profile-home')
      </div>
      <div id="edit-profile" class="tab-pane @if(!empty($updated))active @else fade @endif"><br>
          @include('partials.profile-edit')
      </div>
    </div>
  @endwhile
@endsection
