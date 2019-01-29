<div class="artifacts-listing">
    {{-- Artifacts Listing --}}

    @if (!empty($artifacts))
    
        <div class="artifacts">
            <ul>
                @foreach ($artifacts as $artifact)
                    <li>
                        <div class="artifact">
                            <div class="artifact__image">
                                {{-- App::featuredImageSrc('large',$artifact->ID) --}}
                                <a href="{{ get_the_permalink($artifact->ID) }}">
                                    @if (has_post_thumbnail($artifact->ID))
                                        {!! get_the_post_thumbnail($artifact->ID, 'square@1x') !!}
                                    @else
                                        <img src="@asset('images/image-feature-placeholder.png')" alt="{{ __('Artifact preview','sage') }}" class="lazy">
                                    @endif
                                </a>
                            </div>
                            <div class="artifact__title">
                                <h4>{!! $artifact->post_title !!}</h4>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div> 
    @endif
    
</div>

@if ($get_max_num_pages)
    @include('partials.pagination',['max_num_pages'=>$get_max_num_pages])
@endif