<div class="login-box">

	<div class="login-logo"><b><?php echo $site_name; ?></b></div>

	<div class="login-box-body">
		<p class="login-box-msg">Login untuk memulai session</p>
		<?php echo $form->open(); ?>
			<?php echo $form->messages(); ?>
			<!-- bs3_ field input bootstrap3 dari library form_builder @param = ('label','name&id','value','extras','span icon {only bs3_text}') -->
			<?php echo $form->bs3_text('', 'username',/*ENVIRONMENT==='development' ? 'webmaster' : */'',array('placeholder'=>'Username'),'glyphicon-user'); ?>
			<?php echo $form->bs3_password('', 'password',/*ENVIRONMENT==='development' ? 'webmaster' : */'',array('placeholder'=>'Password')); ?>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox">
						<label><input type="checkbox" name="remember"> Remember Me</label>
					</div>
				</div>
				<div class="col-xs-4">
					<?php echo $form->bs3_submit('Login', 'btn btn-primary btn-block btn-flat'); ?>
				</div>
			</div>
		<?php echo $form->close(); ?>
	</div>

</div>
