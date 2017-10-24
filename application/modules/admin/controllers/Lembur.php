<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembur extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function index()
  {
    try{
    $ds = date('Y-m-d');
    $tgl_wm = "DATE_FORMAT(waktu_masuk,'%Y-%m-%d')";

    $crud = $this->generate_crud('data_lembur');
    $crud->set_subject('Lembur');
    $crud->add_fields('id_absensi','waktu_mulai','waktu_selesai','upah_lembur','keterangan');
    if($crud->getState()=='add' || $crud->getState()=='insert' || $crud->getState()=='insert_validation'){
    $crud->set_primary_key('id','vabsensi');
    $crud->set_relation('id_absensi','vabsensi','{tanggal} (ID = {id})', array('keterangan' => 'Hadir', 'tanggal' => $ds ));
    }elseif($crud->getState()=='edit' || $crud->getState()=='update' || $crud->getState()=='update_validation'){
      $crud->set_primary_key('id','vabsensi');
      $crud->set_relation('id_absensi','vabsensi','{tanggal} - NIP : {nip}');
    }elseif($crud->getState()=='success' || $crud->getState()=='list'){
    echo "<script type='text/javascript'>javascript:history.go(-2 );</script>";
    }
    $crud->callback_column('id_absensi',array($this,'_callback_tak_url'));
    $crud->display_as('id_absensi','ID Absensi');
    //$crud->add_fields('nip','keterangan','waktu_masuk');
    //$crud->columns('nama','phone','email');
    $crud->display_as('id_absensi','Pilih Absensi');
    //$crud->required_fields('nama','phone','email');
    //$crud->unique_fields('phone','email');
    //$crud->set_rules('nama','Nama','required');
    //$crud->set_rules('phone','Telepon / HP','required|integer');
    //$crud->set_rules('email','Email','required|valid_email');
    //$crud->set_lang_string('update_success_message','Your data has been successfully updated.<br/>Please wait while you are redirect to the list page.<script type="text/javascript">window.location="'.base_url().'/admin/'.(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'";</script><div style="display:none">');
    //$crud->where('keterangan','Hadir');
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_read();
    $this->mTitle = 'Lembur';
    $this->render_crud();
      }catch(Exception $e){
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }
  public function view(){
        //$tgl_wm = "DATE_FORMAT(waktu_masuk,'%Y-%m-%d')";

    $crud = $this->generate_crud('vlembur');
    if($crud->getState()=='delete'){$crud = $this->generate_crud('data_lembur');}
    elseif($crud->getState()=='add'){redirect('admin/lembur/index/add');}
    $crud->set_primary_key('id');
    $crud->set_subject('Lembur');
    $crud->columns('tanggal','nip','jam_selesai');
    $crud->set_relation('nip','karyawan','first_name');
    $crud->callback_column('tanggal',array($this,'_callback_tak_url'));
    $crud->add_action('Ubah Lembur', '', 'admin/lembur/index/edit', 'edit-icon');
    $crud->order_by('tanggal','desc');
    $crud->display_as('nip','Karyawan')
         ->display_as('tanggal','Tanggal Absensi')
         ->display_as('upah_lembur','Upah/Jam')
         ->display_as('totalUph','Total Upah')
         ;
    $crud->unset_edit();
    //$crud->unset_print();
    //$crud->unset_delete();
    //$crud->unset_export();
    //$crud->unset_read();
    $this->unset_crud_fields('id_absensi');
    $this->unset_crud_fields('id');
    $this->mPageTitle = 'Data Lembur';
    $this->render_crud();
  }

    public function absensilembur($id_absensi)
  {
    try{
      echo $id_absensi;
    $ds = date('Y-m-d');
    $tgl_wm = "DATE_FORMAT(waktu_masuk,'%Y-%m-%d')";

    $crud = $this->generate_crud('data_lembur');
    $crud->set_subject('Lembur');
    $crud->add_fields('id_absensi','waktu_mulai','waktu_selesai','upah_lembur','keterangan');
    if($crud->getState()=='add' || $crud->getState()=='insert' || $crud->getState()=='insert_validation'){
    $crud->set_primary_key('id','vabsensi');
    $crud->set_relation('id_absensi','vabsensi','{tanggal} (NIP = {nip})', array('keterangan' => 'Hadir', 'tanggal' => $ds ));
     $crud->field_type('id_absensi', 'hidden', $id_absensi);
    }elseif($crud->getState()=='edit' || $crud->getState()=='update' || $crud->getState()=='update_validation'){
      $crud->set_primary_key('id','vabsensi');
      $crud->set_relation('id_absensi','vabsensi','{tanggal} - NIP : {nip}');
    }elseif($crud->getState()=='success' || $crud->getState()=='list'){
    echo "<script type='text/javascript'>javascript:history.go(-2 );</script>";
    }
    $crud->callback_column('id_absensi',array($this,'_callback_tak_url'));
    $crud->display_as('id_absensi','ID Absensi');
    //$crud->add_fields('nip','keterangan','waktu_masuk');
    //$crud->columns('nama','phone','email');
    $crud->display_as('id_absensi','Pilih Absensi');
    //$crud->required_fields('nama','phone','email');
    //$crud->unique_fields('phone','email');
    //$crud->set_rules('nama','Nama','required');
    //$crud->set_rules('phone','Telepon / HP','required|integer');
    //$crud->set_rules('email','Email','required|valid_email');
    //$crud->set_lang_string('update_success_message','Your data has been successfully updated.<br/>Please wait while you are redirect to the list page.<script type="text/javascript">window.location="'.base_url().'/admin/'.(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'";</script><div style="display:none">');
    //$crud->where('keterangan','Hadir');
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_read();
    $this->mTitle = 'Lembur';
    $this->render_crud();
      }catch(Exception $e){
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }

    public function _callback_tak_url($value, $row)
  {
    return "<a style='color:#000;text-decoration:none;' href='".site_url('admin/absensi/view/read/'.$row->id_absensi)."' title='".$value."'>".$value."</a>";
  }



}
