<ul class="nav nav-tabs mt-4">
    {%- set menu =
        [
            'Recent Questions': 'hot',
            'No Answers': 'unanswered',
            'Week': 'week',
            'Month': 'month',
            'Interesting': 'interesting'
        ]
    -%}
    {%- for value, key in menu -%}
        <li class="nav-item">
            {{ link_to('posts?tab=' ~ key, t(value), 'title': t(value), 'class': 'nav-link' ~ (tab == key ? ' active' : '') ) }}
        </li>
    {%- endfor -%}
</ul>
