{% if highestKarma is defined %}
<div class="widget widget_highest_points">
    <h3 class="widget_title">{{ t('Highest points') }}</h3>
    <ul>
    {% for userHighest in highestKarma %}
        <li>
            <div class="author-img">
                <a href="">
                <img width="60" height="60" src="{{getUrlAvatar(userHighest.email)}}" alt="">
                </a>
            </div>
            <h6><a href="/@{{userHighest.username}}">{{userHighest.getFullName() | capitalize }}</a></h6>
            <span class="comment">{{userHighest.getHumanKarma()}} {{ t('Points') }}</span>
        </li>
    {% endfor %}
    </ul>
</div>
{% endif %}

{% if tags is defined %}
<div class="widget widget_tag_cloud">
<h3 class="widget_title">{{ t('Tags') }}</h3>
{% for tagModel in tags %}
    {{ link_to('tags/' ~ tagModel.getId() ~ '/' ~ tagModel.getSlug(), tagModel.getName())}}
{% endfor %}
</div>
{% endif %}
 