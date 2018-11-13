@if($timelines)
    <div class="posts-wrapper">
        <div class="year-section row gutter-0">
            <div class="year-wrapper">
            </div>
            <div class="col-md-9">
                <div class="non-grid posts-wrapper clearfix">
                    <div class="grid-item timeline size-3" >
                        <h4>{{ __('World Events','sage')  }}</h4>
                    </div>
                    @if($survivor_term)
                    <div class="grid-item timeline size-3" >
                        <h4>{{ $survivor_term->name }}</h4>
                    </div>
                    @endif
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
                        <div class="grid-item timeline--world-events size-3 " >
                            @if(!empty($timeline['world-events']))
                                @foreach($timeline['world-events'] as $post )
                                    <div class="timeline--item">
                                        <div class="timeline--date">
                                            <h4>{{ get_post_field('post_title', $post['post_id']) }}</h4>
                                            {{-- <span class="month">{{ get_field('timeline_month', $post['post_id']) }}</span>
                                            <span class="day">{{ get_post_field('timeline_day', $post['post_id']) }}</span> --}}
                                        </div>
                                        <div class="timeline--excerpt">
                                            {{ get_post_field('post_content', $post['post_id']) }}
                                        </div>
                                        {{-- @if(!empty($post['related_items']))
                                        <div class="timeline--related-items">
                                            <!-- RELATED ITEMS HERE -->
                                            <ul class="listing">
                                                @foreach($post['related_items'] as $related_item )
                                                <li>
                                                    <a class="cta cta-white cta-icon cta-arrow animsition-link" href="{!! get_permalink($related_item->ID) !!}">{{ __('View Related', 'sage') }} {!! get_post_type_object($related_item->post_type)->label !!}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif --}}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if(!empty($timeline['survivor-stories']))
                            <div class="grid-item timeline--survivor-stories size-3" >
                                @foreach($timeline['survivor-stories'] as $post )
                                    <div class="timeline--item">
                                        <div class="timeline--date">
                                            {{--<span class="month">{{ get_field('timeline_month', $post['post_id']) }}</span>
                                            <span class="day">{{ get_post_field('timeline_day', $post['post_id']) }}</span> --}}
                                            <h4>{{ get_post_field('post_title', $post['post_id']) }}</h4>
                                        </div>
                                        <div class="timeline--excerpt">
                                            {{ get_post_field('post_content', $post['post_id']) }}
                                        </div>
                                        @if($post['post_id'] == $selected_survivor_timeline_init_post_id && !empty($survivor_image))
                                            <div class="timeline--featured-image">
                                                <img src="{!! $survivor_image !!}" />
                                            </div>
                                        @endif
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