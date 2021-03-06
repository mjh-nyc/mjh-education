@if(!is_category() && !is_archive() && !is_search() && !is_404())
<div class="container hero @if(!empty($page_template) && $page_template=='timeline') timeline-header-wrapper @endif" @if(!empty($page_template) && $page_template=='timeline') style="background: url('{{App::featuredImageSrc('header')}}') no-repeat"@endif>
    <div class="row">
        {{-- If single lesson page, our header contains title, image and download buttons --}}
        @if(!empty($post) && $post->post_type == 'lessons')
            @include('partials.content-header-lessons')
        {{-- If timeline template, our header contains title, image and dropdown --}}
        @elseif(!empty($page_template) && $page_template=='timeline')
            @include('partials.content-header-timeline')
        @elseif(!empty($post) && ($post->post_type == 'artifacts' || $post->post_type == 'testimony'))
            {{-- no featured image for artifacts and testimony --}}
        @else
        {{-- Otherwise, print just the header image --}}
            <div class="col-12">
                @include('partials.content-featured-image')
            </div>
        @endif
    </div>
</div>
@endif