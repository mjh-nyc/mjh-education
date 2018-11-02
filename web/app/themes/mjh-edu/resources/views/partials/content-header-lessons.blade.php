<div class="@if(App::featuredImage()) col-md-6 @else col-md-2 @endif">
@include('partials.content-featured-image')
</div>
<div class="lesson-header @if(App::featuredImage()) col-md-6 @else col-md-8 no-featured-image @endif">
    <div class="post-title"><h1>{!! App::title() !!}</h1></div>
    <div class="post-links">
        <ul>
        	@if(App::get_field('download'))
            	<li class="post-link--lesson"><a class="cta cta-white cta-icon cta-download animsition-link" href="{{App::get_field('download')}}">{{ __('Download This Lesson Plan', 'sage') }}</a></li>
            @endif
            @if(App::get_field('all_lesson_plans_archive','option'))
            	<li class="post-link--lessons"><a href="{{App::get_field('all_lesson_plans_archive','option')}}" class="all">{{ __('Download All Lesson Plans', 'sage') }}</a></li>
            @endif
        </ul>
    </div>
    <div class="post-themes">
    	@include('partials.entry-taxonomy-categories')
    </div>
</div>