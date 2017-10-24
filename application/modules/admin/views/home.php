<div class="row">
	<!--<div class="col-md-4">
    <?php //echo modules::run('adminlte/widget/small_box', 'yellow', $count['pelanggan'], 'Pelanggan', 'fa fa-group', 'pelanggan/'); ?>
	</div>
  <div class="col-md-4">
    <?php //echo modules::run('adminlte/widget/small_box', 'green', $count['pemesanan'], 'Pesanan belum Selesai', 'fa fa-tasks', 'pemesanan/view'); ?>
  </div>-->
  <div class="col-md-5">
    <?php echo modules::run('adminlte/widget/small_box', 'green', $count['karyawan'], 'Karyawan yang Aktif', 'fa fa-group', 'karyawan/'); ?>
  </div>
  <div class="col-md-5">
		<?php echo modules::run('adminlte/widget/small_box', 'red', $count['karyawannoactive'], 'Karyawan yang Tidak Aktif', 'fa fa-group', 'karyawan/'); ?>
	</div>
</div>
<div class="row">
    <div class="col-md-4">
    <?php echo modules::run('adminlte/widget/info_box', 'yellow', $count['karyawan_t'], 'Pegawai Tetap', 'fa fa-group', 'karyawan/'); ?>
  </div>
    <div class="col-md-4">
    <?php echo modules::run('adminlte/widget/info_box', 'blue', $count['karyawan_k'], 'Pegawai Kontrak', 'fa fa-group', 'karyawan/'); ?>
  </div>
</div>
<div class="row">
