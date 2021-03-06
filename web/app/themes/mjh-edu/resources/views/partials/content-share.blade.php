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
                <a href="mailto:?subject=I thought you might find this interesting!&body={!! rawurlencode(App::postTitle()); !!}%0A%0A{!! get_the_permalink(); !!}" onclick="ga('send', 'event', 'social', 'share', 'email');"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
            </div>


            @if ( ($post->post_type == 'event') && (App::get_field('event_type',get_the_ID()) == 'onetime'))
                @if( (App::get_field('event_type',get_the_ID()) == 'ongoing') || ( App::get_field('event_type',get_the_ID()) == 'onetime' && App::get_field('event_end_time') ) )
                    <div class="calendar share-channel">
                        <div class="calendar-options">
                            <div class="calendar-link small">
                                <span>@php _e("Add to my calendar: ","sage"); @endphp</span>
                            </div>
                            <div class="calendar-link share-channel">
                                <a href="{!! get_stylesheet_directory_uri(); !!}/app/ics.php?eid={!! get_the_ID(); !!}" target="_blank" title="@php _e('Add to iCal','sage'); @endphp"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div class="back-link">
        &#8592; <a class="" href="@if ($post->post_type=='timeline') /timeline/ @else {{get_post_type_archive_link( $post->post_type ) }} @endif">{!! _e("See All ","sage") !!}</a>
    </div>
</div>