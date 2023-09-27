@if(App::userSignedUp())
    @if(App::get_field('download'))
        <a class="cta cta-white cta-icon cta-download" href="{{App::get_field('download')}}">{{ __('Download This Lesson Plan', 'sage') }}</a>
    @endif
@else
    <a class="cta cta-black cta-icon cta-arrow" href="{!! get_home_url( ) !!}/signup?redirect_to={!! get_the_ID() !!}">{{ __('Sign up to see more', 'sage') }}</a>
@endif
