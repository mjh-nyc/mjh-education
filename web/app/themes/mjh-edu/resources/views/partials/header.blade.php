<header class="banner">

  <div class="container brand-wrapper">
    <div class="row justify-content-between brand">
      <div class="col-6 col-lg-4">
        {!!  get_custom_logo() !!}
      </div>

      <div class="col-6 col-lg-8 right align-items-center">
        <div class="overlay-toggle"><a href="#" tabindex="1" class="primary-nav-toggle" id="primary-nav-toggle"><span class="sr-only"> @php _e("Navigation","sage"); @endphp</span></a></div>
        <div class="top-wrapper">
          <div class="top-links">
            <div class="nav-secondary">
              <div class="menu-mini-top-search">
                <div class="top-search-form" id="menu-mini-top-search--form">
                  <form role="search" method="get" action="{!! home_url( '/' ) !!}">
                    <input type="text" value="" name="s" id="s" placeholder="{!! _e('What are you looking for?','sage') !!}" class="search-field">
                    <input type="submit" id="searchsubmit" value="{!! _e('Search','sage') !!}" class="search-btn">
                    <a href="#" id="menu-mini-top-search--close" class="menu-mini-top-search--close"><span class="sr-only">{!! _e('Close search','sage') !!}</span></a>
                  </form>
                </div>
                <a href="#" class="search-icon" id="menu-mini-top-search--open">Search</span>
              </div>
                @if (!empty($site_navigations['mini_top_navigation']))
                  {!! $site_navigations['mini_top_navigation'] !!}
                @endif
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="top-wrapper container-fluid">

    <div class="sticky">
      <div class="sticky-container">

        <!-- new navigation -->
        <div class="primary-navigation-v2">
          <div class="primary-navigation-v2--left">
            <div class="home-link-sticky">
              <a href="/" aria-label="{!! _e("Return to homepage","sage") !!}"><img src="@asset('images/mjh-mark.png')" width="30" height="30" alt="{!! _e("MJH Logo Mark","sage") !!}"></a>
            </div>
            @if (!empty($site_navigations['primary_navigation']))
              {!! $site_navigations['primary_navigation'] !!}
            @endif
          </div>
          <div class="primary-navigation-v2--right">
            @if (!empty($site_navigations['button_top_navigation']))
              {!! $site_navigations['button_top_navigation'] !!}
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</header>

@if (is_front_page())
  
@else
  @include('partials.content-header')
@endif


<div class="overlay-nav container-fluid no-gutters" style="">
  <div class="container">
    <div class="overlay-toggle">
      <a href="#" id="primary-nav-close"><span class="sr-only"> @php _e("Close Navigation","sage"); @endphp</span></a>
    </div>
    <div class="row">
      <div class="wrapper">
        @if (!empty($site_navigations['button_top_navigation']))
          {!! $site_navigations['button_top_navigation'] !!}
        @endif
        <div class="site-search">
          {!! get_search_form(false) !!}
        </div>
        <nav class="nav-primary">
          @if (!empty($site_navigations['primary_navigation']))
            {!! $site_navigations['primary_navigation'] !!}
          @endif
        </nav>
          @if (!empty($site_navigations['mini_top_navigation']))
            {!! $site_navigations['mini_top_navigation'] !!}
          @endif
        <div class="social-channels">
          {!! App::get_social() !!}
        </div>
      </div>
    </div>
  </div>
</div>