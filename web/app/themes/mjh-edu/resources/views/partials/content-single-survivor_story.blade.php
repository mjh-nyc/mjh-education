<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title">{{ $survivor }}</h1>
    @include('partials/content-survivor-story-chapter-navigation')
    @include('partials.entry-taxonomy-categories')
  </header>
  <div class="entry-content">
    <h2>{{ get_the_title() }}</h2>
    @php the_content() @endphp
  </div>
  <footer>
    <!-- Previous/Next navigation -->
    @if($survivor_story_next_prev)
        <div class="navigation">
            @if($survivor_story_next_prev['previous'])
              <div class="alignleft">
                <a href="{!! get_permalink($survivor_story_next_prev['previous'])  !!}"
                   title="{{get_the_title($survivor_story_next_prev['previous'])}}">{{ __('Previous', 'sage') }}</a>
              </div>
            @endif
            @if($survivor_story_next_prev['next'])
              <div class="alignright">
                <a href="{!! get_permalink($survivor_story_next_prev['next'])  !!}"
                   title="{{get_the_title($survivor_story_next_prev['next'])}}">{{ __('Next', 'sage') }}</a>
              </div>
            @endif
        </div>
    @endif
    <!-- Previous/Next navigation -->
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
