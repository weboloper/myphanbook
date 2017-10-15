{% if paginator is defined %}
    {% set totalPages = paginator.total_pages, currentPage = paginator.current %}
{% endif %}
{% if totalPages > 1 %}
    {% set startIndex = 1, paginatorUri = this.router.getRewriteUri() == '/' ? 'posts' : this.router.getRewriteUri() %} <!-- start index 1..5 -->
    {% if totalPages > 5 %}
        {% if currentPage > 3 %}
            {% set startIndex = startIndex + currentPage - 3 %}
        {% endif %}
        {% if totalPages - currentPage < 5 %}
            {% set startIndex = totalPages - 4 %}
        {% endif %}
    {% endif %}
    <nav aria-label="Page navigation">
        <ul class="pagination">
        {% if currentPage > 1 %}
            {% set prev = currentPage - 1 %}
             <li class="page-item">
            <a href="{{ paginatorUri ~ '?page=' ~ prev }}" class="page-link">
                <i class="fa fa-angle-left"></i>
            </a>
            </li>
        {% endif %}
        {% for pageIndex in startIndex..totalPages %}
            {% if pageIndex is startIndex + 5 %}
                {% break %}
            {% endif %}
            {% if pageIndex is currentPage %}
                <li class="page-item active">
                <span class="page-link"> {{ currentPage }}</span>
                </li>
            {% else %}
                <li class="page-item">
                <a href="{{paginatorUri ~ '?page=' ~ pageIndex }}" class="page-link">
                    {{ pageIndex }}
                </a>
                </li>
            {% endif %}

        {% endfor %}
        {% if currentPage < totalPages %}
            {% set next = currentPage + 1 %}
             <li class="page-item">
            <span class="page-link">...</span>
            </li>
             <li class="page-item">
            <a href="{{ paginatorUri ~ '?page=' ~ totalPages }}" class="page-link">
                {{ totalPages}}
            </a>
            </li>
             <li class="page-item">
            <a href="{{ paginatorUri ~ '?page=' ~ next }}"class="page-link">
                <i class="fa fa-angle-right"></i>
            </a>
            </li>
        {% endif %}
        </ul>
    </nav>
{% endif %}
