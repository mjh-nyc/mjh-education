@php the_content() @endphp
{!! $fail_message !!}
@php wp_login_form( array('redirect' => $redirect ) ); @endphp
{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
