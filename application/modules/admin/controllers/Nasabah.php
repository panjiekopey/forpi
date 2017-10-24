<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nasabah extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function index()
  {
    $crud = $this->generate_crud('nasabah');
    $crud->set_subject('Nasabah');
    $crud->columns('Nama_Lengkap','Nomor_KTP','Alamat', 'No_Hp');
    //$crud->set_lang_string('update_success_message','Your data has been successfully updated.<br/>Please wait while you are redirect to the list page.<script type="text/javascript">window.location="'.base_url().'/admin/'.(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'";</script><div style="display:none">');
    $crud->required_fields(
        'Nama_Lengkap',
        'Tempat_Lahir',
        'Tanggal_Lahir',
        'Jenis_Kelamin',
        'Agama',
        'Kewarganegaraan',
        'Status_Perkawinan',
        'Nomor_KTP',
        'Alamat',
        'RT',
        'RW',
        'Kecamatan',
        'Kelurahan',
        'Kota',
        'Kode_Pos',
        'Nama_Ibu_Kandung'
        );
    $crud->unique_fields('Nomor_KTP','No_Hp','Email','No_Telp');
    $crud->set_rules('No_Hp','No_Hp','required|integer');
    $crud->set_rules('No_Telp','No_Telp','required|integer');
    $crud->set_rules('Email','Email','required|valid_email');
    $crud->unset_texteditor('Alamat');
    //$crud->callback_field('Tipe_Kartu_Identitas',array($this,'typeidcard_field_callback'));
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    //$crud->unset_read();
    $this->mPageTitle = 'Nasabah';
    $this->render_crud();
  }

  function typeidcard_field_callback(){
    return '
    <select name="Tipe_Kartu_Identitas">
        <option value="">Tipe ID Card</option>
        <option value="2">SIM</option>
        <option value="1">KTP</option>
    </select>';
  }

}
