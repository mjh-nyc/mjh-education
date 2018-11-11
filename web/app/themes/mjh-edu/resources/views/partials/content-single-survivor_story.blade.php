<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title">{{ $survivor }}</h1>
    @include('partials/content-survivor-story-chapter-navigation')
  
    <div class="resources">
      <div class="resources__link">
        <i class="fa fa-map-o" aria-hidden="true"></i> <a href="/legacy/geography/quiz_page.php?name={{ strtolower($survivor) }}&question=1" data-lity>Geography Quiz</a>
      </div>
      <div class="resources__link">
        <i class="fa fa-edit" aria-hidden="true"></i> <a href="#">Project Suggestions</a>
      </div>
      <div class="resources__link">
        <i class="fa fa-television" aria-hidden="true"></i> <a href="#">Resources</a>
      </div>
    </div>
  </header>
  <div class="entry-content">
     @include('partials.entry-taxonomy-categories')
    <h2>{{ get_the_title() }}</h2>
    {!! \App\Controllers\TemplateGlossaryListing::cmttGlossaryParse($post->post_content) !!}
  </div>
  <footer>
    @include('partials/content-survivor-story-chapter-navigation')
    {{--
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
    --}}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
