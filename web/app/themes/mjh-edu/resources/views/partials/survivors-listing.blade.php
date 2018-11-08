<div class="survivors-listing">
    {{-- Survivors Listing --}}
    @if (!empty($survivors))
        <div class="survivors">
            <ul>
                @foreach ($survivors as $survivor)
                    <li>
                        <div class="survivor">
                        <a class="survivor--link" href="{!! $survivor['link'] !!}">
                            @if($survivor['survivors_past_image'])
                                <div class="survivor--image">
                                  <img alt="{{ __('View their story', 'sage') }}" data-attr-past="{{$survivor['survivors_past_image']['url']}}" data-attr-current="{{$survivor['survivors_current_image']['url']}}" src="{{$survivor['survivors_past_image']['url']}}"/>
                                </div>
                            @else
                                <span class="survivor--no-image">{{ __('View their story', 'sage') }}</span>
                            @endif
                        </a>
                            <h3>{{$survivor['name']}}</h3>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- //Survivors Listing --}}
</div>