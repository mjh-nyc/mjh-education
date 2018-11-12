<div class="categories-listing">
    {{-- Categories Listing --}}
    @if (!empty($categories))
        <div class="categories">
            @foreach ($categories as $category)
                <div class="category">
                    <div class="category__name">
                        <span class="category__count">{!! $category->count!!}</span>
                        <h4>
                            <a class="category__link" href="{!! get_home_url() !!}/category/{{$category->slug}}">
                                {{$category->name}}
                            </a>
                        </h4>
                    </div>
                </div>

            @endforeach

        </div>
    @endif
    {{-- //Categories Listing --}}
</div>