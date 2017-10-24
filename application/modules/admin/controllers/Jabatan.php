<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function index()
  {
    $crud = $this->generate_crud('jabatan');
    $crud->set_subject('Jabatan');
    //$crud->set_relation('nip','karyawan','{id}-{first_name}');
    //$crud->add_fields('tanggal','nip','keterangan','jam_masuk','jam_keluar');
    //$crud->columns('nama','phone','email');
    //$crud->display_as('phone','Telepon / HP');
    //$crud->required_fields('nama','phone','email');
    //$crud->unique_fields('phone','email');
    //$crud->set_rules('nama','Nama','required');
    //$crud->set_rules('phone','Telepon / HP','required|integer');
    //$crud->set_rules('email','Email','required|valid_email');
    //$crud->set_lang_string('update_success_message','Your data has been successfully updated.<br/>Please wait while you are redirect to the list page.<script type="text/javascript">window.location="'.base_url().'/admin/'.(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'";</script><div style="display:none">');
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_read();
    $this->mTitle = 'Jabatan';
    $this->render_crud();
  }

}
