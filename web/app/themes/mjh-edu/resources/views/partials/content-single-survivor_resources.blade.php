<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title">{{ get_the_title() }}</h1>
  </header>
  <div class="entry-content">

    @if(App::get_repeater_field('quiz_questions'))
      <div class="answer-overlay">
        @php 
          $answerCounter = 1;
          $questions = App::get_repeater_field('quiz_questions');
          $questionNum = App::get_uri_param('question');
          $totalQuestions = count($questions);
          
        @endphp



        {{ $questions[$questionNum]['quiz_question'] }}

        @foreach ($questions[$questionNum]['quiz_answers'] as $answer)

          <a href="#option-{{$answerCounter}}" data-lity class="answer-option" style="top:{{$answer['position_x']}}px; left:{{$answer['position_y']}}px"><i class="fa fa-circle" aria-hidden="true"><span class="sr-only">@php _e("Answer Option","sage"); @endphp</span></i></a>
          <div id="option-{{$answerCounter}}" class="answer lity-hide">
            @if ($answer['answer_type'] == 0)
              <h2>Not quite</h2>
              <p>{{$answer['answer_option']}}</p>
            @else
              <h2>Correct!</h2>
              <p>{{$answer['answer_option']}}</p>
              <p><a href="{{ the_permalink() }}">@php _e("Next Question","sage"); @endphp</a></p>
            @endif            
          </div>

          @php $answerCounter++; @endphp
        @endforeach
      </div>
      <img src="/app/themes/mjh-edu/dist/images/geography_europe_map.png" alt="@php _e('Europe circa 1930','sage'); @endphp" width="650" height="525">
    @endif


  </div>
</article>
