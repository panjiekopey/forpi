<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function index()
  {
    $crud = $this->generate_crud('VD_Nasabah');
    $crud->set_primary_key('No_Rekening');
    $crud->set_subject('Rekening');
    //$crud->set_relation('ID_Nasabah','nasabah','Nama_Lengkap');
    //$crud->set_relation('Jenis_Tabungan','jenis_tabungan','Jenis_Tabungan');
    $crud->columns('Jenis_Tabungan','No_Rekening','Nama_Lengkap','Saldo','Tanggal_Buka');
    $crud->callback_column('Nama_Lengkap',array($this,'_callback_url_ID_Nasabah'));
    $crud->display_as('Nama_Lengkap','Nasabah');
    //$crud->add_fields('Nama_Lengkap','Tempat_Lahir','Tanggal_Lahir','Nomor_Kartu_Identitas','Agama','Kewarganegaraan','Nama_Ibu_Kandung','Alamat','RT','RW','Kelurahan','Kecamatan','Kota','Kode_Pos','NoTelp','Fax','No_Hp','Email');
    //$crud->columns('nama','phone','email');
    //$crud->display_as('phone','Telepon / HP');

    //$crud->set_rules('nama','Nama','required');

    //$crud->set_lang_string('update_success_message','Your data has been successfully updated.<br/>Please wait while you are redirect to the list page.<script type="text/javascript">window.location="'.base_url().'/admin/'.(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'";</script><div style="display:none">');
    //$crud->callback_field('Tipe_Kartu_Identitas',array($this,'typeidcard_field_callback'));
    //$crud->field_type('Tanggal_Lahir', 'date');
    //$crud->unset_texteditor('Alamat');
    $crud->add_action('Detail Transaksi', '', 'admin/rekening/transaksi', 'fa fa-money');
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_add();
    $crud->unset_read();
    $this->mPageTitle = 'Rekening';
    $this->render_crud();
  }

  public function transaksi($No_Rekening)
  {
    $crud = $this->generate_crud('VD_Transaksi');
    $crud->set_primary_key('ID_Transaksi');
    $crud->set_subject('Transaksi');
    $crud->columns('Tanggal_Transaksi','Rekening_Tujuan','Nominal','Tipe_Transaksi');
    //$crud->display_as('Nominal','Nominal');
    //$crud->set_relation('ID_Nasabah','nasabah','Nama_Lengkap');
    //$crud->set_relation('Tipe_Transaksi','tipe_transaksi','Nama_Transaksi');
    //$crud->set_relation('Rekening_Transaksi','rekening','{No_Rekening} - {ID_Nasabah}');
    $crud->where('Rekening_Transaksi',$No_Rekening);
    if($crud->getState()=='add'){
        $crud->field_type('Tanggal_Transaksi', 'hidden', date("Y-m-d",now()));

    }
    $crud->order_by('Tanggal_Transaksi');
    //$crud->add_fields('Nama_Lengkap','Tempat_Lahir','Tanggal_Lahir','Nomor_Kartu_Identitas','Agama','Kewarganegaraan','Nama_Ibu_Kandung','Alamat','RT','RW','Kelurahan','Kecamatan','Kota','Kode_Pos','NoTelp','Fax','No_Hp','Email');


    //$crud->set_rules('nama','Nama','required');

    //$crud->callback_field('Tipe_Kartu_Identitas',array($this,'typeidcard_field_callback'));
    //$crud->field_type('Tanggal_Lahir', 'date');
    //$crud->unset_texteditor('Alamat');
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    //$crud->unset_operations();
    //$crud->unset_export();
    $crud->unset_add();
    $crud->unset_edit();
    $crud->unset_delete();
    $crud->unset_print();
    $crud->unset_read();

    $this->load->library('Grocery_crud_categories');
    $config = array(
    'table_name'=>'VD_Transaksi',
    'related_table'=>'VD_Transaksi',
    'sort_field'=>'Bulan',
    'categories_primary_key'=>'Bulan',
    'related_title_field'=>'Bulan',
    'order_by'=>'Bulan DESC',

    'first_url' => base_url().'admin/'.strtolower(__CLASS__).'/'.__FUNCTION__.'/'.$No_Rekening.'',
    'segment_name' => 'filter',
    'style' => 'height:24px; width: 150px;',
    'text'=>array('all_rows'=>'Filter Bulan')
    );
    $categories = new grocery_crud_categories($crud,$config);
    $dropdown = $categories->get_dropdown();

    $output = $this->mCrud->render();
    if($crud->getState()=='list'){
        $this->mViewData['crud_output'] = $output->output.$dropdown;
        if ( empty($this->uri->segment(6)) ){

        }else{
        $this->load->model('rekening_model','m_rek');
        $tmv = $this->m_rek->tes($No_Rekening,$this->uri->segment(6));
//echo $tmv;
        $this->mViewData['crud_note'] = modules::run('adminlte/widget/info_box', 'bg-purple', 'Bunga saldo terendah harian', '', 'fa fa-calculator', '');
        }

    }
    else{
        $this->mViewData['crud_output'] = $output->output;
    }
    $this->add_stylesheet($output->css_files, FALSE);
    $this->add_script($output->js_files, TRUE, 'head');
    $this->render('crud');
    //$this->mPageTitle = 'Transaksi';
    //$this->render_crud();
  }

    // callback ke function bahan baku
  public function _callback_url_ID_Nasabah($value, $row)
  {
    //$qid = $this->db->select('pemesanan_id as id')->get_where('pemesanan_biaya', array('id' => $row->id))->row();
    return"<a href='".site_url('admin/nasabah/index/read/'.$row->ID_Nasabah)."' title=''>".$value."</a>";
  }
}
