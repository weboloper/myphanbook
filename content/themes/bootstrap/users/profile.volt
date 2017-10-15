<div class="col-md-9">
    <div class="page-content">
        <div class="boxedtitle page-title">
            <h2 class="text-normal">{{ t('Edit Profile') }}</h2>
        </div>
        <hr>
        <div class="row">
        
 
            {{ form('users/avatarUpload', 'method' : 'post',  'class':'dropzone  col-md-2 col-sm-12', 'id':'avatarUpload' , 'enctype': 'multipart/form-data' ) }}
                <div class="dz-message">
                    <div class="user-profile-img">
                        <img src="{{ getAvatarSrc(object.avatar) }}" class="profile-avatar img-fluid img-thumbnail"/>
                    </div>
                    <span>Click on photo to change</span>
                </div>
           
            {{end_form()}}

                        
            {{ form( '/users/profile', 'enctype': 'multipart/form-data' , 'class': 'col-lg-8 col-md-10 col-sm-12') }}
            {%- if object is defined -%}
                {{ form.render('id') }}
            {%- endif -%}

            <div class="form-group">
                <label for="example-text-input" class="col-form-label">{{ t('Username') }}</label>
                {{ form.render('username', ['class': 'form-control' , 'disabled' : 'disabled']) }}
            </div>
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">{{ t('First Name') }}</label>
                {{ form.render('firstname', ['class': 'form-control']) }}
            </div>

            <div class="form-group">
              <label for="example-text-input" class="col-form-label">{{ t('Last Name') }}</label>
                {{ form.render('lastname', ['class': 'form-control']) }}
            </div>

            <div class="form-group">
              <label for="example-text-input" class="col-form-label">{{ t('E-mail') }}</label>
                {{ form.render('email', ['class': 'form-control']) }}
            </div>

            <div class="form-group">
              <label for="example-text-input" class="col-form-label">{{ t('Birthday') }}</label>
                {{ form.render('birthDate', ['class': 'form-control']) }}
            </div>

            <div class="form-group">
              <label for="example-text-input" class="col-form-label">{{ t('About Yourself') }}</label>
            </div>

            <div class="form-group">
              <label for="example-text-input" class="col-form-label">{{ t('Twitter') }}</label>
                {{ form.render('twitter', ['class': 'form-control']) }}
            </div>

            <div class="form-group">
              <label for="example-text-input" class="col-form-label">{{ t('Github') }}</label>
                {{ form.render('github', ['class': 'form-control']) }}
            </div>


 
            <div class="form-group">
                 <input type="submit" value="{{ t('Update') }}" class="btn btn-primary">
            </div>
 
   
            </form>
        </div>
    </div><!-- End page-content -->
</div><!-- End main -->
<aside class="col-md-3 sidebar">
    {{ partial('partials/right-side') }}
</aside>
