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

        {% if single is defined %}
            <a class="favoriter btn {% if post.postFavoriteCurrentUser() %} btn-danger {% else %} btn-outline-danger {% endif %}  float-right" data-object-id="{{ post.id }}" href="#">
                <i class="fa fa-heart"></i> {{ post.postFavorite() }}
            </a>
            {{ partial('partials/vote', ['objectId': post.id, 'object': 'posts']) }} 
            <hr/>
        {% endif %}

        
          <p class="post-meta">{{ post.getHumanCreatedAt() }}  by <a href="/@{{ post.user.username }}">{{ post.user.username }}</a> - {{ post.numberReply }} {{ t('Answers') }} - {{ post.numberViews }} {{ t('Views') }}  </p>
         
     
</article>
