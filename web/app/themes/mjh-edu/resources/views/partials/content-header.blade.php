<div class="container hero">
    <div class="row">
        {{-- If single lesson page, our header contains title, image and download buttons --}}
        @if($post->post_type == 'lessons')
            @include('partials.content-header-lessons')
        @else
        {{-- Otherwise, print just the header image --}}
            <div class="col-md-1"></div>
            <div class="col-md-10">
                @include('partials.content-featured-image')
            </div>
        @endif
    </div>
</div>