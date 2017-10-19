{% extends 'layouts/layout.volt' %}
{% block title %}{{ t('Sign Up') }}{% endblock %}
{% block content %}
    <div class="login-box-body">
        <p class="login-box-msg">{{ t('Sign in to start your session') }}</p>

        {{ form('oauth/register/signup') }}


            <div class="form-group has-feedback">
                {{ form.render('firstname', ['class' : 'form-control']) }}
             </div>

            <div class="form-group has-feedback">
                {{ form.render('lastname', ['class' : 'form-control']) }}
             </div>

            <div class="form-group has-feedback">
                {{ form.render('email', ['class' : 'form-control']) }}
             </div>

            <div class="form-group has-feedback">
                {{ form.render('username', ['class' : 'form-control']) }}
             </div>

             <div class="form-group has-feedback">
                {{ form.render('password', ['class' : 'form-control']) }}
             </div>

              <div class="form-group has-feedback">
                {{ form.render('passwordRepeat', ['class' : 'form-control']) }}
             </div>
             
             <div class="form-group">
              <div class="checkbox icheck">
                <label>
                    {{ form.render('terms') ~ '&nbsp;' ~ t('I agree to the %terms%', ['terms': link_to(['for': 'terms'], t('terms of service'))]) }}.
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="form-group">
                {{ form.render('submit', ['class' : 'btn btn-primary btn-block btn-flat']) }}
            </div>
                <!-- /.col -->
         {{ end_form() }}

        {{ partial('partials/social-login') }}

        {{ link_to(['for': 'signin'], t('I already have a membership'), 'class': 'text-center') }}
    </div>
{% endblock %}
