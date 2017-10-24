<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <!-- <h2 class="text-center">CONTACT</h2> -->
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> SCBD, Jakarta</p>
      <p><span class="glyphicon glyphicon-phone"></span> +62 217865998</p>
      <p><span class="glyphicon glyphicon-envelope"></span> darmafoor.idn@gmail.com</p>
    </div>
    <div class="col-sm-7 slideanim">
    <?php echo $form->open(); ?>
    <?php echo $form->messages(); ?>
      <div class="row">
        <div class="col-sm-6 form-group">
        <?php echo $form->bs3_text('', 'name','',array('placeholder'=>'Name')); ?>
          <!-- <input class="form-control" id="name" name="name" placeholder="Name" type="text" > -->
        </div>
        <div class="col-sm-6 form-group">
        <?php echo $form->bs3_email('', 'email','',array('placeholder'=>'name@email.com')); ?>
          <!-- <input class="form-control" id="email" name="email" placeholder="Email" type="email" > -->
        </div>
      </div>
      <?php echo $form->bs3_textarea('', 'comments','',array('placeholder'=>'Type message here','row'=>'5')); ?>
      <!-- <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br> -->
      <div class="row">
        <div class="col-sm-12 form-group">
          <!-- <button class="btn btn-default pull-right" type="submit">Send</button> -->
                <?php echo $form->bs3_submit('Send'); ?>
        </div>
      </div>
        <?php echo $form->close(); ?>
    </div>
  </div>
</div>
