<article class="{{ t(post.type | capitalize ) }} post{% if single is defined %} single-post{% endif %} mb-5">
    {% set postLink = post.getType() ~ '/' ~ post.getId() ~ '/' ~ post.getSlug() %}
    <h2 class="mt-4">{{ link_to(postLink, post.title) }}</h2>

    {% if listPost is defined %}
    
    {% endif %}
   
        <div class="post-desc">
            {% if listPost is defined %}
                {{ teaser(post.content, 200) }}
            {% else %}
                {{ this.markdown.text(post.content) }}
            {% endif %}
        </div>

        <hr/>
        <p class="post-meta">{{ post.getHumanCreatedAt() }}  by <a href="/@{{ post.user.username }}">{{ post.user.username }}</a> - {{ post.numberReply }} {{ t('Answers') }} - {{ post.numberViews }} {{ t('Views') }}  </p>
 
        {% if single is defined %}
            {{ partial('partials/vote', ['objectId': post.id, 'object': 'posts']) }} <span class="favoriter" data-object-id="{{ post.id }}">
                <i class="fa fa-heart"></i>{{ post.postFavorite() }}
            </span>
        {% endif %}
         
     
</article>
