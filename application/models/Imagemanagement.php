<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagemanagement extends CI_Model {

	public function getAllImages(){

		$sql = "SELECT * FROM image_gallery WHERE  deleted = 'FALSE'";
		return $this->db->query($sql)->result_array();	
	}

	public function getImages(){

		$sql = "SELECT * FROM image_gallery WHERE enabled = 'TRUE' AND deleted = 'FALSE'";
		return $this->db->query($sql)->result_array();	
	}

	public function insert_imgdata($values){

		$sql = "INSERT INTO image_gallery(name,status,enabled,deleted)VALUES".$values;
		return $this->db->query($sql);
	}

	public function toggleStatus($id,$status){

		$sql = "UPDATE image_gallery SET enabled='".$status."' WHERE id='".$id."' AND deleted='FALSE'";
		return $this->db->query($sql);
	}

	public function removeImage($id){

		$sql = "UPDATE image_gallery SET deleted='TRUE' WHERE id='".$id."'";
		return $this->db->query($sql);
	}
}
?>