<div class="col-md-5"></div>
<div class="timeline-header col-md-5">
    <div class="post-title"><h1>{!! App::title() !!}</h1></div>
    <div class="post-content">{!! the_content() !!}</div>
    <div class="survivor-dropdown">
        <form id="survivor-form">
            <select name="survivor" class="survivor-select form-control">
                <option>{{__('Select Survivor','sage')}}</option>
                @foreach($survivors as $survivor)
                    <option value="{{$survivor->term_id}}" @if($selected_survivor ==$survivor->term_id ) selected @endif>{{$survivor->name}}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>