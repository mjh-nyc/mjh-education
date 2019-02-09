<div class="col-md-2"></div>
<div class="timeline-header col-md-8">
    <div class="post-title"><h1>{!! App::title() !!}</h1></div>
    <div class="post-content">{!! the_content() !!}</div>
    <div class="survivor-dropdown">
        <form id="survivor-timeline-form" action="{!! get_home_url() !!}/timeline/" >
            <select name="survivor-story" class="survivor-select" title="{{__('Select Survivor','sage')}}">
                <option>{{__('Select Survivor','sage')}}</option>
                @foreach($survivors as $survivor)
                    <option value="{{$survivor->slug}}" @if($survivor->slug == $survivor_story_query_var) selected @endif>{{$survivor->name}}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>