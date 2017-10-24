<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

  public function index()
  {
    //$this->load->model('user_model', 'users');
    $this->load->model('pemesanan_model', 'pemesanans');
    $this->load->model('karyawan_model', 'karyawans');
    $this->load->model('pelanggan_model', 'pelanggans');
    $this->mViewData['count'] = array(
      //'users' => $this->users->count_all(),
      'pelanggan' => $this->pelanggans->count_all(),
      'pemesanan' => $this->pemesanans->count_by(array('status'=>'proses')),
      'karyawan' => $this->karyawans->count_by(array('active'=>1)),
      'karyawannoactive' => $this->karyawans->count_by(array('active'=>0)),
      'karyawan_t' => $this->karyawans->count_by(array('status_pegawai'=>'Tetap')),
      'karyawan_k' => $this->karyawans->count_by(array('status_pegawai'=>'Kontrak')),
    );
    $this->render('home');
  }
}
