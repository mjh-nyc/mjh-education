<div class="col-md-5"></div>
<div class="timeline-header col-md-5">
    <div class="post-title"><h1>{!! App::title() !!}</h1></div>
    <div class="post-content">{!! the_content() !!}</div>
    <div class="survivor-dropdown">
        <select class="form-control">
            <option>{{__('Select Survivor','sage')}}</option>
            @foreach($survivors as $survivor)
                <option value="{{$survivor->term_id}}" @if($selected_survivor ==$survivor->term_id ) selected @endif>{{$survivor->name}}</option>
            @endforeach
        </select>
    </div>
</div>