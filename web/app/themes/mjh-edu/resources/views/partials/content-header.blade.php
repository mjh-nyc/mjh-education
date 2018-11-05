<div class="container hero" @if(!empty($page_template) && $page_template=='timeline') style="background: url('{{App::featuredImageSrc('header')}}') no-repeat"@endif>
    <div class="row">
        {{-- If single lesson page, our header contains title, image and download buttons --}}
        @if($post->post_type == 'lessons')
            @include('partials.content-header-lessons')
        {{-- If timeline template, our header contains title, image and dropdown --}}
        @elseif(!empty($page_template) && $page_template=='timeline')
            @include('partials.content-header-timeline')
        @else
        {{-- Otherwise, print just the header image --}}
            <div class="col-md-1"></div>
            <div class="col-md-10">
                @include('partials.content-featured-image')
            </div>
        @endif
    </div>
</div>