<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends MY_Controller{

  public function __construct(){
    parent::__construct();

		// only login users can access Account controller
    $this->verify_login();
    $this->load->model('karyawan_model', 'karyawans');
    $this->load->library('form_builder');
  }
  public function index(){
    $this->mViewData['user'] = $this->mUser;
    $this->mViewData['dataK'] = $this->karyawans->get_by(array('userID'=>$this->mUser->id));
  	$this->render('account');
  }

  public function setting()
  {
    // Update Info form
    $form1 = $this->form_builder->create_form($this->mModule.'account/account_update_info');
    $form1->set_rule_group('account_update_info');
    $this->mViewData['form1'] = $form1;

    // Change Password form
    $form2 = $this->form_builder->create_form($this->mModule.'account/account_change_password');
    $form1->set_rule_group('account_change_password');
    $this->mViewData['form2'] = $form2;

    $this->mPageTitle = "Account Settings";
    $this->render('account/setting');
  }

  // Submission of Update Info form
  public function account_update_info()
  {
    $data = $this->input->post();
    if ($this->ion_auth->update($this->mUser->id, $data))
    {
      $messages = $this->ion_auth->messages();
      $this->system_message->set_success($messages);
    }
    else
    {
      $errors = $this->ion_auth->errors();
      $this->system_message->set_error($errors);
    }

    redirect($this->mModule.'/account');
  }

  // Submission of Change Password form
  public function account_change_password()
  {
    $data = array('password' => $this->input->post('new_password'));
    if ($this->ion_auth->update($this->mUser->id, $data))
    {
      $messages = $this->ion_auth->messages();
      $this->system_message->set_success($messages);
    }
    else
    {
      $errors = $this->ion_auth->errors();
      $this->system_message->set_error($errors);
    }

    redirect($this->mModule.'/account');
  }

}
