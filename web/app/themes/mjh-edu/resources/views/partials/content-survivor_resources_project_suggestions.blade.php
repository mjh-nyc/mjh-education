<header>
	<div class="back-link">
        &#8592; <a class="" href="/survivor-stories/{{ strtolower($survivor) }}">{!! _e("Back to ".$survivor."’s story ","sage") !!}</a>
    </div>
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
</header>
<div class="entry-content">
    <div class="content">{!! get_field('project_suggestions_list')  !!}</div>
</div>
