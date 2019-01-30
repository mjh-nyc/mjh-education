<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    <div class="animsition">
      @php do_action('get_header') @endphp
      @include('partials.header')
      <div class="wrap container" role="document">
        <div class="content">
          <main class="main">
            @yield('content')
          </main>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            @yield('testimonies-and-artifacts')
          </div>
        </div>
      </div>
      @php do_action('get_footer') @endphp
      @include('partials.footer')
      @php wp_footer() @endphp
    </div>
    @include('partials.trackers')
  </body>
</html>
