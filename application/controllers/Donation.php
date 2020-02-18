<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	ini_set('upload_max_filesize', '-1');
	ini_set('max_execution_time', '1200');

	class Donation extends CI_Controller {

		public function index(){

			$checkuservars = $this->session->userdata;
			if(isset($checkuservars['usertype']) && $checkuservars['usertype'] == "ADMIN" && isset($checkuservars['status']) && $checkuservars['status'] == "true"){
				// echo 'ok';
				// die;
				$this->load->view('maintenance');
			}
			else{
				
				$this->load->view('donation');
				$this->session->unset_userdata('status');
			}
		}

		// public function donate(){

		// 	echo 'hello';
		// 	$ArrData = array();
		// 	if(isset($_POST['submit']) && $_POST['submit'] == "Donate now"){

		// 		$amount = (isset($_POST['cmbAmount']) && $_POST['cmbAmount'] == "custom") ? $_POST['txtcusamount'] : $_POST['cmbAmount'];

		// 		$ArrData = array(
		// 			'fullname' => $this->input->post('name'),
		// 			'email' => $this->input->post('email'),
		// 			'contactno' => $this->input->post('phone_number'),
		// 			'amount' => $this->input->post('totalAmount'),
		// 			'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
		// 			'dated_on' => date('y-m-d H:i:s')
		// 		);

		// 		//CREATE TABLE `ngo`.`donation_razorpay` ( `id` INT NOT NULL AUTO_INCREMENT , `fullname` VARCHAR(200) NOT NULL , `email` VARCHAR(200) NOT NULL , `contactno` BIGINT NOT NULL , `amount` DOUBLE NOT NULL , `razorpay_payment_id` VARCHAR(200) NOT NULL , `dated_on` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

		// 		$this->load->model('Donation');
		// 		$id = $this->Donation->insert_details($ArrData);
		// 		$arr = array('insert_id'=> $id,'msg' => 'Payment successfully credited', 'status' => true);
		// 	}
		// 	else{

		// 	}
		// }

		public function donate(){

			$ArrData = array();
			$ArrData = array(
				'fullname' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'contactno' => $this->input->post('phone_number'),
				'amount' => $this->input->post('totalAmount'),
				'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
				'dated_on' => date('y-m-d H:i:s')
			);
			$this->load->model('Donationmanagement');
			$id = $this->Donationmanagement->insert_details($ArrData);
			
			$arr = array('insert_id'=> $id,'msg' => 'Payment successfully credited', 'status' => true);
		}

		public function RazorThankYou(){
			$this->load->view('thankyou');
		}

		public function donateOffline(){
			$this->load->view('offlinedonationdetails');
		}

	}
?>