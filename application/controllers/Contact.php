<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends MY_Controller{

  public function __construct(){
    parent::__construct();

    // only login users can access Account controller
    //$this->verify_login();
    //$this->load->model('karyawan_model', 'karyawans');
    $this->load->library('form_builder');
  }

  public function index(){
    $form = $this->form_builder->create_form($this->mModule.'contact/comm');
    $form->set_rule_group('comm');

    $this->mViewData['form'] = $form;

    // $this->mPageTitle = "Account Settings";
    $this->render('bukutamu');
  }
    public function comm(){
    $data = array(
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'comments' => $this->input->post('comments')
      );

      $q = $this->db->insert('bukutamu',$data);
      if ($q) {
        echo "berhasil";
      } else {
        echo "gagal";
      }

    // $this->mPageTitle = "Account Settings";
    redirect($this->mModule.'/contact');
  }
}
