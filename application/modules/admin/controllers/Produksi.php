<?php
defined('BASEPATH') OR exit('No direct scripd access allowed');

class Produksi extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->helper(array('url','terbilang'));
    $this->load->model('pemesanan_model','pemesanans');
    $this->load->model('produksi_model','m_produksi');
    $this->load->library('form_builder');
    $this->mPageTitle = 'Produksi';
  }

  // Frontend User CRUD
  public function index()
  {
    $crud = $this->generate_crud('produksi');
    $crud->columns('tgl_produksi','pemesanan_id','keterangan');
    $crud->add_fields('tgl_produksi','pemesanan_id','karyawan_id','upah_kerja','keterangan');
    $crud->edit_fields('tgl_produksi','pemesanan_id','karyawan_id','upah_kerja','keterangan');
    $crud->unset_texteditor('keterangan');
    $crud->display_as('pemesanan_id','Pemesanan')
         ->display_as('tgl_produksi','Tanggal Produksi')
         ->display_as('karyawan_id','Karyawan')
         ->display_as('N_upah','Total Upah {Rp.}');
    if($crud->getState()=='list' || $crud->getState()=='success'){redirect('admin/produksi/view','refresh');}
    elseif($crud->getState()=='edit' || $crud->getState()=='update' || $crud->getState()=='update_validation'){
    $crud->set_relation_n_n('karyawan_id', 'produksi_detail', 'karyawan', 'produksi_id', 'karyawan_id', '{first_name} {last_name}','',array('active'=>1));
    $crud->set_relation('pemesanan_id','pemesanans','[{kode_pesanan}] {jenis}');
    $crud->required_fields('upah_kerja');
    $crud->field_type('tgl_produksi','readonly');
    $crud->field_type('pemesanan_id','readonly');
    $crud->set_rules('upah_kerja', 'Upah Kerja', 'trim|numeric|required');
    }elseif($crud->getState()=='add' || $crud->getState()=='insert' || $crud->getState()=='insert_validation'){
    $crud->required_fields('pemesanan_id','upah_kerja');
    if ($this->uri->segment(5)!=null && is_numeric($this->uri->segment(5))) {
      $uriprseg5 = $this->uri->segment(5);
      echo $uriprseg5;
      $pinfo = $this->pemesanans->get_by(array('id'=>$uriprseg5));
      $this->mPageTitle .= ' Pemesanan ('.$pinfo->kode_pesanan.') '.$pinfo->jenis.'';
      $crud->field_type('pemesanan_id', 'hidden', $uriprseg5);
    }else{
    $crud->set_relation('pemesanan_id','pemesanans','({kode_pesanan}) {jenis}',array('status' => 'proses'));
    }
    $crud->set_relation_n_n('karyawan_id', 'produksi_detail', 'karyawan', 'produksi_id', 'karyawan_id', '{first_name} {last_name}','',array('active'=>1));
    $crud->field_type('tgl_produksi', 'hidden', date("Y-m-d",now()));
    $crud->set_rules('pemesanan_id', 'Jenis Pemesanan', 'trim|required');
    $crud->set_rules('upah_kerja', 'Upah Kerja', 'trim|numeric|required');
    }
    $this->render_crud();
  }

  // Frontend User CRUD
  public function view()
  {
    $crud = $this->generate_crud('vproduksi');
    $crud->set_primary_key('id');
    if($crud->getState()=='add'){redirect('admin/produksi/index/add');
    }elseif($crud->getState()=='delete'){$crud = $this->generate_crud('produksi');}
    $crud->columns('tgl_produksi','pemesanan_id','karyawan_id');
    $crud->set_read_fields('tgl_produksi','pemesanan_id','keterangan','karyawan_id','jml_selesai','N_upah');
    $crud->set_relation('pemesanan_id','pemesanans','[{kode_pesanan}] {jenis}');
    $crud->set_relation_n_n('karyawan_id', 'produksi_detail', 'karyawan', 'produksi_id', 'karyawan_id', 'first_name');
    $crud->add_action('Ubah Produksi', '', 'admin/produksi/index/edit', 'edit-icon');
    $crud->callback_column('N_upah',array($this,'_cb_nominal'));
    //$crud->add_action('Read Produksi', '', 'admin/produksi/index/read', 'read-icon');
    $crud->add_action('Lebih Detail', '', 'admin/produksi/detail_aktivitas', 'fa fa-location-arrow');
    $crud->display_as('pemesanan_id','Pemesanan')
         ->display_as('tgl_produksi','Tanggal Produksi')
         ->display_as('karyawan_id','Daftar Nama Karyawan')
         ->display_as('jml_selesai','Hasil Jadi')
         ->display_as('N_upah','Total Upah {Rp.}');
    $crud->set_subject('Produksi');
    $crud->order_by('tgl_produksi','desc');
    $crud->unset_edit();
    //$crud->unset_export();
    $crud->unset_print();
    //$crud->unset_read();

    $this->load->library('Grocery_crud_categories');
    $config = array(
    'table_name'=>'vproduksi',
    'related_table'=>'vproduksi',
    'sort_field'=>'tgl_produksi',
    'categories_primary_key'=>'tgl_produksi',
    'related_title_field'=>'tgl_produksi',
    'order_by'=>'tgl_produksi DESC',

    'first_url' => base_url().'admin/'.strtolower(__CLASS__).'/'.__FUNCTION__,
    'segment_name' => 'filter_date',
    'style' => 'height:24px; width: 150px;',
    'text'=>array('all_rows'=>'Filter Tanggal Produksi')
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

    // CRUD Bahan Baku sesuai pilihan Pemesanan
  public function detail_aktivitas($produksi_id)
  {
    $prinfo = $this->m_produksi->get_by(array('id'=>$produksi_id));
    $pinfo = $this->pemesanans->get_by(array('id'=>$prinfo->pemesanan_id));

    $crud = $this->generate_crud('produksi_detail');
    $crud->set_subject('Detail Produksi');
    $crud->set_relation('karyawan_id','karyawan','{first_name} {last_name}');
    $crud->where('produksi_id',$produksi_id);
    $crud->display_as('karyawan_id','Nama Karyawan')
         ->display_as('N_upah','Upah Kerja')
        ->display_as('selesai','Menyelesaikan');
    $crud->edit_fields('produksi_id','karyawan_id','selesai','N_upah');
    $crud->callback_before_update(array($this,'cbu_detail_aktivitas'));
    $crud->required_fields('selesai');
    $crud->unset_columns('produksi_id');
    $crud->callback_column('N_upah',array($this,'_cb_nominal'));
    $crud->unset_add();
    $crud->unset_delete();
    $crud->unset_read();
    $crud->unset_export();
    $crud->unset_print();
    $this->unset_crud_fields('id','produksi_id');
    if($crud->getState()=='edit'){
    $prinfo = $this->m_produksi->get_by(array('id'=>$produksi_id));
      $crud->field_type('produksi_id','hidden',$produksi_id);
      $crud->field_type('karyawan_id','readonly');
      $crud->field_type('N_upah','hidden');
    }
    $this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Rincian Produksi', 'pemesanan/multigridsapr/'.$prinfo->pemesanan_id, 'fa fa-reply', 'bg-purple');
    $this->mPageTitle = 'Detail Aktivitas Produksi ('.$pinfo->kode_pesanan.') Tanggal '.$prinfo->tgl_produksi;
    $this->render_crud();
  }

  function cbu_detail_aktivitas($post_array, $primary_key) {
    $this->load->model('produksi_detail_model','m_produksi_detail');
    $prdinfo = $this->m_produksi_detail->get_by(array('id'=>$primary_key));
    $prinfo = $this->m_produksi->get_by(array('id'=>$prdinfo->produksi_id));
    if(!empty($post_array['selesai'])){$post_array['N_upah'] = ($post_array['selesai'] * $prinfo->upah_kerja);}
    else {unset($post_array['N_upah']);}
    return $post_array;
  }

  public function tes()
  {
    $this->load->library('gc_dependent_select');
    $crud = $this->generate_crud('daftar_gaji');
    //$crud->columns('id','produksi_id','karyawan_id','selesai','N_upah');
    //$crud->add_fields('produksi_id','karyawan_id','selesai','N_upah');
    $crud->set_relation('nip','karyawan','{nip} - {first_name}');
    //$crud->set_relation('id_jabatan','karyawan','id_jabatan');
    // $fields = array(
    //  'nip' => array(// first dropdown name
    //    'table_name' => 'karyawan', // table of country
    //    'title' => 'nip', // country title
    //    'relate' => null // the first dropdown hasn't a relation
    //   )
    //   , // second field
     // 'gaji_kotor' => array( // second dropdown name
     //   'table_name' => 'karyawan', // table of state
     //   'title' => 'id_jabatan', // state title
     //   'id_field' => 'id_jabatan', // table of state: primary key
     //   //'where' =>"N_upah>'1000'", // string. It's an optional parameter.
     //   'relate' => 'id', // table of state:
     //   'data-placeholder' => 'select' //dropdown's data-placeholder:
     // )
    //  );
    //  $config = array(
    //   'main_table' => 'daftar_gaji',
    //   'main_table_primary' => 'id',
    //   'url' => base_url().'admin/'.strtolower(__CLASS__).'/'.__FUNCTION__.'/',
    //   'segment_name' => 'select'
    //   );
    // $categories = new gc_dependent_select($crud,$fields,$config);
    // $js = $categories->get_js();
    if($crud->getState()=='add'){
      $crud->field_type('tanggal','hidden',date("Y-m-d",now()));
      $crud->field_type('id_jabatan','hidden','');
      $crud->field_type('uang_makan','hidden','');
    }
    $crud->callback_before_insert(array($this,'hitung_gaji'));
    //$output = $this->mCrud->render();
    //$output->output.= $js;
    $this->mPageTitle .= ' Tes Dependen Dropdown';
    //$this->add_stylesheet($output->css_files, FALSE);
    //$this->add_script($output->js_files, TRUE, 'head');
    //$this->mViewData['crud_output'] = $output->output;
    //$this->render('crud');

    $this->render_crud();
  }

    // callback function nominal
  public function _cb_nominal($value, $row)
  {
  return "<span title='".terbilang($value)." Rupiah'>".number_format($value,0,",",".")."</span>";
  }

  function hitung_gaji($post_array) {
    $this->load->model('gaji_model','m_gaji');
    $infoConfig = $this->m_gaji->get_by(array('id'=>1));
    $ginfo = $this->m_gaji->get_ginfo($post_array['nip']);
    $dginfo = $this->m_gaji->get_dginfo($post_array['nip']);
    $denda_telat = $ginfo->pDendaTerlambat<>null?$ginfo->pDendaTerlambat:0;
    $denda_alfa = $dginfo->denda<>null?$dginfo->denda:0;

    $post_array['id_jabatan'] = $ginfo->id_jabatan;
    $post_array['uang_makan'] = $infoConfig->uangMakan;
    $post_array['uang_transport'] = $infoConfig->uangTransport;
    $post_array['tunj_hari_tua'] = $infoConfig->tunjHariTua;
    $post_array['tunj_kecelakaan'] = $infoConfig->tunjKecelakaan;
    $post_array['tunj_kesehatan'] = $infoConfig->tunjKesehatan;
    $post_array['tunj_kematian'] = $infoConfig->tunjKematian;

    $post_array['uang_lembur'] = $ginfo->gUpahLembur<>null?$ginfo->gUpahLembur:0;
    $post_array['potongan'] = $denda_alfa + $denda_telat;
    $post_array['gaji_kotor'] = $ginfo->gaji_pokok;
    return $post_array;
  }

}
