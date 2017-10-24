    <?php echo $form->open(); ?>
      <?php echo $form->messages(); ?>
      <?php
      /**
       * bs3_ field input bootstrap3 dari library form_builder
      @param = ('label','name&id','value','extras','span icon {only bs3_text}')
       */
      echo $form->bs3_text('', 'email',/*ENVIRONMENT==='development' ? 'webmaster' : */'',array('placeholder'=>'Email'),'');
      echo $form->bs3_password('', 'password',/*ENVIRONMENT==='development' ? 'webmaster' : */'',array('placeholder'=>'Password')); ?>
          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember Me</label>
          </div>
          <!-- <div class="form-group">
            Don't have Account <a href="auth/sign_up">Sign Up</a>
          </div> -->
          <div class="form-group">
            <a href="auth/forgot_password">Forgot password</a>
          </div>
          <?php echo $form->bs3_submit('Login', 'btn btn-primary btn-block btn-flat'); ?>
    <?php echo $form->close(); ?>
