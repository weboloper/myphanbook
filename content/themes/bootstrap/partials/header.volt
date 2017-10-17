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
                <a class="nav-link" href="/notifications">
                    {%- if notifications.has() -%}
                         <span class="badge badge-pill badge-success">&nbsp</span> 
                    {%- endif -%}
                    <i class="fa fa-inbox"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                 {{auth['username']}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                  <a class="dropdown-item" href="/users/profile">{{ t('Edit Profile') }}</a>
                  <a class="dropdown-item" href="/users/changepassword">{{ t('Change Password') }}</a>
                  <a class="dropdown-item" href="/users/setting">{{ t('Edit Setting') }}</a>
                  <div class="dropdown-divider"></div>
                  {{ link_to(['for': 'logout'], t('Logout') , 'class' : 'dropdown-item') }}
                </div>
            </li>
        {% else %}
            <li class="nav-item">{{ link_to(['for': 'signup'], '<i class="fa fa-user"></i>' ~ t('Sign Up') , 'class': 'nav-link') }}</li>
            <li class="nav-item">{{ link_to(['for': 'signin'], '<i class="fa fa-user"></i>' ~ t('Log In'), 'class': 'nav-link') }}</a></li>
        {% endif %}
      </ul>


 
    </div>
  </div>
</nav>