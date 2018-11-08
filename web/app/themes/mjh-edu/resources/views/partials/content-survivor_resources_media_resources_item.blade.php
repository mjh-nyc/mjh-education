<h2>{!! ucfirst($media_resources_type) !!}</h2>
<ul class="media_resources--listing {!! $media_resources_type !!}">
    @foreach($media_resources_items as $item)
        <li class="media_resources--item">
            <div class="media_resource">
                <div class="media_resource--title">
                    @switch($media_resources_type)
                        @case('websites')
                            <a href="{!! get_field('website_url',$item->ID) !!}">{!! $item->post_title !!}</a>
                        @break
                        @default
                            {!! $item->post_title !!}
                    @endswitch
                </div>
                <div class="media_resource--attribution">
                    @switch($media_resources_type)
                        @case('books')
                            {!! get_field('book_author',$item->ID) !!}, {!! get_field('book_publisher_and_year',$item->ID) !!}
                        @break
                        @case('websites')
                            {!! get_field('website_url',$item->ID) !!}
                        @break
                        @case('films')
                            {!! get_field('film_meta',$item->ID) !!}
                        @break
                    @endswitch
                </div>
                <div class="media_resource--description">
                    @switch($media_resources_type)
                        @case('books')
                            {!! get_field('book_description',$item->ID) !!}
                        @break
                        @default
                            {!! get_field('website_description',$item->ID) !!}
                    @endswitch
                </div>
            </div>
        </li>
    @endforeach
</ul>

