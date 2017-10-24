
<div class="well col-md-6">
    <?php echo $form->open(); ?>
      <?php echo $form->messages(); ?>
		<?php echo $form->bs3_password('', 'password','',array('placeholder'=>'New Password'));?>
		<?php echo $form->bs3_password('', 'retype_password','',array('placeholder'=>'Retype Password'));?>
		<hr/>
    <?php echo $form->bs3_submit('Confirm', 'btn btn-primary btn-block btn-flat'); ?>
    <?php echo $form->close(); ?>
</div>
