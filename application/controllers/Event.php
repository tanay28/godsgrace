<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	// public function getDetails(){

	// 	$data = array();

	// 	if($this->uri->segment(3) != ''){

	// 		$id = base64_decode($this->uri->segment(3));
			
	// 		$this->load->model('Eventmanagement');
	// 		$data['event_details'] = $this->Eventmanagement->getDetails($id);
	// 		$data['gallery'] = $this->getImages();
			
	// 		$this->load->view('event',$data);

	// 	}else{
	// 		echo 'error';
	// 	}
	// }

	private function getImages(){

		$this->load->model('Imagemanagement');
		return $this->Imagemanagement->getImages();
	}

	public function getCauseDeatils(){

		if($this->uri->segment(3) != ''){
			$cause = base64_decode($this->uri->segment(3));
			$this->load->model('Eventmanagement');
			$data['event_details'] = $this->Eventmanagement->getDetails($cause);
			$data['gallery'] = $this->getImages();
			$data['event_name'] = $cause;
			
			$this->load->view('event',$data);
		}
	}
}
