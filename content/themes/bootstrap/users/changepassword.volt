<div class="col-12">
    <h3 class="main-title">
        {{ t('Change password') }}
    </h3>

    {{ form( this.view.getControllerName() | lower ~ '/changepassword', 'class' : 'form-horizontal') }}
    <div class="form-group">
        <label class="control-label" for="input-id-1">{{ t('Current password') }}:</label>
        
            {{ form.render('passwd') }}
    </div>
    <div class="form-group">
        <label class="control-label" for="input-id-1">{{ t('New password') }}:</label>
        
            {{ form.render('passwd_new') }}
    </div>
    <div class="form-group">
        <label class="control-label" for="input-id-1">{{ t('Confirm new password') }}:</label>
        
            {{ form.render('passwd_new_confirm') }}
    </div>

    <div class="form-group">
            {{ form.render('save') }}
    </div>
    {{ endform() }}
</div>
