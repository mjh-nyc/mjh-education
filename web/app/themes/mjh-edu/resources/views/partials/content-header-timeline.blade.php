<div class="col-md-5"></div>
<div class="timeline-header col-md-5">
    <div class="post-title"><h1>{!! App::title() !!}</h1></div>
    <div class="post-content">{!! the_content() !!}</div>
    <div class="survivor-dropdown">
        <form id="survivor-timeline-form" action="{!! get_home_url() !!}/timeline/" >
            <select name="survivor-story" class="survivor-select form-control">
                <option>{{__('Select Survivor','sage')}}</option>
                @foreach($survivors as $survivor)
                    <option value="{{$survivor->slug}}" @if($survivor->slug == $survivor_story_query_var) selected @endif>{{$survivor->name}}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>