{% if this.router.getRewriteUri() != '/' %}
<div class="breadcrumbs">
    <section class="container">
        {% set title = post is defined ? post.title : action | capitalize %}
        <div class="row">
            <div class="col-md-12">
                <h1>{{ title }}</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="#">{{ t('Home') }}</a>
                    <span class="crumbs-span">/</span>
                    <a href="#">{{ t(controller | capitalize) }}</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">{{ t(title) }}</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->
{% endif %}

{% if this.router.getRewriteUri() == '/' %}

{% endif %}
