<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index()
	{
		$data = array();
		$this->session->unset_userdata('status');
		if(isset($_POST['txtEmail']) && isset($_POST['txtPassword']))
		{
			$this->load->model('Usermanagement');
			$res = $this->Usermanagement->validateLogin($_POST['txtEmail'],$_POST['txtPassword']);
			// var_dump($res);	
			// die;
			if(is_object($res))
			{
				$currentUser = array(
					'status'       => 'true',
					'userid'       => $res->id,
             		'useremail'    => $res->email,
             		'usertype'     => $res->userstype,
             		'is_logged_in' => 1
             	);
            	$this->session->set_userdata($currentUser);

            	$loginData = array(
            		'email'     => $res->email,
            		'user_id'   => $res->id,
            		'login_at'  => date('y-m-d H:i:s'),
            		'logout_at' => '0000-00-00 00:00:00'
            	);

            	$this->load->model('Usermanagement');
            	$id = $this->Usermanagement->insert_logindata($loginData);
            	redirect('Admindashboard');
				
			}else{
				$this->session->set_userdata('status','Invalid user credentials..!!');
				redirect('Home');
			}
		}else{
			$this->session->set_userdata('status','Internal server error..!! Please try again later.');
			redirect('Home');
		}

	}
}
