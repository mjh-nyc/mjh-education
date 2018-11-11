<div class="glossary-listing">
    {{-- Glossary Listing --}}
    @if (!empty($glossaries))
        <div class="glossary">
            <div class="glossary-header">
                <ul class="glossary--nav">
                    @foreach ($glossaries as $key => $glossary)
                        <li>
                            @if(!empty($glossary))
                                <a class="glossary--link active" href="#alpha-{{$key}}">{{ ucwords($key) }}</a>
                            @else
                                <span class="glossary--inactive">{{ ucwords($key) }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="glossary--lists">
                @foreach ($glossaries as $key => $glossary)
                    @if(!empty($glossary))
                        <div class="glossary--list-items">
                            <div class="glossary--list-items--header" id="alpha-{{$key}}">
                                {{ ucwords($key) }}
                            </div>
                            <div class="glossary--list-items--content">
                                <ul>
                                @foreach ($glossary as $word)
                                    <li class="glossary--list-items--item" id="{{$word->post_name}}">
                                        <div class="glossary--list-items--item--word">
                                            {{$word->post_title}}
                                        </div>
                                        <div class="glossary--list-items--item--define">
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