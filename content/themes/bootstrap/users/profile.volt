<div class="col-md-9">
    <div class="page-content">
        <div class="boxedtitle page-title">
            <h2 class="text-normal">{{ t('Edit Profile') }}</h2>
        </div>
        <hr>
        <div class="form-style form-style-4">
        
             <div class="form-group row">

              {{ form('users/avatarUpload', 'method' : 'post',  'class':'dropzone  col-2', 'id':'avatarUpload' , 'enctype': 'multipart/form-data' ) }}
                    <div class="dz-message">
                        <div class="user-profile-img">
                            <img src="{{ getAvatarSrc(object.avatar) }}" class="profile-avatar img-fluid img-thumbnail"/>
                        </div>
                        <span></span>
                    </div>
               
                {{end_form()}}


              <div class="col-10">
                {{ form.render('username', ['class': 'form-control' , 'disabled' : 'disabled']) }}
              </div>
            </div>

            <hr>
            {{ form( '/users/profile', 'enctype': 'multipart/form-data') }}
            {%- if object is defined -%}
                {{ form.render('id') }}
            {%- endif -%}
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">{{ t('First Name') }}</label>
              <div class="col-10">
                {{ form.render('firstname', ['class': 'form-control']) }}
              </div>
            </div>

            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">{{ t('Last Name') }}</label>
              <div class="col-10">
                {{ form.render('lastname', ['class': 'form-control']) }}
              </div>
            </div>

            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">{{ t('E-mail') }}</label>
              <div class="col-10">
                {{ form.render('email', ['class': 'form-control']) }}
              </div>
            </div>

            

            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">{{ t('Birthday') }}</label>
              <div class="col-10">
                {{ form.render('birthDate', ['class': 'form-control']) }}
              </div>
            </div>

            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">{{ t('About Yourself') }}</label>
              <div class="col-10">
                {{ form.render('bio', ['class': 'form-control']) }}
              </div>
            </div>

            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">{{ t('Twitter') }}</label>
              <div class="col-10">
                {{ form.render('twitter', ['class': 'form-control']) }}
              </div>
            </div>

            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label">{{ t('Github') }}</label>
              <div class="col-10">
                {{ form.render('github', ['class': 'form-control']) }}
              </div>
            </div>


 
            

            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label"></label>
              <div class="col-10">
                 <input type="submit" value="{{ t('Update') }}" class="btn btn-primary">
              </div>
            </div>
 
   
            </form>
        </div>
    </div><!-- End page-content -->
</div><!-- End main -->
<aside class="col-md-3 sidebar">
    {{ partial('partials/right-side') }}
</aside>
