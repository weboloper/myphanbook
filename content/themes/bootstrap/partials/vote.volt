{% if votes is defined %}
<ul class="list-inline">
 
 	<span class="btn btn-secondary  disabled vote-result">{{ vote_score(objectId, object) }}</span>
     <a href="#" class="btn btn-secondary voter"  title="Like" data-way="positive" data-object-id="{{ objectId }}" data-object="{{ object }}">
        <i class="fa fa-thumbs-up"></i>
    </a>
 

     <a href="#" class="btn btn-secondary voter" role="button" aria-pressed="true" title="Dislike" data-way="negative" data-object-id="{{ objectId }}" data-object="{{ object }}"><i class="fa fa-thumbs-down"></i></a>
 
</ul>
{% endif %}
