@if($timelines)
    <div class="posts-wrapper">
        <div class="year-section row gutter-0">
            <div class="year-wrapper">
            </div>
            <div class="col-md-9">
                <div class="non-grid posts-wrapper clearfix">
                    <div class="grid-item timeline size-3" >
                        {{ __('World Events','sage')  }}
                    </div>
                    <div class="gutter-sizer"></div>
                </div>
            </div>
        </div>
        @foreach($timelines as $year => $timeline )
            <div class="year-section row gutter-0" data-year="{{$year}}">
                <div class="year-wrapper">
                    <h3 class="year" id="year-{{$year}}">{{$year}}</h3>
                </div>
                <div class="col-md-9">
                    <div class="non-grid posts-wrapper clearfix">
                        <div class="grid-item timeline size-3" >
                            @if(!empty($timeline['world-events']))
                                @foreach($timeline['world-events'] as $post_id )
                                    <div class="timeline--item">
                                        <div class="excerpt">
                                            <span class="small">{{ get_post_field('post_content', $post_id) }}</span>
                                        </div>
                                        <div class="related-items">
                                            <!-- DISCOVER ITEMS HERE -->
                                            <ul class="listing">
                                                <li>XYZ</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if(!empty($timeline['survivor-stories']))
                            <div class="grid-item timeline size-3" >
                                @foreach($timeline['survivor-stories'] as $post_id )
                                    <div class="timeline--item">
                                        <div class="excerpt">
                                            <span class="small">{{ get_post_field('post_content', $post_id) }}</span>
                                        </div>
                                        <div class="related-items">
                                            <!-- DISCOVER ITEMS HERE -->
                                            <ul class="listing">
                                                <li>XYZ</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="gutter-sizer"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif