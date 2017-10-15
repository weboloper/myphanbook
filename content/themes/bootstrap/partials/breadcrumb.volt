{% if this.router.getRewriteUri() != '/' %}
<div class="breadcrumbs">
    {% set title = post is defined ? post.title : action | capitalize %}
    <ol class="breadcrumb">
    	<div class="container">
      <li class="breadcrumb-item"><a href="/">{{ t('Home') }}</a></li>
      <li class="breadcrumb-item"><a href="/{{ t(controller | lower )}}">{{ t(controller | capitalize) }}</a></li>
      <li class="breadcrumb-item active">{{ t(title) }}</li>
      </div>
    </ol>
    
</div><!-- End breadcrumbs -->
{% endif %}

{% if this.router.getRewriteUri() == '/' %}

{% endif %}
