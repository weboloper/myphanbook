{% for post in posts %}
    {{ partial('partials/item-posts', ['listPost': true, 'post' : post])}}
{% endfor %}
