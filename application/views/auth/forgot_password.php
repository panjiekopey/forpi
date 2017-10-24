<?php echo $form->open(); ?>
  <?php echo $form->messages(); ?>
  <?php echo $form->bs3_email('', 'email',/*ENVIRONMENT==='development' ? 'webmaster' : */'',array('placeholder'=>'Email'),'');?>
<?php echo $form->bs3_submit('Submit', 'btn btn-primary btn-block btn-flat'); ?>
<?php echo $form->close(); ?>
