{% extends 'layouts/layout.volt' %}
{% block title %}{{ page is defined ? page.getTitle() : 'Phanbook'}}{% endblock %}
{% block content %}
     <ul class="list-group activity-list">
  
     {% for notification in notifications %}
       
         <li class="list-group-item {% if  notification.getWasRead() == "N" %} list-group-item-success {% endif %}">
          
          <img alt="64x64" class="media-object pull-left mr-2" src="{{ getAvatarSrc(notification.userOrigin.avatar) }}" style="height:25px">      

          <span class="pull-right text-muted small time-line">
             {{ notification.getHumanCreatedAt()}} <span class="glyphicon glyphicon-time timestamp" data-toggle="tooltip" data-placement="bottom" title="Lundi 24 Avril 2014 à 18h25"></span>
          </span> 
          
          <a href="/@{{ notification.userOrigin.username }}">{{ notification.userOrigin.username }}</a> a yorum ekledi "<a href="#">{{ notification.post.title }}</a>"
          
        </li>
             
    {% endfor %}
    </ul>

{% endblock %}
