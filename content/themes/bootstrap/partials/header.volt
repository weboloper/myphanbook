{% if is_authorized() %}
<div class="setting-panel" style="display:none">
        <section class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-content">
                        <h2>{{ t('Settings') }}</h2>
                        <div class="form-style form-style-3">
                            <ul>
                                <li><a href="/users/setting">{{ t('Edit Setting') }}</a></li>
                                <li><a href="">{{ t('My Questions') }}</a></li>
                                <li><a href="">{{ t('My Answers') }}</a></li>
                                <li><a href="/users/profile">{{ t('Edit Profile') }}</a></li>
                                <li><a href="/users/changepassword">{{ t('Change Password') }}</a></li>

                            </ul>
                        </div>
                    </div><!-- End page-content -->
                </div><!-- End col-md-6 -->
                <div class="col-md-6">
                    <div class="page-content Register">
                        <h2>{{ t('Dashboard') }}</h2>
                        <div class="form-style form-style-3">
                            <ul>
                                <li><a href="/backend/dashboard">{{ t('Dashboard') }}</a></li>
                                <li><a href="/backend/themes/custom">{{ t('Edit Theme') }}</a></li>
                                <li><a href="/users/profile">{{ t('Edit Profile') }}</a></li>
                                <li>{{ link_to(['for': 'logout'], t('Logout')) }}</li>
                            </ul>
                        </div>
                    </div><!-- End page-content -->
                </div><!-- End col-md-6 -->
            </div>
        </section>
</div><!-- End login-panel -->
{% endif %}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav mr-auto">
            {%- set menu =
                [
                    'Questions': 'questions',
                    'Hot': 'hot',
                    'My Questions': 'my',
                    'My Answers': 'answers'
                ]
            -%}

            {%- for value, key in menu -%}
                {%- if (key == 'my' or key == 'answers') and not is_authorized() -%}
                    {% continue %}
                {%- endif -%}

                <li class="nav-item">
                    {{ link_to('questions?tab=' ~ key, t(value), 'title': t(value), 'class': 'nav-link' ~ ( key == tab ? ' active' : '' ) ) }}
                </li>
            {%- endfor -%}

            <li class="nav-item {{ key == 'new' ? 'current_page_item' : '' }}">
                {{ link_to('posts/new', t('Ask Question'), 'class': 'nav-link' ~ ( key == tab ? ' active' : '' ) ) }}
            </li>

            {%- set menu =
                [
                    'Users': 'users',
                    'Tags': 'tags',
                    'Badges': 'badges'
                ]
            -%}

            {%- for value, key in menu -%}
                <li class="nav-item {{ key == tab ? 'current_page_item' : '' }}">
                    {{ link_to(key, t(value),'title': t(value), 'class': 'nav-link' ~ ( key == tab ? ' active' : '' ) ) }}
                </li>
            {%- endfor -%}
        </ul>

      <ul class="navbar-nav my-2 my-md-0">
         {% if is_authorized() %}
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-plus"></i>{{ t('Settings') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/notifications">
                    {%- if notifications.has() -%}
                        <span class="mail-status unread"></span>
                    {%- endif -%}
                    <i class="fa fa-inbox"></i>
                </a>
            </li>
        {% else %}
            <li class="nav-item">{{ link_to(['for': 'signup'], '<i class="fa fa-user"></i>' ~ t('Sign Up') , 'class': 'nav-link') }}</li>
            <li class="nav-item">{{ link_to(['for': 'signin'], '<i class="fa fa-user"></i>' ~ t('Log In'), 'class': 'nav-link') }}</a></li>
        {% endif %}
      </ul>


 
    </div>
  </div>
</nav>