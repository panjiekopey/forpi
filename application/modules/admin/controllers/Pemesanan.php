<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->helper(array('url','terbilang'));
    $this->load->model('pemesanan_model','pemesanans');
    $this->load->library(array('form_builder','grocery_CRUD'));
  }

  // CRUD master Pemesanan
  public function index()
  {
    $crud = $this->generate_crud('pemesanans');
    $crud->set_relation('pelanggan_id','pelanggan','{nama} ({phone})');
    $crud->required_fields('jenis','jumlah','pelanggan_id');
    $crud->callback_column('status',array($this,'_callback_status_url'));
    $crud->add_fields('tgl_pemesanan','kode_pesanan','jenis','jumlah','tgl_pengambilan','pelanggan_id','keterangan');
    $crud->edit_fields('kode_pesanan','tgl_pemesanan','jenis','jumlah','tgl_pengambilan','image_url','pelanggan_id','keterangan');
    $crud->set_field_upload('image_url', UPLOAD_IMAGE_PEMESANAN);
    $crud->callback_before_insert(array($this,'callback_p_prepare'));
    $crud->callback_before_update(array($this,'callback_p_prepare'));
    $crud->unset_texteditor('keterangan');
    $crud->display_as('jenis','Jenis Pesanan')
         ->display_as('jumlah','Jumlah Pesanan');
    if($crud->getState()=='add'){
    $crud->field_type('tgl_pemesanan', 'hidden', date("Y-m-d",now()));
    $crud->field_type('kode_pesanan', 'hidden', $this->pemesanans->create_pkode());
    }elseif($crud->getState()=='edit')
    {
    $crud->field_type('kode_pesanan', 'readonly');
    $crud->field_type('tgl_pemesanan', 'readonly');
    }
    elseif($crud->getState()=='success' || $crud->getState()=='list'){
    echo "<script type='text/javascript'>javascript:history.go(-2 );</script>";
    }
    //$crud->unset_back_to_list();
    $this->mPageTitle = 'Pemesanan';
    //echo $crud->getState();
    $this->render_crud();
  }

  // CRUD vpemesanan
  public function view()
  {

    $crud = $this->generate_crud('vpemesanan');
    if($crud->getState()=='delete'){$crud = $this->generate_crud('pemesanans');}
    elseif($crud->getState()=='add'){redirect('admin/pemesanan/index/add');}
    $crud->set_primary_key('id');
    $crud->set_subject('Pemesanan');
    $crud->columns('kode_pesanan','jenis','tgl_pengambilan','pelanggan_id','jumlah','status');
    $crud->set_relation('pelanggan_id','pelanggan','{nama} ({phone})');
    $crud->set_field_upload('image_url', UPLOAD_IMAGE_PEMESANAN);
    $crud->callback_column('tgl_pengambilan',array($this,'_callback_batas_waktu_url'));
    $crud->callback_column('status',array($this,'_callback_status_url'));
    //$crud->callback_column('jumlah',array($this,'_callback_produksi_url'));
    //$crud->callback_column('N_ttlBiaya',array($this,'_callback_tbiaya_url'));
    //$crud->callback_column('N_sisa_bayar',array($this,'_callback_sisa_pembayaran'));
    $crud->add_action('Ubah Pemesanan', '', 'admin/pemesanan/index/edit', 'edit-icon');
    $crud->add_action('Bahan Baku Pemesanan', '', 'admin/pemesanan/bahan_baku', 'fa fa-shopping-cart');
    $crud->add_action('Transaksi Pemesanan', '', 'admin/pemesanan/transaksi', 'fa fa-money');
    $crud->add_action('Rincian Produksi Pemesanan', '', 'admin/pemesanan/multigridsapr', 'fa fa-file-text-o');
    //$crud->add_action('Produksi', '', 'admin/produksi/index/add', 'fa fa-gears');
    $crud->where('status','proses');
    $crud->order_by('tgl_pengambilan');
    $crud->display_as('tgl_pengambilan','Tanggal Pengambilan')
         ->display_as('tgl_pemesanan','Tanggal Pemesanan')
         ->display_as('jenis','Jenis Pesanan')
         ->display_as('jumlah','Jumlah Pesanan');
    $crud->unset_edit();
    $crud->unset_print();
    //$crud->unset_export();
    //$crud->unset_add();
    $this->unset_crud_fields('id','N_ttlBiaya','N_sisa_bayar','N_jmlTransaksi','limit_hari','prosentase');
    $this->mPageTitle = 'Pemesanan';
    $this->render_crud();
  }


  //CRUD vpl
  public function vpl()
  {
    $crud = $this->generate_crud('vpemesanan');
    if($crud->getState()=='delete'){$crud = $this->generate_crud('pemesanans');}
    $crud->set_primary_key('id');
    $crud->set_subject('Pemesanan');
    $crud->columns('kode_pesanan','jenis','tgl_pengambilan','pelanggan_id','jumlah','N_ttlBiaya','N_sisa_bayar','status');
    $crud->set_relation('pelanggan_id','pelanggan','{nama} ({phone})');
    $crud->callback_column('N_ttlBiaya',array($this,'_callback_tbiaya_url'));
    $crud->callback_column('N_sisa_bayar',array($this,'_callback_sisa_pembayaran'));
    //$crud->callback_column('tgl_pengambilan',array($this,'_callback_batas_waktu_url'));
    $crud->callback_column('status',array($this,'_callback_status_url'));
    $crud->set_field_upload('image_url', UPLOAD_IMAGE_PEMESANAN);
    $crud->add_action('Ubah Pemesanan', '', 'admin/pemesanan/index/edit', 'edit-icon');
    $crud->add_action('Transaksi Pemesanan', '', 'admin/pemesanan/transaksi', 'fa fa-money');
    $crud->add_action('Rincian Produksi', '', 'admin/pemesanan/multigridsapr', 'fa fa-file-text-o');
    $crud->where('status<>','proses');
    $crud->order_by('status');
    $crud->display_as('jenis','Jenis Pesanan')
         ->display_as('tgl_pengambilan','Tanggal Pengambilan')
         ->display_as('jumlah','Jumlah Pesanan')
         ->display_as('N_ttlBiaya','Total Biaya {Rp.}')
         ->display_as('N_sisa_bayar','Sisa Bayar {Rp.}');
    $crud->unset_add();
    $crud->unset_edit();
    $this->unset_crud_fields('id','selesai','limit_hari','status','N_jmlTransaksi','prosentase');
    $this->mPageTitle = 'Pemesanan';
    $this->render_crud();
  }

  //CRUD view Total Biaya sesuai pilihan Pemesanan
  public function vtotal_biaya($pid)
  {
    $pinfo = $this->pemesanans->get_pinfo($pid);

    $crud = $this->generate_crud('vpemesanan_biaya');
    $crud->set_primary_key('id');
    $crud->add_action('Ubah Biaya Tambahan', '', 'admin/pemesanan/total_biaya/'.$pid.'/edit', 'edit-icon');
    $crud->set_subject('Biaya Pemesanan');
    $crud->columns('N_biaya_bhnbaku','N_biaya_jasa','N_biaya_tambahan');
    $crud->where('pemesanan_id',$pid);
    $crud->callback_column('N_biaya_bhnbaku',array($this,'_callback_bbaku_url'));
    $crud->callback_column('N_biaya_jasa',array($this,'_callback_aktivitas_produksi_url'));
    $crud->callback_column('N_biaya_tambahan',array($this,'_cb_nominal'));
    $crud->display_as('N_biaya_bhnbaku','Biaya bahan baku {Rp.}')
    ->display_as('N_biaya_jasa','Biaya Jasa {Rp.}')
    ->display_as('N_biaya_tambahan','Biaya Lainya {Rp.}');
    $crud->unset_edit();
    $crud->unset_add();
    $crud->unset_delete();
    $crud->unset_columns('pemesanan_id');
    $this->unset_crud_fields('id','pemesanan_id');
    $this->mPageTitle = 'Rincian Biaya Pemesanan ('.$pinfo->kode_pesanan.')';
  if($crud->getState()=='list' || $crud->getState()=='success'){
    $this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali ke Pemesanan', 'pemesanan/vpl', 'fa fa-reply', 'bg-purple');
  }
    $this->render_crud();
  }

  //================================================MULTIGRIDS=================================================
  // Multigirds Aktifitas Produksi & biaya upah karyawan sesuai pilihan Pemesanan
    function multigridsapr($pemesanan_id)
  {
    $pinfo = $this->pemesanans->get_by(array('id'=>$pemesanan_id));
    $this->config->load('grocery_crud');
    //$this->config->set_item('grocery_crud_dialog_forms',false);
    //$this->config->set_item('grocery_crud_default_per_page',25);

    $output1 = $this->buk($pemesanan_id);
    $output2 = $this->aktivitas_produksi($pemesanan_id);

    $output = "<br/><h4>Daftar Jumlah Upah Kerja Karyawan</h4>".$output1->output."<br/><h4>Daftar Hari Aktivitas Produksi</h4>".$output2->output;
    $this->mViewData['crud_output'] = $output;
    //$this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali ke Pemesanan', 'pemesanan/view', 'fa fa-reply', 'bg-purple');
    $this->add_stylesheet($output1->css_files, TRUE);
    $this->add_stylesheet($output2->css_files, FALSE);
    $this->add_script($output1->js_files, TRUE,'head');
    $this->add_script($output2->js_files, TRUE, 'head');
    $this->mPageTitle = 'Rincian Produksi Pemesanan ('.$pinfo->kode_pesanan.')';
    $this->render('crud');
  }

  //CRUD view Aktivitas Produksi sesuai pilihan Pemesanan {Bagian Multigrids}
  public function aktivitas_produksi($pemesanan_id)
  {
    $pinfo = $this->pemesanans->get_by(array('id'=>$pemesanan_id));
    $crud = $this->generate_crud('vproduksi');
    $crud->set_primary_key('id');
    if($crud->getState()=='add'){redirect('admin/produksi/index/add');
    }elseif($crud->getState()=='delete'){$crud = $this->generate_crud('produksi');}
    $crud->columns('tgl_produksi','karyawan_id','jml_selesai','N_upah');
    $crud->set_relation_n_n('karyawan_id', 'produksi_detail', 'karyawan', 'produksi_id', 'karyawan_id', 'first_name');
    $crud->add_action('Lebih Detail', '', 'admin/produksi/detail_aktivitas', 'fa fa-location-arrow');
    $crud->callback_column('N_upah',array($this,'_cb_nominal'));
    $crud->display_as('pemesanan_id','Jenis Pemesanan');
    $crud->display_as('karyawan_id','Daftar Nama Karyawan');
    $crud->display_as('jml_selesai','Terselesaikan');
    $crud->display_as('N_upah','Total Upah {Rp.}');
    $crud->set_subject('Aktivitas Produksi');
    $crud->where('pemesanan_id',$pemesanan_id);
    $crud->order_by('tgl_produksi','desc');
    $crud->set_js('assets/js/callback2.js');
    $crud->post_ajax_callbacks('do_the_sum_ap()');
    $crud->unset_operations();
    $crud->set_crud_url_path(site_url('admin/'.strtolower(__CLASS__."/".__FUNCTION__).'/'.$pemesanan_id),site_url('admin/'.strtolower(__CLASS__."/multigridsapr/".$pemesanan_id)));
    //$this->mPageTitle = 'Aktivitas Produksi Pemesanan ('.$pinfo->kode_pesanan.')';
    $output = $this->mCrud->render();
    $this->mViewData['crud_output'] = $output->output;
    //$this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali ke Pemesanan', 'pemesanan/view', 'fa fa-reply', 'bg-purple');
    if($crud->getState() != 'list') {
    $this->add_stylesheet($output->css_files, FALSE);
    $this->add_script($output->js_files, TRUE, 'head');
    $this->render('crud');
    } else {
      //$this->render('crud');
      return $output;
    }
    //$this->render_crud();
  }

  //CRUD view biaya upah karyawan sesuai pilihan Pemesanan {Bagian Multigrids}
  public function buk($pemesanan_id)
  {
    $pinfo = $this->pemesanans->get_by(array('id'=>$pemesanan_id));
    $crud = $this->generate_crud('vbiaya_jasa_karyawan');
    $crud->set_primary_key('p_id');
    $crud->set_subject('Upah Karyawan');
    $crud->columns('karyawan_id','N_bupah');
    $crud->display_as('karyawan_id','Nama Karyawan')
         ->display_as('N_bupah','Upah Kerja {Rp.}}');
    $this->unset_crud_fields('p_id');
    $crud->set_relation('karyawan_id','karyawan','{first_name} {last_name}');
    $crud->callback_column('N_bupah',array($this,'_cb_nominal'));
    $crud->where('p_id',$pemesanan_id);
    //$crud->set_js('assets/js/callback.js');
    //$crud->post_ajax_callbacks('do_the_sum()');
    $crud->unset_add();
    $crud->unset_edit();
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_delete();
    //$crud->add_action('', '', 'admin/produksi/detail_aktivitas', 'fa fa-smile-o');
    $crud->unset_operations();
    $crud->set_crud_url_path(site_url('admin/'.strtolower(__CLASS__."/".__FUNCTION__).'/'.$pemesanan_id),site_url('admin/'.strtolower(__CLASS__."/multigridsapr/".$pemesanan_id)));
    //$this->mPageTitle = 'Biaya Jasa Pemesanan ('.$pinfo->kode_pesanan.')';
    $output = $this->mCrud->render();
    $this->mViewData['crud_output'] = $output->output;
    //$this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali ke Pemesanan', 'pemesanan/view', 'fa fa-reply', 'bg-purple');
        if($crud->getState() != 'list') {
    $this->add_stylesheet($output->css_files, FALSE);
    $this->add_script($output->js_files, TRUE, 'head');
    $this->render('crud');
    } else {
      //$this->render('crud');
      return $output;
    }
    //$this->render_crud();
  }
