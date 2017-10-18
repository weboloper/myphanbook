{% if votes is defined %}

<span class="btn btn-secondary  disabled vote-result">{{ vote_score(objectId, object) }}</span>
<ul class="list-inline">

   
 
 
    <li class="list-inline-item">
    <a href="#" class="btn btn-primary voter"  title="Like" data-way="positive" data-object-id="{{ objectId }}" data-object="{{ object }}">
        <i class="fa fa-thumbs-up"></i>
    </a>
    </li>

     <li class="list-inline-item">
    <a href="#" class="btn btn-warning voter" role="button" aria-pressed="true" title="Dislike" data-way="negative" data-object-id="{{ objectId }}" data-object="{{ object }}"><i class="fa fa-thumbs-down"></i></a>
    </li>

</ul>
{% endif %}
