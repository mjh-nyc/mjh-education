<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    <div class="animsition">
      @php do_action('get_header') @endphp
      @include('partials.header')
      @yield('hero-slider')
      <div class="container" role="document">
        <div class="content">
          @yield('lessons-carousel')
          @yield('custom-carousel')
        </div>
      </div>
      @php do_action('get_footer') @endphp
      @include('partials.footer')
      @php wp_footer() @endphp
    </div>
    @include('partials.trackers')
  </body>
</html>