//================================================END MULTIGRIDS=================================================


//==============================================CRUD CHILD PEMESANAN===========================================
  //CRUD Total Biaya sesuai pilihan Pemesanan
  public function total_biaya($pid)
  {
    $pinfo = $this->pemesanans->get_pinfo($pid);

    $crud = $this->generate_crud('pemesanan_biaya');
    if($crud->getState()=='list' || $crud->getState()=='success'){redirect('admin/pemesanan/vtotal_biaya/'.$pid.'');}
    elseif($crud->getState()=='edit' || $crud->getState()=='update' || $crud->getState()=='update_validation'){
      $crud->required_fields('N_biaya_tambahan');
      $crud->field_type('pemesanan_id', 'hidden', $pid);
      $crud->set_rules('N_biaya_tambahan', 'Biaya Tambahan', 'trim|numeric|required');
    }
    $crud->where('pemesanan_id',$pid);
    $crud->edit_fields('N_biaya_tambahan','pemesanan_id');
    $crud->display_as('N_biaya_tambahan','Biaya Tambahan');
    $crud->unset_columns('pemesanan_id');
    $crud->unset_add();
    $crud->unset_delete();
    $this->mPageTitle = 'Rincian Biaya Pemesanan ('.$pinfo->kode_pesanan.')';
    $this->render_crud();
  }

    // CRUD Bahan Baku sesuai pilihan Pemesanan
  public function bahan_baku($pemesanan_id)
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
  }

  // CRUD Transaksi sesuai pilihan Pemesanan
  public function transaksi($pemesanan_id)
  {
    //crud transaksi
    $pinfo = $this->pemesanans->get_by(array('id'=>$pemesanan_id));

    $crud = $this->generate_crud('pemesanan_transaksi');
    $crud->set_subject('Transaksi');
    $crud->columns('tgl_transaksi','N_nominal');
    $crud->required_fields('N_nominal');
    $crud->where('pemesanan_id',$pemesanan_id);
    $crud->order_by('tgl_transaksi','desc');
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_read();
    $crud->callback_column('N_nominal',array($this,'_cb_nominal'));
    $crud->set_rules('N_nominal', 'Upah Kerja', 'trim|numeric|required');
    $crud->add_fields('tgl_transaksi','N_nominal','keterangan','pemesanan_id');
    $crud->edit_fields('N_nominal','keterangan');
    $crud->display_as('tgl_transaksi','Tanggal')
        ->display_as('N_nominal','Nominal {Rp.}');
    $crud->set_js('assets/js/callback.js');
    $crud->post_ajax_callbacks('do_the_sum()');
    $this->unset_crud_fields('pemesanan_id');
    if ($pinfo->status=='selesai-lunas'){$crud->unset_add(); $crud->unset_edit(); $crud->unset_delete();}
    if($crud->getState()=='add'){
      $crud->field_type('tgl_transaksi', 'hidden', date("Y-m-d",now()));
      $crud->field_type('pemesanan_id', 'hidden', $pemesanan_id);
    }elseif($crud->getState()=='list' || $crud->getState()=='success'){
    $this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali ke Pemesanan', 'pemesanan/view', 'fa fa-reply', 'bg-purple');
    }
    $this->mPageTitle = 'Transaksi Pemesanan ('.$pinfo->kode_pesanan.')';
    //$this->mBreadcrumb = array('name','BB','CC');

    $this->render_crud();
  }
