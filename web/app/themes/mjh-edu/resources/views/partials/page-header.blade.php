<div class="page-header">
  	@if (!is_front_page())
  		<h1>{!! App::title() !!}</h1>
		@include('partials.entry-taxonomy-categories')
  	@else
		<h1>{!! strip_tags(get_the_content()) !!}</h1>
  		<div>
  			<a class="cta cta-white cta-icon cta-arrow animsition-link" href="{{App::get_field('main_cta_url')}}">{{App::get_field('main_cta_label')}}</a>
  		</div>
  	@endif
</div>
