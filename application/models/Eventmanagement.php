<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Eventmanagement extends CI_Model {

		public function getAllImages(){
			$sql = "SELECT * FROM event_details WHERE  status = 'ENABLED'";
			return $this->db->query($sql)->result_array();	
		}

		public function getDetails($name){

			$sql = "SELECT * FROM event_details WHERE  event_name = '".$name."' AND status = 'ENABLED'";
			return $this->db->query($sql)->result_array();	

		}

		public function save_events($Arrdatas){
			return $this->db->insert('event_details',$Arrdatas);
		}

		public function getGallery($id){

			$sql = "SELECT modified_at,image_gallery FROM event_details WHERE id='".$id."' AND status = 'ENABLED'";
			return $this->db->query($sql)->result_array();
		}

		public function removeEvent($id){
			$sql = "UPDATE event_details SET status = 'DELETED' WHERE id = '".$id."'";
			return $this->db->query($sql);
		}

		public function getCauses(){

			$sql ="SELECT * FROM cause_master ORDER BY id";
			return $this->db->query($sql)->result_array();
		}

		public function getEvent($id) {
			 $sql = "SELECT * FROM event_details WHERE id = '$id' AND status = 'ENABLED'";
			 return $this->db->query($sql)->result_array();
		}

		public function update_event($id,$arr){
			extract($arr);
			$this->db->where('id', $id);
    		return $this->db->update('event_details', $arr);
		}

		public function update_gallery($id,$arr){

			$sql = "UPDATE event_details SET image_gallery = '".$arr['image_gallery']."',modified_at='".$arr['modified_at']."' WHERE id = '".$id."'";
			return $this->db->query($sql);
		}
	}

?>