<div class="testimonies-listing">
    {{-- Testimonies Listing --}}

    @if (!empty($testimonies))
    
        <div class="testimonies">
            <ul>
                @foreach ($testimonies as $testimony)
                    <li>
                        <div class="testimony">
                            <div class="testimony__image">
                                <a href="{{ get_the_permalink($testimony->ID) }}">
                                    @if (has_post_thumbnail($testimony->ID))
                                        {!! get_the_post_thumbnail($testimony->ID, 'square@2x') !!}
                                    @else
                                        <img src="@asset('images/video-feature-placeholder.png')" alt="{{ __('Video testimony','sage') }}">
                                    @endif
                                </a>
                            </div>
                            <div class="testimony__title">
                                <h4>{{ $testimony->post_title }}</h4>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div> 
    @endif
    
</div>