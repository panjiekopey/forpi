<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function index()
  {
    $crud = $this->generate_crud('alamat');
    $crud->set_subject('Registrasi');
    //$crud->set_relation('nip','karyawan','{id}-{first_name}');
    $crud->add_fields('Nama_Lengkap','Tempat_Lahir','Tanggal_Lahir','Nomor_Kartu_Identitas','Agama','Kewarganegaraan','Nama_Ibu_Kandung','Alamat','RT','RW','Kelurahan','Kecamatan','Kota','Kode_Pos','NoTelp','Fax','No_Hp','Email');
    //$crud->columns('nama','phone','email');
    //$crud->display_as('phone','Telepon / HP');
    //$crud->required_fields('nama','phone','email');
    //$crud->unique_fields('phone','email');
    //$crud->set_rules('nama','Nama','required');
    //$crud->set_rules('phone','Telepon / HP','required|integer');
    //$crud->set_rules('email','Email','required|valid_email');
    //$crud->set_lang_string('update_success_message','Your data has been successfully updated.<br/>Please wait while you are redirect to the list page.<script type="text/javascript">window.location="'.base_url().'/admin/'.(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'";</script><div style="display:none">');
    //$crud->callback_field('Tipe_Kartu_Identitas',array($this,'typeidcard_field_callback'));
    $crud->field_type('Tanggal_Lahir', 'date');
    $crud->unset_texteditor('Alamat');
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_read();
    $this->mPageTitle = 'Registrasi';
    $this->render_crud();
  }

  function typeidcard_field_callback(){
    return '
    <select name="Tipe_Kartu_Identitas">
        <option value="">Pilih Kartu Identitas</option>
        <option value="2">SIM</option>
        <option value="1">KTP</option>
    </select>';
  }

}
