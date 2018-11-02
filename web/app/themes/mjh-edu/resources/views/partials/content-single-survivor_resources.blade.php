<article @php post_class() @endphp>
  <div class="entry-content">
    @if( SingleSurvivor_resources::get_quiz_questions_count() > 0 )
      <div class="answer-overlay">
        @php 
          $questions = App::get_repeater_field('quiz_questions');
          $questionNum = App::get_uri_param('question');          
        @endphp

        @if(SingleSurvivor_resources::get_quiz_questions_count() >$questionNum )
          <h2>{{ $questions[$questionNum]['quiz_question'] }}</h2>

          @foreach ($questions[$questionNum]['quiz_answers'] as $key => $answer)

            <a href="#option-{{$key}}" data-lity class="answer-option" style="top:{{$answer['position_x']}}px; left:{{$answer['position_y']}}px"><i class="fa fa-circle" aria-hidden="true"><span class="sr-only">@php _e("Answer Option","sage"); @endphp</span></i></a>
            <div id="option-{{$key}}" class="answer lity-hide">
              @if ($answer['answer_type'] == 0)
                <h2>Not quite</h2>
                <p>{{$answer['answer_option']}}</p>
              @else
                <h2>Correct!</h2>
                <p>{{$answer['answer_option']}}</p>
                @if( SingleSurvivor_resources::get_next_quiz_question() )
                  <p><a href="{{ SingleSurvivor_resources::get_next_quiz_question() }}">@php _e("Next Question","sage"); @endphp</a></p>
                @endif
              @endif            
            </div>
          @endforeach
          <img src="{{ get_template_directory_uri() }}/assets/images/geography_europe_map.png" alt="@php _e('Europe circa 1930','sage'); @endphp" width="650" height="525">
        @else
          <h2>Question Not Found</h2>
          <p><a href="{{ the_permalink() }}" class="cta cta-white cta-arrow animsition-link">Reset Quiz</a>
        @endif
      </div>
    @endif


  </div>
</article>
