<div class="artifacts-listing">
    {{-- Artifacts Listing --}}

    @if (!empty($artifacts))
    
        <div class="artifacts">
            <ul>
                @foreach ($artifacts as $artifact)
                    <li>
                        <div class="artifact">
                            <div class="artifact__image">
                                {{-- get_the_permalink($artifact->ID) --}}
                                <a href="{{ App::featuredImageSrc('large',$artifact->ID) }}" data-lity data-lity-desc="{{ $artifact->post_excerpt }}">
                                    @if (has_post_thumbnail($artifact->ID))
                                        {!! get_the_post_thumbnail($artifact->ID, 'square@1x') !!}
                                    @else
                                        <img src="@asset('images/image-feature-placeholder.png')" alt="{{ __('Artifact preview','sage') }}">
                                    @endif
                                </a>
                            </div>
                            <div class="artifact__title">
                                <h4>{{ $artifact->post_title }}</h4>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div> 
    @endif
    
</div>