<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index()
	{
		$checkuservars = $this->session->userdata;
		if(isset($checkuservars['usertype']) && $checkuservars['usertype'] == "ADMIN" && isset($checkuservars['status']) && $checkuservars['status'] == "true"){
			// echo 'ok';
			// die;
			$this->load->view('maintenance');
		}
		else{
			$data = array();
			$data['gallery'] = $this->getImages();
			$data['events'] = $this->getEvents();
			
			$this->load->view('index',$data);
			$this->session->unset_userdata('status');
		}
	}

	private function getImages(){

		$this->load->model('Imagemanagement');
		return $this->Imagemanagement->getImages();
	}

	private function getEvents(){

		$this->load->model('Eventmanagement');
		return $this->Eventmanagement->getAllImages();
	}
}
