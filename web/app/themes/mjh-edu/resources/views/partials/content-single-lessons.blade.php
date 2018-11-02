<article @php post_class() @endphp>
    <header>
        @include('partials.content-share')
        @include('partials.entry-taxonomy-categories')
    </header>
    <div class="entry-content">
        @if(is_user_logged_in())
            @php the_content() @endphp
        @else
            <h2>{{ __('About this lesson', 'sage') }}</h2>
            @php the_excerpt() @endphp
            <a class="cta cta-white cta-arrow animsition-link" href="{{wp_login_url( get_permalink() )}}">{{ __('Sign in to see more', 'sage') }}</a>
        @endif
    </div>
    <footer>
        {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </footer>
    @php comments_template('/partials/comments.blade.php') @endphp
</article>
