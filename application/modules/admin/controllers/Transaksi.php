<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function index()
  {
    $crud = $this->generate_crud('VD_Transaksi');
    $crud->set_primary_key('ID_Transaksi');
    $crud->set_subject('Rekening');
    //$crud->set_relation('ID_Nasabah','nasabah','Nama_Lengkap');
    //$crud->set_relation('Jenis_Tabungan','jenis_tabungan','Jenis_Tabungan');
    //$crud->columns('No_Rekening','ID_Nasabah','Saldo','Jenis_Tabungan','Tanggal_Buka');
    //$crud->display_as('ID_Nasabah','Nasabah');
    //$crud->add_fields('Nama_Lengkap','Tempat_Lahir','Tanggal_Lahir','Nomor_Kartu_Identitas','Agama','Kewarganegaraan','Nama_Ibu_Kandung','Alamat','RT','RW','Kelurahan','Kecamatan','Kota','Kode_Pos','NoTelp','Fax','No_Hp','Email');
    //$crud->columns('nama','phone','email');
    //$crud->display_as('phone','Telepon / HP');

    //$crud->set_rules('nama','Nama','required');

    //$crud->set_lang_string('update_success_message','Your data has been successfully updated.<br/>Please wait while you are redirect to the list page.<script type="text/javascript">window.location="'.base_url().'/admin/'.(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'";</script><div style="display:none">');
    //$crud->callback_field('Tipe_Kartu_Identitas',array($this,'typeidcard_field_callback'));
    //$crud->field_type('Tanggal_Lahir', 'date');
    //$crud->unset_texteditor('Alamat');
    //$crud->add_action('Detail Transaksi', '', 'admin/rekening/transaksi', 'fa fa-money');
    $this->unset_crud_fields('ID_Transaksi');
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_read();
    $this->mPageTitle = 'Rekening';
    $this->render_crud();
  }
}
