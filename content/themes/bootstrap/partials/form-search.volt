{%- set defaultValue = t('Search here...') -%}
<form method="get" action="/search" class="form-inline mr-auto">
    <input type="text" value="{{ defaultValue }}" data-hint="{{ defaultValue }}" name="q"  class="form-control">
</form>
