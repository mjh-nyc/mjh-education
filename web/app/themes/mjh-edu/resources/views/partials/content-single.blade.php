<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
    {{-- @include('partials/entry-meta') --}}
    @include('partials.content-share')
    @include('partials.entry-taxonomy-categories')
  </header>
  <div class="entry-content">
    @if(!empty($post) && $post->post_type == 'testimony')
      <div class="video-container">
        {!! App::get_field('testimony_embed') !!}
      </div>
    @endif
    @if(!empty($post) && $post->post_type == 'artifacts' && has_post_thumbnail())
      {!! the_post_thumbnail('large') !!}
    @endif
    <div class="entry-content-body">
      @php the_content() @endphp
    </div>
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