//==============================================END CRUD CHILD PEMESANAN===========================================

//==============================================CALLBACK===========================================

  // callback untuk update biaya bahan baku dan biaya total
  public function _callback_tbiaya_url($value, $row)
  {
    //$pinfo = $this->pemesanans->get_pinfo($row->id);
    return "<a style='color:#000;text-decoration:none;' href='".site_url('admin/pemesanan/vtotal_biaya/'.$row->id)."' title='".terbilang($value)." Rupiah'>".number_format($value,0,",",".")."</a>";
  }

  // callback update status pemesanan
  public function _callback_sisa_pembayaran($value, $row)
  {
    $pinfo = $this->pemesanans->get_pinfo($row->id);
    if ($pinfo->status!='selesai & lunas') {
    return "<span title='".terbilang($pinfo->N_sisa_bayar)." Rupiah'>".number_format($pinfo->N_sisa_bayar,0,",",".")."</span>";
    }else{
    return "<span>-</span>";
    }
  }

  // callback function nominal
  public function _cb_nominal($value, $row)
  {
  return "<span title='".terbilang($value)." Rupiah'>".number_format($value,0,",",".")."</span>";
  }

    // callback ke function bahan baku
  public function _callback_bbaku_url($value, $row)
  {
    $qid = $this->db->select('pemesanan_id as id')->get_where('pemesanan_biaya', array('id' => $row->id))->row();
    return"<a href='".site_url('admin/pemesanan/bahan_baku/'.$qid->id)."' title='".terbilang($value)." Rupiah'>".number_format($value,0,",",".")."</a>";
  }

  // callback ke function bahan baku
  public function _callback_aktivitas_produksi_url($value, $row)
  {
    $qid = $this->db->select('pemesanan_id as id')->get_where('pemesanan_biaya', array('id' => $row->id))->row();
    return"<a href='".site_url('admin/pemesanan/multigridsapr/'.$qid->id)."' title='".terbilang($value)." Rupiah'>".number_format($value,0,",",".")."</a>";
  }

  // callback update status pemesanan
  public function _callback_status_url($value, $row)
  {
    $q2 = $this->pemesanans->get_pinfo($row->id);
    if ($q2->selesai != null) {
      if($q2->selesai>$q2->jumlah){
        $pinfselesai = "tidak sesuai";
        //$update_status = array("id" => $row->id,"status" => "proses");
      }elseif($q2->selesai==$q2->jumlah){
      if($q2->N_jmlTransaksi<$q2->N_ttlBiaya)
        {
          $pinfselesai = null;
          //$update_status = array("id" => $row->id,"status" => "selesai & belum lunas");
        }
      elseif($q2->N_jmlTransaksi>=$q2->N_ttlBiaya)
        {
          $pinfselesai = null;
          //$update_status = array("id" => $row->id,"status" => "selesai & lunas");
        }
      }
      else{
        $pinfselesai = "diproduksi ".$q2->selesai;
        //$update_status = array("id" => $row->id,"status" => "proses");
      }
    }
    else{
      $pinfselesai = "belum diproduksi";
      //$update_status = array("id" => $row->id,"status" => "proses");
    }
    //$this->db->update('pemesanans',$update_status,array('id' => $row->id));
    if ($value!='selesai & belum lunas' && $value!='selesai & lunas'){
      return "<span title='".$pinfselesai."'>".$value." ".$q2->prosentase."</span>";
    }else{
      return $value;
    }
  }

  // callback ke function bahan baku
  public function _callback_batas_waktu_url($value, $row)
  {
    $pinfo = $this->pemesanans->get_pinfo($row->id);
    if($pinfo->limit_hari<0){$sisa_hari="Sudah lewat Tanggal Pengambilan";}
    elseif($pinfo->limit_hari==0){$sisa_hari="Hari ini";}
    else{$sisa_hari=$pinfo->limit_hari." Hari Lagi";}
    //$value = ($value!=null)?tgl_indo($value):$value;
    return"<span title='".$sisa_hari."'>".$value."</span>";
  }


 // callback UPPERCASE value jenis pemesanan
  function callback_p_prepare($post_array, $primary_key) {
    if(!empty($post_array['jenis'])){$post_array['jenis'] = strtoupper(trim($post_array['jenis']));}
    else {unset($post_array['jenis']);}
    return $post_array;
  }
//==============================================END CALLBACK===========================================

}
