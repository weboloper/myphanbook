{% extends 'layouts/layout.volt' %}
{% block title %}{{ page is defined ? page.getTitle() : 'Phanbook'}}{% endblock %}
{% block content %}
     <ul class="list-unstyled">
  
     {% for notification in notifications %}
        <li class="media">
    <img class="d-flex mr-3" src="{{ getAvatarSrc(notification.userOrigin.avatar) }}" alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0 mb-1">{{ notification.userOrigin.username }}</h5>
       
    </div>
  </li>
    {% endfor %}
    </ul>

{% endblock %}
