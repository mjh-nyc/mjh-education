<div class="categories-listing">
    {{-- Categories Listing --}}
    @if (!empty($categories))
        <div class="categories">
            <ul>
                @foreach ($categories as $category)
                    <li>
                        <div class="category">
                            <a class="category--link" href="{!! get_home_url() !!}/category/{{$category->slug}}"><span class="category--count">{!! $category->count!!}</span></a>
                            <div class="category--name"> <h2>{{$category->name}}</h2></div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- //Categories Listing --}}
</div>