<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function editc()
  {
    try{
    $crud = $this->generate_crud('config');
    //$crud->columns('nip','keterangan','waktu_masuk','waktu_keluar','denda');
    //$crud->set_relation('nip','karyawan','{nip}-{first_name}');
    //$crud->required_fields('nip','keterangan');
    //$crud->edit_fields('nip','keterangan','waktu_masuk','waktu_keluar');
    //$crud->set_rules('nama','Nama','required');
    //$crud->set_rules('phone','Telepon / HP','required|integer');
    //$crud->set_rules('email','Email','required|valid_email');
    // $crud->display_as('nip','Karyawan')
    //      ->display_as('keterangan','Kehadiran')
    //      ->display_as('denda','Denda/Jam');
    // if($crud->getState()=='add'){
    // $crud->set_relation('nip','karyawan','{nip}-{first_name}', array('active',1));
    // $crud->field_type('waktu_keluar', 'hidden', date("Y-m-d",now()));
    // //$crud->field_type('kode_pesanan', 'hidden', $this->pemesanans->create_pkode());
    // }elseif($crud->getState()=='success' || $crud->getState()=='list'){
    // echo "<script type='text/javascript'>javascript:history.go(-2 );</script>";
    // }
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_list();
    $this->unset_crud_fields('id');
    //$crud->unset_read();
    $this->mPageTitle = 'Setting';
    $this->render_crud();
    } catch(Exception $e){
      if ($e->getCode()==14){redirect($this->mModule.'/','refresh');}
      else{show_error($e->getMessage());}
    }
  }
}
