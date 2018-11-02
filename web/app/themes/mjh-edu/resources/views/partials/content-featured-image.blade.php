<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="featured-image">
                <img src="{!! App::featuredImageSrc('large') !!}" />
                <div class="featured-image--description">{{ App::featuredImageDesc(get_post_thumbnail_id()) }}</div>
            </div>
        </div>
    </div>
</div>