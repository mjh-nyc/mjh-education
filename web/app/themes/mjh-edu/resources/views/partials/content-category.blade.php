@foreach($category_posts->posts as $category_post)
    @php $current_start_count++ @endphp
    <article @php post_class() @endphp>
      {{-- <div class="post--count">{{$current_start_count}}</div> --}}
      <div class="post--content">
        <header>
          <h2 class="entry-title">
              <a href="@if($category_post->post_type=='timeline'){!! get_home_url() !!}/timeline/#year-{!! get_field('timeline_year',$category_post->ID) !!} @else {!! get_permalink($category_post->ID) !!}@endif">
                  {!! $category_post->post_title !!}</a>
          </h2>
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