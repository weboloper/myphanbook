{% if this.router.getRewriteUri() != '/' %}
<div class="breadcrumbs">
    {% set title = post is defined ? post.title : action | capitalize %}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">{{ t('Home') }}</a></li>
      <li class="breadcrumb-item"><a href="#">{{ t(controller | capitalize) }}</a></li>
      <li class="breadcrumb-item active">{{ t(title) }}</li>
    </ol>
    
</div><!-- End breadcrumbs -->
{% endif %}

{% if this.router.getRewriteUri() == '/' %}

{% endif %}
