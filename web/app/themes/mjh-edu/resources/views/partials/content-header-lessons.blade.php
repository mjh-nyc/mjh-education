<div class="@if(App::featuredImage()) col-md-6 @else col-md-2 @endif">
@include('partials.content-featured-image')
</div>
<div class="lesson-header @if(App::featuredImage()) col-md-6 @else col-md-8 no-featured-image @endif">
    <div class="post-title"><h1>{!! App::title() !!}</h1></div>
    <div class="post-links">
        <ul>
        	@if(App::get_field('download'))
            	<li class="post-link--lesson">@include('partials.content-download-lesson-link')</li>
            @endif
            @if(App::get_field('all_lesson_plans_archive','option') && is_user_logged_in() )
            	<li class="post-link--lessons"><a href="{{App::get_field('all_lesson_plans_archive','option')}}" class="all">{{ __('Download All Lesson Plans', 'sage') }}</a></li>
            @endif
        </ul>
    </div>
    <div class="post-themes">
    	@include('partials.entry-taxonomy-categories')
    </div>
</div>