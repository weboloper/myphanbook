{% if votes is defined %}
<ul class="list-inline">
 
    <a href="#" class="btn btn-outline-secondary voter"  title="Like" data-way="positive" data-object-id="{{ objectId }}" data-object="{{ object }}">
        <i class="fa fa-thumbs-up"></i>
    </a>
    <a href="#" class="btn btn-outline-secondary voter" role="button" aria-pressed="true" title="Dislike" data-way="negative" data-object-id="{{ objectId }}" data-object="{{ object }}"><i class="fa fa-thumbs-down"></i></a>
     <span class="btn btn-outline-secondary  disabled vote-result">{{ vote_score(objectId, object) }}</span>
 
</ul>
{% endif %}
