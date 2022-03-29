<header class="banner" id="top">
	<div class="sticky">
		<div class="sticky-container">
			<div class="container">
				<div class="row top-row">
					<div class="col-md-3 social-channels">
						{!! App::get_social() !!}
					</div>
					<div class="col-9 col-md-6 logo">
						<a href="/" class="animsition-link">
							{!! file_get_contents(App::siteLogo()) !!}
						</a>
					</div>
					<div class="col-3 navigation">
            <div class="account-links">
              {!! App::get_account_links() !!}
            </div>
						<div class="hamburger hamburger--spin">
							<div class="hamburger-box">
								<div class="hamburger-inner"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if (is_front_page())
    <!-- featured image and page title area -->
    <div class="hero-area parallax-window" data-parallax="scroll" data-image-src="{{App::featuredImageSrc('homepage-header')}}" data-over-scroll-fix="true" alt="{{App::featuredImageAlt(get_the_ID())}}">
      <div class="sr-only">{{App::featuredImageAlt(get_post_thumbnail_id())}}</div>
      <div class="container">
      	<div class="row">
      		<div class="col-md-1"></div>
      		<div class="col-md-10">
      			@include('partials.page-header')
      		</div>
      	</div>
	  </div>
    </div>
  	<!-- //end featured image and page title area -->
	@else
		@include('partials.content-header')
	@endif
</header>


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
          <div class="account-links">
            {!! App::get_account_links() !!}
          </div>
      </div>
    </div>
  </div>
</div>
<?php /* TODO: kept for reference, remove when port is finished
<div class="overlay-nav container-fluid no-gutters" style="">
  <div class="container">
    <div class="row">
      <div class="wrapper">
        <div class="site-search">
          {!! get_search_form(false) !!}
        </div>
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation']) !!}
          @endif
        </nav>
        <footer>
          <div class="social-channels">
            {!! App::get_social() !!}
          </div>
          <div class="account-links">
            {!! App::get_account_links() !!}
          </div>
		</footer>
      </div>
    </div>
  </div>
</div>
 */ ?>
