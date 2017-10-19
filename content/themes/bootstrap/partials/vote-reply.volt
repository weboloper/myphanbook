{% if votes is defined %}
<div class="comment-vote float-right">
	<span class="btn btn-secondary btn-sm disabled vote-result">{{ votes.positive - votes.negative }}</span>
    <a href="#" class="btn btn-secondary btn-sm voter" title="Like" data-way="positive" data-object-id="{{ objectId }}" data-object="{{ object }}" data-way="negative"><i class="fa fa-thumbs-up"></i></a>
    <a href="#" class="btn btn-secondary btn-sm voter" title="Dislike" data-way="negative" data-object-id="{{ objectId }}" data-object="{{ object }}"><i class="fa fa-thumbs-down"></i></a>  
</div>
{% endif %}

