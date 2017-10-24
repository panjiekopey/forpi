<!-- Widget: user widget style 1 -->
<div class="box box-widget widget-user-2">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class='widget-user-header bg-<?php echo $color; ?>'>
    <div class="widget-user-image">
      <img class="img-circle" src='<?php echo UPLOAD_FOTO_KARYAWAN.'/'.$image; ?>' alt="User Avatar">
    </div><!-- /.widget-user-image -->
    <h3 class="widget-user-username"><?php echo $label; ?></h3>
    <h5 class="widget-user-desc"><?php echo $groups; ?></h5>
  </div>
  <div class="box-body">
    <dl class="dl-horizontal">
    <dt>Alamat</dt><dd><?php echo $dataK->alamat;?></dd>
    <dt>Tempat/Tanggal Lahir</dt><dd><?php echo $dataK->tempat_lahir.' / '.$dataK->tgl_lahir;?></dd>
    <dt>Usia</dt><dd><?php echo $dataK->usia.' Tahun';?></dd>
    <!-- <dd>Donec id elit non mi porta gravida at eget metus.</dd> -->
    <dt>Jenis Kelamin</dt><dd><?php echo $dataK->jenis_kelamin;?></dd>
    <dt>Agama</dt><dd><?php echo $dataK->agama;?></dd>
  </dl>
  </div><!-- /.box-body -->
  <div class="box-footer no-padding">
    <ul class="nav nav-stacked">
      <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
      <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
      <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
      <!-- <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li> -->
    </ul>
  </div>
</div><!-- /.widget-user -->
