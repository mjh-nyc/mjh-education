@extends('layouts.app')

@section('content')
  <h1>{{ App::title() }}</h1>
  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @else
    @include('partials.content-category')
  @endif
@endsection
