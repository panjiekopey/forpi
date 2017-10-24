<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
    $this->load->model('gaji_model','m_gaji');
  }

    public function index()
  {
    $ginfo = $this->m_gaji->get_by(array('id'=>1));
    //echo $ginfo->uangMakan;
    $crud = $this->generate_crud('daftar_gaji');
    $crud->set_subject('Gaji');
    $crud->columns('tanggal','nip','gaji_kotor','potongan','total_upah');
    $crud->set_relation('nip','karyawan','{nip} - {first_name}');
    $crud->set_relation('id_jabatan','jabatan','nama_jabatan');
    $crud->add_fields('tanggal','nip','uang_lembur','uang_makan','tunj_kecelakaan','tunj_kesehatan','tunj_kematian','uang_transport','tunj_hari_raya','tunj_hari_tua','id_jabatan','tunj_anak','gaji_kotor','total_upah','potongan','bonus');
    //$crud->add_fields('tanggal','nip','id_jabatan','uang_makan','uang_transport','tunj_istri','tunj_anak','tunj_hari_tua','tunj_kecelakaan','tunj_kesehatan','tunj_kematian','tunj_hari_raya','bonus','','');
    $crud->callback_before_insert(array($this,'hitung_gaji'));
    if($crud->getState()=='add'){
    $crud->field_type('tanggal', 'hidden', date("Y-m-d",now()));
    $crud->field_type('uang_makan', 'hidden', $ginfo->uangMakan);
    $crud->field_type('uang_transport', 'hidden', $ginfo->uangTransport);
    $crud->field_type('tunj_hari_tua', 'hidden', $ginfo->tunjHariTua);
    $crud->field_type('tunj_kecelakaan', 'hidden', $ginfo->tunjKecelakaan);
    $crud->field_type('tunj_kesehatan', 'hidden', $ginfo->tunjKesehatan);
    $crud->field_type('tunj_kematian', 'hidden', $ginfo->tunjKematian);
    $crud->field_type('tunj_istri', 'hidden', '');
    $crud->field_type('tunj_anak', 'hidden', '');
    $crud->field_type('id_jabatan', 'hidden', '');
    $crud->field_type('gaji_kotor', 'hidden', '');
    $crud->field_type('total_upah', 'hidden', '');
    $crud->field_type('uang_lembur', 'hidden', '');
    $crud->field_type('potongan', 'hidden', '');
    }
    $crud->display_as('nip','Karyawan')
         ->display_as('id_jabatan','Jabatan')
         ->display_as('total_upah','Gaji Bersih')
         ;
    //$crud->callback_column('nip',array($this,'_callback_nipk_url'));
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
    //$crud->unset_print();
    //$crud->unset_read();
    $this->mPageTitle = 'Daftar Gaji';
    $this->render_crud();
  }
}
