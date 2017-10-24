<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_builder');
    $this->load->model('karyawan_model','mKaryawan');
  }

  // Frontend User CRUD
  public function index(){
    try{
      $crud =$this
       ->generate_crud('karyawan')
       ->set_subject('Karyawan')
       ->set_relation('id_departemen','departemen','nama_departemen')
       ->set_relation('id_jabatan','jabatan','nama_jabatan')
       ->add_fields('first_name','last_name','jenis_kelamin','tempat_lahir','tgl_lahir','agama','alamat','status','email','phone','no_rekening','npwp','foto','id_departemen','id_jabatan','status_pegawai','masa_kerja')
       ->edit_fields('first_name','last_name','jenis_kelamin','tempat_lahir','tgl_lahir','agama','alamat','status','email','phone','no_rekening','npwp','foto','id_departemen','id_jabatan','status_pegawai','masa_kerja')
       ->unique_fields('phone','email')
       ->required_fields('first_name','jenis_kelamin','tempat_lahir','tgl_lahir','agama','alamat','departemen','jabatan','email','alamat','phone','status_pegawai')
       ->set_rules('phone','Telepon / HP','required|integer')
       ->set_field_upload('foto', UPLOAD_FOTO_KARYAWAN)
       ->callback_after_insert(array($this,'add_user_login'))
       ->display_as('phone','Telepon / HP')
       ->display_as('id_jabatan','Jabatan')
       ->display_as('id_departemen','Departemen')
       ->display_as('first_name','Nama Depan')
       ->display_as('last_name','Nama Belakang')
       ->unset_texteditor('alamat')
       ->unset_list()
      ;
      $this->mPageTitle = 'Karyawan';
      $this->render_crud();
    } catch(Exception $e){
      if ($e->getCode()==14){redirect($this->mModule.'/'.strtolower(__CLASS__).'/lists','refresh');}
      else{show_error($e->getMessage());}
    }
  }

    public function lists()
  {
    try{
    $crud =$this->generate_crud('vkaryawan');
    if($crud->getState()=='delete'){$crud = $this->generate_crud('karyawan');}
    $crud->set_primary_key('id')
     ->set_subject('Karyawan')

     ->columns('full_name','jenis_kelamin','nama_departemen','nama_jabatan','active')
     //->set_relation('id_departemen','departemen','nama_departemen')
     //->set_relation('id_jabatan','jabatan','nama_jabatan')
     ->order_by('first_name')

     //->unique_fields('phone','email')
     //->required_fields('first_name','jenis_kelamin','tempat_lahir','tgl_lahir','agama','alamat','departemen','jabatan','email','alamat','phone','status_pegawai')
     //->set_rules('phone','Telepon / HP','required|integer')
     ->set_field_upload('foto', UPLOAD_FOTO_KARYAWAN)

     ->callback_column('active',array($this,'_callback_activate_url'))
     //->callback_column('first_name',array($this,'_callback_knama_url'))

     ->add_action('Ubah Karyawan', '', 'admin/karyawan/index/edit', 'edit-icon')
     //->add_action('Aktivitas Hari Ini', '', 'admin/karyawan/today_activity', 'fa fa-calendar-check-o')
     ->add_action('Jenjang Karir', '', 'admin/karyawan/jenjang_karir', 'fa fa-list')

     ->display_as('phone','Telepon / HP')
     ->display_as('nama_jabatan','Jabatan')
     ->display_as('nama_departemen','Departemen')
     ->display_as('first_name','Nama Depan')
     ->display_as('last_name','Nama Belakang')
     ->unset_texteditor('alamat')
     ->unset_export()
     ->unset_edit()
     ->unset_print()
     ->unset_read_fields('id','active','id_jabatan','id_departemen')
    ;
    //if($crud->getState()=='read'){$crud->callback_read_field('first_name',array($this,'_callback_knama_url'));}
    if ($this->ion_auth->in_group(array('webmaster'))){$crud->add_action('Reset Password', '', 'admin/user/reset_password', 'fa fa-repeat');}
    if ($this->ion_auth->in_group(array('admin','hrd','keuangan'))){
      $crud->unset_delete();
    }
    if($crud->getState()=='add'){redirect('admin/karyawan/index/add');}

    //$crud->edit_fields('first_name','last_name','jenis_kelamin','tempat_lahir','tgl_lahir','agama','alamat','status','email','phone','no_rekening','npwp','foto','id_departemen','id_jabatan','status_pegawai','masa_kerja');
    //$this->unset_crud_fields('id','active');
    $this->mPageTitle = 'Karyawan';
    $this->add_script('assets/js/admin.js', TRUE);
    //$this->render_crud();

    $this->load->library('Grocery_crud_categories');
    $config = array(
      'table_name'=>'vkaryawan',
      'related_table'=>'vkaryawan',
      'sort_field'=>'status_pegawai',
      'categories_primary_key'=>'status_pegawai',
      'related_title_field'=>'status_pegawai',
      'order_by'=>'first_name DESC',

      'first_url' => base_url().'admin/'.strtolower(__CLASS__).'/'.__FUNCTION__,
      'segment_name' => 'filter_karyawan',
      'style' => 'height:24px; width: 150px;',
      'text'=>array('all_rows'=>'Filter Karyawan')
    );

    $categories = new grocery_crud_categories($crud,$config);
    $dropdown = $categories->get_dropdown();

    $output = $this->mCrud->render();
    if($crud->getState()=='list'){$this->mViewData['crud_output'] = $output->output.$dropdown;}
    else{$this->mViewData['crud_output'] = $output->output;}

    $this->add_stylesheet($output->css_files, FALSE);
    $this->add_script($output->js_files, TRUE, 'head');
    $this->render('crud');
    } catch(Exception $e){
      if ($e->getCode()==14){redirect($this->mModule.'/'.strtolower(__CLASS__).'/lists','refresh');}
      else{show_error($e->getMessage());}
    }
  }

  public function today_activity($karyawan_id)
  {
    try{
      $crud = $this->generate_crud('vap_today');
      $crud->set_primary_key('id');
      $crud->set_subject('Aktivitas Produksi');
      $crud->columns('pemesanan_id','selesai','N_upah');
      $crud->set_relation('pemesanan_id','pemesanans','({kode_pesanan}) {jenis}');
      $crud->where('karyawan_id',$karyawan_id);
      $crud->where('tgl_produksi',date("Y-m-d",now()));
      $crud->unset_operations();
      $this->mPageTitle = 'Aktivitas hari ini';
      $this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali', 'karyawan', 'fa fa-reply', 'bg-purple');
      $this->render_crud();
      }catch(Exception $e){
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }

  public function jenjang_karir($karyawan_id)
  {
    try{
      $kinfo = $this->mKaryawan->get_by(array('id'=>$karyawan_id));
      $crud = $this->generate_crud('jenjang_karir');
      $crud->set_primary_key('id','jenjang_karir');
      $crud->set_subject('Jenjang Karir');
      $crud->columns('tanggal','id_jabatan','keterangan');
      $crud->set_relation('id_jabatan','jabatan','nama_jabatan');
      $crud->where('nip',$karyawan_id);
      $crud->add_fields('tanggal','nip','id_jabatan','keterangan');
      $crud->edit_fields('nip','id_jabatan','keterangan');
      if($crud->getState()=='add' || $crud->getState()=='insert' || $crud->getState()=='insert_validation'){
      $crud->field_type('nip', 'hidden', $kinfo->id);
      $crud->field_type('tanggal', 'hidden', date("Y-m-d",now()));
      }elseif($crud->getState()=='edit' || $crud->getState()=='update' || $crud->getState()=='update_validation'){
      $crud->set_relation('nip','karyawan','({id}) {first_name} {last_name}');
      $crud->field_type('nip', 'readonly');
      }elseif($crud->getState()=='success' || $crud->getState()=='list'){
      //$crud->set_relation('nip','karyawan','({id}) {first_name} {last_name}');
      }
      $crud->display_as('id_jabatan','Jabatan')
      ->display_as('nip','Karyawan');
      //$crud->where('tgl_produksi',date("Y-m-d",now()));
      //$crud->unset_operations();
      $crud->unset_add();
      $crud->unset_read();
      //$crud->unset_read();
      $this->mPageTitle = 'Jenjang Karir ('.$kinfo->id.') '.$kinfo->first_name;
      $this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Kembali', 'karyawan', 'fa fa-reply', 'bg-purple');
      $this->render_crud();
      }catch(Exception $e){
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }

  // tampilkan nama depan dan nama balekang
  // public function _callback_knama_url($value, $row)
  // {
  //   return $value." ".$row->last_name;
  // }
    // callback ke activate
  public function _callback_activate_url($value, $row)
  {
    //return ($value==1) ? anchor("admin/karyawan/activate_k/".$row->id, 'Active', array('title' => 'klik untuk ubah menjadi inactive')) : anchor("admin/karyawan/activate_k/".$row->id, 'Inactive',array('title' => 'klik untuk ubah menjadi active'));
    $html = '<a name="record_'.$row->id.'">&nbsp;</a>';
        $target = site_url($this->mModule .'/'.strtolower(__CLASS__).'/activate_k/' . $row->id);
        if ($value == 0) {
            $html .= '<span target="' . $target . '" class="navigation_active">Inactive</span>';
        } else {
            $html .= '<span target="' . $target . '" class="navigation_active">Active</span>';
        }
        return $html;
  }

  public function activate_k($id)
  {
    if ($this->input->is_ajax_request()) {
    $this->db->select('active')->from('karyawan')->where('id', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $row       = $query->row();
      $new_value = ($row->active == 0) ? 1 : 0;
      $this->db->update('karyawan', array('active' => $new_value), array('id' => $id));
      $this->render_json(array('success' => true));
    }else{
      $this->render_json(array('success' => false));
    }
    //redirect("admin/karyawan", 'refresh');
    }
  }

function add_user_login($post_array, $primary_key) {
  $username = $post_array['first_name'];
  $email = $post_array['email'];
  $password = $post_array['phone'];
  $additional_data = array(
    'first_name'  => $post_array['first_name'],
    'last_name'   => $post_array['last_name'],
  );
  $groups = '1';

  $this->ion_auth_model->tables = array(
    'users'       => 'users',
    'groups'      => 'groups',
    'users_groups'    => 'users_groups',
    'login_attempts'  => 'login_attempts',
  );
  $user = $this->ion_auth->register($username, $password, $email, $additional_data, $groups);
  if ($user)
  {
    // success
    $messages = $this->ion_auth->messages();
    $this->system_message->set_success($messages);
  }
  else
  {
    // failed
    $errors = $this->ion_auth->errors();
    $this->system_message->set_error($errors);
  }
    //$groups = $this->ion_auth->groups()->result();

    // if(!empty($post_array['jenis'])){$post_array['jenis'] = strtoupper(trim($post_array['jenis']));}
    // else {unset($post_array['jenis']);}
    return true;
  }

}
