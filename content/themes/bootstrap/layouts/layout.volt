{{ get_doctype() }}
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <!-- Add meta tags to refactor-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="{{name}}, Phanbook, Phalcon,QA">
    <meta name="author" content="Phanbook Team">
    <meta property="og:title" content="{{ name }}">
    <meta property="og:type"  content="website">
    <meta property="og:image" content=" {{ name }}">
    <meta property="og:url" content="{{publicUrl}}">
    <link rel="shortcut icon" href="{{ getImageSrc('favicon.png') }}">
    <title>{% block title%}{% endblock %} - {{name}}</title>
   
    <!-- Main Style -->
    {{ assets.outputCss('theme_css') }}
    {{ assets.outputInlineCss() }}

    <!-- Responsive Style -->
    {{ stylesheet_link('/core/assets/css/font-awesome.min.css?v=2') }}
    {{ stylesheet_link('/core/assets/css/dropzone.css?v=2') }}


    {{ this.assets.outputCss() }}
    <script type="text/javascript">
        var baseUri     = '{{ baseUri }}';
        var controller  = '{{ controller }}';
        var action      = '{{ action }}';
        var googleAnalytic = '{{ googleAnalytic }}';
    </script>
</head>
<body class="{{action}} {{controller}}">

{{ partial('partials/header')}}

{{ partial('partials/breadcrumb')}}
<section class="container main-content">
    {{ this.flashSession.output() }}
    {% block content %}{% endblock %}
</section><!-- End container -->

{{ partial('partials/footer')}}

<!-- js -->
<script
  src="http://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../core/assets/js/jquery-3.2.1.min.js"><\/script>')</script>

{{ javascript_include('core/assets/js/jquery-ui.min.js')}}
{{ javascript_include('core/assets/js/popper.min.js')}}
{{ javascript_include('core/assets/js/bootstrap.min.js')}}
{{ javascript_include('core/assets/js/bootstrap-notify.js')}}
{{ javascript_include('/core/assets/js/dropzone.js')}}
{{ javascript_include('core/assets/js/app.function.js')}}
{{ javascript_include('core/assets/js/app.ajax.js')}}
{{ javascript_include('core/assets/js/app.js')}}

{{ assets.outputJs('theme_js') }}
{{ assets.outputJs() }}
{{ assets.outputInlineJs() }}

{% block scripts%} {% endblock %}
<!-- End js -->
</body>
</html>
