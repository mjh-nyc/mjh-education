<div class="container hero">
    <div class="row">
        @if($post->post_type == 'lessons')
            @include('partials.content-header-lessons')
        @else
            <div class="col-md-1"></div>
            <div class="col-md-10">
                @include('partials.content-featured-image')
            </div>
        @endif
    </div>
</div>