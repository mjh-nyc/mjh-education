@if(is_user_logged_in())
    @if(App::get_field('download'))
        <a class="cta cta-white cta-icon cta-download animsition-link" href="{{App::get_field('download')}}">{{ __('Download This Lesson Plan', 'sage') }}</a>
    @endif
@else
    <a class="cta cta-black cta-icon cta-arrow animsition-link" href="{{wp_login_url( get_permalink() )}}">{{ __('Sign in to see more', 'sage') }}</a>
@endif