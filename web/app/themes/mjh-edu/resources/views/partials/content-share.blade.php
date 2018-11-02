<div class="post-subheader">
    <div class="share">
        <h4>
            @php _e("Share","sage"); @endphp
        </h4>
        <div class="share-options">
            <div class="share-channel">
                <a href="https://www.facebook.com/sharer/sharer.php?u={!! get_the_permalink(); !!}" target="_blank" onclick="ga('send', 'event', 'social', 'share', 'facebook');"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
            <div class="share-channel">
                <a href="https://twitter.com/intent/tweet?text={!! urlencode(App::postTitle()); !!}&url={!! get_the_permalink(); !!}&via={!! App::get_field('twitter_handle', 'option') !!}" onclick="ga('send', 'event', 'social', 'share', 'twitter');" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
            <div class="share-channel">
                <a href="mailto:?&subject=I thought you might find this interesting!&body={!! App::postTitle(); !!}%0A%0A{!! get_the_permalink(); !!}" onclick="ga('send', 'event', 'social', 'share', 'email');"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>