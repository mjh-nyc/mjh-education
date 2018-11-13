<footer class="content-info">
  <div class="container">
  	<div class="row">
    	@php dynamic_sidebar('sidebar-footer') @endphp
    </div>
  </div>
  <div class="container secondary">
  	<div class="row">
  		<div class="col-md-8">
    		&#169; {{ date("Y") }} {!! _e('Museum of Jewish Heritage—A Living Memorial to the Holocaust. All rights reserved.','sage') !!}
    	</div>
    	<div class="col-md-4">
    		@if (has_nav_menu('footer_navigation'))
            	{!! wp_nav_menu(['theme_location' => 'footer_navigation']) !!}
          	@endif
    	</div>
    </div>
  </div>
</footer>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-29738632-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-29738632-5');
</script>
