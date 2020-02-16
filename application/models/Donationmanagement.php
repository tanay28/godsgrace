<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donationmanagement extends CI_Model {

	public function insert_details($Arrdatas){

		return $this->db->insert('donation_razorpay',$Arrdatas);
	}

	public function getDonationList(){

		$sql = "SELECT * FROM donation_razorpay ORDER BY id";
		return $this->db->query($sql)->result_array();		
	}
}