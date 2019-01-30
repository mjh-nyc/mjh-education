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
          @yield('primary-features')
          </main>
        </div>
      </div>
      <div class="container">
        <div class="content">
          @yield('carousel')
        </div>
      </div>
      <div class="container">
        <div class="content">
          @yield('secondary-features')
        </div>
      </div>
      <div class="container">
        <div class="content">
          @yield('supporting-features')
        </div>
      </div>
      @php do_action('get_footer') @endphp
      @include('partials.footer')
      @php wp_footer() @endphp
    </div>
    @include('partials.trackers')
  </body>
</html>
