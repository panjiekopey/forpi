<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
  }

    public function index()
  {

    $crud = $this->generate_crud('data_absensi');
    $crud->columns('nip','keterangan','waktu_masuk','waktu_keluar','denda');
    $crud->set_relation('nip','karyawan','{nip}-{first_name}');
    $crud->required_fields('nip','keterangan');
    $crud->add_fields('nip','keterangan','waktu_masuk','waktu_keluar');
    $crud->edit_fields('nip','keterangan','waktu_masuk','waktu_keluar');
    //$crud->set_rules('nama','Nama','required');
    //$crud->set_rules('phone','Telepon / HP','required|integer');
    //$crud->set_rules('email','Email','required|valid_email');
    $crud->display_as('nip','Karyawan')
         ->display_as('keterangan','Kehadiran')
         ->display_as('denda','Denda/Jam');
    if($crud->getState()=='add'){
    $crud->set_relation('nip','karyawan','{nip}-{first_name}', array('active',1));
    $crud->field_type('waktu_keluar', 'hidden', date("Y-m-d",now()));
    //$crud->field_type('kode_pesanan', 'hidden', $this->pemesanans->create_pkode());
    }elseif($crud->getState()=='edit'){
    $crud->field_type('nip', 'readonly');
    }elseif($crud->getState()=='success' || $crud->getState()=='list'){
    echo "<script type='text/javascript'>javascript:history.go(-2 );</script>";
    }
    if (!$this->ion_auth->in_group('webmaster'))
    {
    $crud->unset_delete();
    }
    $crud->unset_export();
    $crud->unset_print();
    //$crud->unset_read();
    $this->mPageTitle = 'Absensi';
    $this->render_crud();
  }

  public function view(){
        //$tgl_wm = "DATE_FORMAT(waktu_masuk,'%Y-%m-%d')";

    $crud = $this->generate_crud('vabsensi');
    if($crud->getState()=='delete'){$crud = $this->generate_crud('data_absensi');}
    elseif($crud->getState()=='add'){redirect('admin/absensi/index/add');}
    elseif($crud->getState()=='read'){
        $crud->callback_read_field('jam_lembur',array($this,'_callback_jam_lembur'));
        $crud->callback_read_field('jam_telat',array($this,'_callback_jam_telat'));
        $crud->callback_read_field('denda_terlambat',array($this,'_callback_d_telat'));
    }
    $crud->callback_column('jam_lembur',array($this,'_callback_jam_lembur'));
    $crud->set_primary_key('id');
    $crud->set_subject('Absensi');
    $crud->columns('tanggal','nama','keterangan','jam_masuk');
    $crud->callback_column('nama',array($this,'_callback_nipk_url'));
    $crud->add_action('Ubah Absensi', '', 'admin/absensi/index/edit', 'edit-icon');
    //$crud->add_action('Data Lembur', '', 'admin/lembur/absensilembur/add/', 'fa fa-moon-o');
    $crud->order_by('tanggal','desc');
    $crud->display_as('nip','NIP')
         ->display_as('keterangan','Kehadiran')
         ->display_as('denda','Denda Telat /Jam');
    $crud->unset_edit();
    //$crud->unset_print();
    //$crud->unset_delete();
    //$crud->unset_export();
    //$crud->unset_read();
    $this->unset_crud_fields('id');
    $this->mPageTitle = 'Daftar Absensi';
    //$this->render_crud();

    $this->load->library('Grocery_crud_categories');
    $config = array(
    'table_name'=>'vabsensi',
    'related_table'=>'vabsensi',
    'sort_field'=>'tanggal',
    'categories_primary_key'=>'tanggal',
    'related_title_field'=>'tanggal',
    'order_by'=>'tanggal DESC',

    'first_url' => base_url().'admin/'.strtolower(__CLASS__).'/'.__FUNCTION__,
    'segment_name' => 'filter_date',
    'style' => 'height:24px; width: 150px;',
    'text'=>array('all_rows'=>'Filter Tanggal')
    );

    $categories = new grocery_crud_categories($crud,$config);
    $dropdown = $categories->get_dropdown();

    $output = $this->mCrud->render();
    if($crud->getState()=='list'){$this->mViewData['crud_output'] = $output->output.$dropdown;}
    else{$this->mViewData['crud_output'] = $output->output;}

    $this->add_stylesheet($output->css_files, FALSE);
    $this->add_script($output->js_files, TRUE, 'head');
    $this->render('crud');
  }

  /*public function viewlembur($absen_id)
  {
    $pinfo = $this->pemesanans->get_by(array('id'=>$pemesanan_id));

    $crud = $this->generate_crud('pemesanan_bahanBaku');
    $crud->set_subject('Bahan Baku');
    $crud->columns('nama_item','N_biaya','qty');
    $crud->required_fields('nama_item','qty','N_biaya');
    $crud->where('pemesanan_id',$pemesanan_id);
    $crud->unset_export();
    $crud->unset_read();
    $crud->unset_print();
    $crud->callback_column('N_biaya',array($this,'_cb_nominal'));
    $crud->set_rules('N_biaya', 'Upah Kerja', 'trim|numeric|required');
    $crud->add_fields('nama_item','qty','N_biaya','pemesanan_id');
    $crud->display_as('N_biaya','Biaya {Rp.}');
    $crud->edit_fields('nama_item','qty','N_biaya');
    $crud->set_js('assets/js/callback.js');
    $crud->post_ajax_callbacks('do_the_sum()');
    $this->unset_crud_fields('pemesanan_id');
    if($pinfo->status=='selesai-lunas'){$crud->unset_add(); $crud->unset_edit(); $crud->unset_delete();}
    if($crud->getState()=='add'){$crud->field_type('pemesanan_id', 'hidden', $pemesanan_id);}
    elseif($crud->getState()=='list' || $crud->getState()=='success'){
    $this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali ke Pemesanan', 'pemesanan/view', 'fa fa-reply', 'bg-purple');
    }
    $this->mPageTitle = 'Bahan Baku Pemesanan ('.$pinfo->kode_pesanan.')';
    $this->render_crud();
  }*/

  public function _callback_nipk_url($value, $row)
  {
    return "<a style='color:#000;text-decoration:none;' href='".site_url('admin/karyawan/lists/read/'.$row->nip)."' title='Click for detail Karyawan'>".$value."</a>";
  }

    public function _callback_jam_lembur($value, $row)
  {
      $input   = $value;
      $caption = $value == 0 ? '{Tidak Lembur}' : $value.' Jam';
      return $caption;
  }
      public function _callback_jam_telat($value, $row)
  {
      $input   = $value;
      $caption = $value == 0 ? '{Tidak Terlambat}' : $value.' Jam';
      return $caption;
  }
    public function _callback_d_telat($value, $row)
  {
      $input   = $value;
      $caption = $value == 0 ? '{Tidak kena Denda}' : 'Rp. '.$value;
      return $caption;
  }
}
