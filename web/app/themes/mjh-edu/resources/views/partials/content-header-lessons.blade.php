<div class="col-md-6">
@include('partials.content-featured-image')
</div>
<div class="col-md-5">
    <div class="post-title"><h1>{!! App::title() !!}</h1></div>
    <div class="post-links">
        <ul>
            <li class="post-link--lesson"><a class="cta cta-white cta-arrow animsition-link" href="{{App::get_field('download')}}">{{ __('Download this lesson plan', 'sage') }}</a></li>
            <li class="post-link--lessons"><a href="{{App::get_field('all_lesson_plans_archive','option')}}">{{ __('Download all lesson plans', 'sage') }}</a></li>
        </ul>
    </div>
</div>