<!-- <h3>Welcome <?php //echo $user->first_name.' '.$user->last_name;?> !</h3> -->
<!-- <a href="auth/logout" class="btn btn-primary">Logout</a> -->
<a href="account/setting" class="btn btn-primary">Settings</a>
<div class="col-md-5">
<?php echo modules::run('adminlte/widget/user_widget', 'red', '', $user->first_name.''.$user->last_name, $dataK->nama_jabatan, 'karyawan/'); ?>
</div>
<!-- <div class="col-md-5">
<?php //echo modules::run('adminlte/widget/info_box', 'green', 'karyawan', 'Karyawan yang Aktif', 'fa fa-group', 'karyawan/'); ?>
</div> -->
