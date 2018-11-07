@foreach($category_posts->posts as $category_post)
    @php $current_start_count++ @endphp
    <article @php post_class() @endphp>
      <div class="post--count">{{$current_start_count}}</div>
      <div class="post--content">
        <header>
          <h2 class="entry-title"><a href="{!! get_permalink($category_post->ID) !!}">{!! $category_post->post_title !!}</a></h2>
        </header>
        <div class="entry-content">
          {!! App::truncateString($category_post->post_content, $limit=50) !!}
        </div>
      </div>
    </article>
@endforeach
@if ($category_posts->max_num_pages)
  @include('partials.pagination',['max_num_pages'=>$category_posts->max_num_pages])
@endif