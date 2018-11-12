<header>
    <div class="back-link">
        &#8592; <a class="" href="/survivor-stories/{{ strtolower($survivor) }}">{!! _e("Back to ".$survivor."’s story ","sage") !!}</a>
    </div>
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
</header>
<div class="entry-content">
    <div class="content">@php the_content() @endphp</div>
    @if(!empty($media_resources['books']))
        @include('partials.content-survivor_resources_media_resources_item', ['media_resources_items'=>$media_resources['books'],'media_resources_type'=>'books'])

    @endif
    @if(!empty($media_resources['websites']))
        @include('partials.content-survivor_resources_media_resources_item', ['media_resources_items'=>$media_resources['websites'],'media_resources_type'=>'websites'])

    @endif
    @if(!empty($media_resources['films']))
        @include('partials.content-survivor_resources_media_resources_item', ['media_resources_items'=>$media_resources['films'],'media_resources_type'=>'films'])
    @endif
</div>
