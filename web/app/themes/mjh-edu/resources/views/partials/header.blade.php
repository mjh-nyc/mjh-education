<header class="banner">
	<div class="sticky">
		<div class="sticky-container">
			<div class="container-fluid">
				<div class="row top-row">
					<div class="col-3 social">Social icons</div>
					<div class="col-6 logo">
						{!!  get_custom_logo() !!}
					</div>
					<div class="col-3 navigation">
						<!--<a href="#" class="search"><i class="fa fa-search" aria-hidden="true"><span class="sr-only">@php _e("Search","sage"); @endphp</span></i></a>-->
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
    <!-- featured image and page title area -->
    <div class="hero-area parallax-window" data-parallax="scroll" data-image-src="{{App::featuredImageSrc('homepage-header')}}" data-over-scroll-fix="true" alt="{{App::featuredImageAlt(get_post_thumbnail_id())}}">
      <div class="sr-only">{{App::featuredImageAlt(get_post_thumbnail_id())}}</div>
      <div class="container">
      	<div class="row">
      		<div class="col-md-1"></div>
      		<div class="col-md-10">
      			@include('partials.page-header')
      		</div>
      	</div>
    </div>
  	<!-- //end featured image and page title area -->
</header>

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
      </div>
    </div>
  </div>
</div>
