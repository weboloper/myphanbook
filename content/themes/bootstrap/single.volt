{% extends 'layouts/layout.volt' %}
{% block title %}{{ post.getTitle() ? post.getTitle() : 'Phanbook' }}{% endblock %}
{% block content %}
    {% if post is defined %}
    <div class="row">
            <div class="col-md-9">
                {{ partial('partials/item-posts', ['single' : true]) }}

                <div class="share-tahs mb-2">
                    <div class="post-tags"> 
                    {% for modelTag in post.tag%}
                        {{link_to('tags/' ~ modelTag.id ~ '/' ~ modelTag.slug, modelTag.name , 'class': 'badge badge-secondary') }} 
                    {% endfor %}
                    </div>
                </div>  

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                    <div class="col-4 col-sm-2">
                        <img   src="{{ getAvatarSrc(post.user.avatar) }}" class="img-thumbnail img-fluid">
                    </div>
                    <div class="col-8 col-sm-10">
                    <strong><a href="/@{{ post.user.username }}" original-title="" class="tooltip-n">
                        {{ post.user.getUsername() }}
                        </a></strong>
                    <p class="card-text">{{ this.markdown.text(post.user.bio) }}</p>
                    </div>
                    </div>
                  </div>
                </div>

 

                {% if comments|length > 0 %}
                <div id="commentlist" class="page-content">
                
                    <h2>Answers ( <span class="color">{{ comments|length }}</span> )</h2>
                    <hr>
                   
                    <ol class="commentlist list-unstyled">
                        {% for comment in comments %}
                        <li class="comment media mb-4">
                            <img class="d-flex mr-3 img-thumbnail img-fluid" src="{{ getAvatarSrc(comment.user.getAvatar()) }}" alt="">
                            <div class="comment-body media-body">
                                
                                {{ partial('partials/vote-reply', ['objectId' : comment.id, 'object' : 'comments', 'votes' : comment]) }}

                                <h5 class="mt-0"><a href="/@{{ comment.user.username }}">{{ comment.user.getFullName() }}</a></h5>
                                    
                                {{ getHumanDate(comment.createdAt)  }}

                                <div class="text"><p>{{ this.markdown.text(comment.content) }}</p></div>
                                 
                            </div>
                        </li>
                        {% endfor %}
                    </ol><!-- End commentlist -->
                </div><!-- End page-content -->
                {% endif %}
                <div id="respond" class="comment-respond page-content clearfix">
                    <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
                    {{ form( 'comments/new', 'id' : 'commentform', 'class' : 'comment-form') }}
                        {% if post is defined %}
                            {{ hidden_field('id', 'value': post.id) }}
                        {% endif %}
                        <div id="respond-textarea">
                            <p>
                                <label class="required" for="comment">Your comment<span>*</span></label>
                                {{ form.render('content') }}
                            </p>
                        </div>
                        <p class="form-submit">
                            <input name="submit" type="submit" id="submit" value="Post your answer" class="btn btn-primary">
                        </p>
                         {{ form.render('object', ['value': 'questions']) }}
                    </form>
                </div>
 
            </div><!-- End main -->
            <aside class="col-md-3 sidebar">
            {{ partial('partials/right-side') }}
            </aside>
        </div><!-- End row -->
    {% else %}
        <p> Sorry post not exsing</p>
    {% endif %}
{% endblock %}
