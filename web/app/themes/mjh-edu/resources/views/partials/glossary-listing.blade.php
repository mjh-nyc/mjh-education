<div class="glossary-listing">
    {{-- Glossary Listing --}}
    @if (!empty($glossaries))
        <div class="glossary">
            <div class="glossary__header">
                <ul class="glossary__nav">
                    @foreach ($glossaries as $key => $glossary)
                        <li>
                            @if(!empty($glossary))
                                <a class="glossary__link--active" href="#{{ strtoupper($key) }}">{{ ucwords($key) }}</a>
                            @else
                                <span class="glossary__link--inactive">{{ ucwords($key) }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="glossary__lists">
                @foreach ($glossaries as $key => $glossary)
                    @if(!empty($glossary))
                        <div class="glossary__lists-items">
                            <div class="glossary__lists-items-header">
                                <h4 id="{{ ucwords($key) }}">{{ ucwords($key) }}</h4>
                                <div>
                                    <a href="#top">{{ __('Back to top','sage') }}</a>
                                </div>
                            </div>
                            <div class="glossary__lists-items-content">
                                <ul>
                                @foreach ($glossary as $word)
                                    <li class="glossary__lists-item" id="{{$word->post_name}}">
                                        <div class="glossary__lists-item-word">
                                            <strong>{{$word->post_title}}</strong>
                                        </div>
                                        <div class="glossary__lists-item-description">
                                            {!! $word->post_content!!}
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    {{-- //Glossary Listing --}}
</div>