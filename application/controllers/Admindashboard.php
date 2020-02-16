<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('upload_max_filesize', '-1');
ini_set('max_execution_time', '1200');
class Admindashboard extends CI_Controller {

	public function index(){

		$checkuservars = $this->session->userdata;
		$data = array();
		if(isset($checkuservars['usertype']) && $checkuservars['usertype'] == "ADMIN" && isset($checkuservars['status']) && $checkuservars['status'] == "true"){

			$data['gallery'] = $this->getImages();
			$data['user'] = isset($checkuservars['useremail']) ? $checkuservars['useremail'] : "NA";
			$this->load->view('admin/admindashboard',$data);
		}else{
			$this->session->set_userdata('status','login failed..!!Please try again');
			redirect('Home');
		}
	}

	private function getImages(){
		$this->load->model('Imagemanagement');
		return $this->Imagemanagement->getAllImages();
	}

	private function image_upload($file,$type="")
	{
		if($type!='event'){
			$target_dir = $_SERVER['DOCUMENT_ROOT'].'/godsgrace/assets/img/gallery/'; //local
			//$target_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/img/gallery/'; //server
		}else{
			$target_dir = $_SERVER['DOCUMENT_ROOT'].'/godsgrace/assets/img/egallery/'; // local
			//$target_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/img/egallery/'; // server
		}
		if(isset($file["name"]) && $file["name"] !=""){
			
			$target_file = $target_dir . basename($file["name"]);
			
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if file already exists
			if (file_exists($target_file)) {
				$uploadOk = 0;
				unlink($target_file);
			    //return array('status' => 'error', 'msg' => 'Sorry, file already exists.');
			}

			// // Check file size
			// if ($file["size"] > 2048000)
			// {
			//     $uploadOk = 0;
			//     return array('status' =>'error','msg'=> 'Sorry, your file is too large.');
			// }

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "JPG")
			{
			    $uploadOk = 0;
			 	return array('status' => 'error', 'msg' => 'Please upload .jpg or .png or .jpeg files'); 
			} 
			else
			{

			    if (move_uploaded_file($file["tmp_name"], $target_file))
			    {
			        return array('status' => 'success','file_name' => basename( $file["name"]));
			    }
			    else
			    {
			        return array('status' => 'error', 'msg' => 'Sorry, there was an error uploading your file.');
			    }
			}
		}
	}

	public function add() {

		$checkuservars = $this->session->userdata;

		if(!isset($checkuservars['usertype']) && $checkuservars['usertype'] != "ADMIN" && !isset($checkuservars['status']) && $checkuservars['status'] != "true"){

			$this->session->set_userdata('status','Something went wrong..!!Please try again');
			redirect('Home');
		}

		if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] !=""){

			$filePicGall = $_FILES['filePicGall'];
			$ArrPicName = array();
			if(isset($filePicGall) && count($filePicGall)>0)
			{
				foreach($filePicGall['name'] AS $ikey => $ivalue){

					$arr_pic['name'] = $ivalue;
					$arr_pic['type'] = isset($filePicGall['type'][$ikey]) ? $filePicGall['type'][$ikey] : '';
					$arr_pic['tmp_name'] = isset($filePicGall['tmp_name'][$ikey]) ? $filePicGall['tmp_name'][$ikey] : '';
					$arr_pic['error'] = isset($filePicGall['error'][$ikey]) ? $filePicGall['error'][$ikey] : '';
					$arr_pic['size'] = isset($filePicGall['size'][$ikey]) ? $filePicGall['size'][$ikey] : '';
					$arr_pic['size'] = isset($filePicGall['size'][$ikey]) ? $filePicGall['size'][$ikey] : '';
					$Pic_name = $this->image_upload($arr_pic);
					array_push($ArrPicName,$ivalue);		
				}
			}
			$values = '';
			if(isset($ArrPicName) && count($ArrPicName)>0){
				foreach ($ArrPicName as $ikey => $ivalue) {
					$values .="('".$ivalue."','DYNAMIC','TRUE','FALSE'),";
				}

				$values = trim(rtrim($values,','));
				$this->load->model('Imagemanagement');
				$status = $this->Imagemanagement->insert_imgdata($values);
				if($status){
					redirect('admindashboard/index');
				}
			}
		}else{
			$checkuservars = $this->session->userdata;
			$data['user'] = isset($checkuservars['useremail']) ? $checkuservars['useremail'] : "NA";
			$this->load->view('admin/addimages',$data);
		}
	}
	public function Logout()
    {
    	$checkuservars = $this->session->userdata;
    	$this->load->model('Usermanagement');
    	if(isset($checkuservars['useremail'])){
    		$id = $this->Usermanagement->update_logoutDetails($checkuservars['useremail']);
    	}
        $this->session->sess_destroy();
        $this->load->view('logout');
    }

    public function disableimage() {

    	if($this->uri->segment(3) != ''){

    		$id = base64_decode($this->uri->segment(3));
    		$this->load->model('Imagemanagement');
    		$status = $this->Imagemanagement->toggleStatus($id,'FALSE');
    		if($status){
    			redirect('admindashboard/index');
    		}
    	}
    }

    public function enableimage() {

    	if($this->uri->segment(3) != ''){

    		$id = base64_decode($this->uri->segment(3));
    		$this->load->model('Imagemanagement');
    		$status = $this->Imagemanagement->toggleStatus($id,'TRUE');
    		if($status){
    			redirect('admindashboard/index');
    		}
    	}
    }

    public function removeimage() {

    	if($this->uri->segment(3) != ''){

    		$id = base64_decode($this->uri->segment(3));
    		$this->load->model('Imagemanagement');
    		$status = $this->Imagemanagement->removeimage($id);
    		if($status){
    			redirect('admindashboard/index');
    		}
    	}
    }
    private function event_gallery($filePicGall){

		$ArrPicName = array();
		if(isset($filePicGall) && count($filePicGall)>0)
		{
			foreach($filePicGall['name'] AS $ikey => $ivalue){

				$arr_pic['name'] = $ivalue;
				$arr_pic['type'] = isset($filePicGall['type'][$ikey]) ? $filePicGall['type'][$ikey] : '';
				$arr_pic['tmp_name'] = isset($filePicGall['tmp_name'][$ikey]) ? $filePicGall['tmp_name'][$ikey] : '';
				$arr_pic['error'] = isset($filePicGall['error'][$ikey]) ? $filePicGall['error'][$ikey] : '';
				$arr_pic['size'] = isset($filePicGall['size'][$ikey]) ? $filePicGall['size'][$ikey] : '';
				$arr_pic['size'] = isset($filePicGall['size'][$ikey]) ? $filePicGall['size'][$ikey] : '';
				$Pic_name = $this->image_upload($arr_pic,'event');
				
				array_push($ArrPicName,$ivalue);		
			}
		}
		return $ArrPicName;
    }
    public function addEvent(){
    	
    	$checkuservars = $this->session->userdata;

		if(!isset($checkuservars['usertype']) && $checkuservars['usertype'] != "ADMIN" && !isset($checkuservars['status']) && $checkuservars['status'] != "true"){

			$this->session->set_userdata('status','Something went wrong..!!Please try again');
			redirect('Home');
		}

		if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] !=""){
			
			//-------------- Upload Single File --------------//
			$event_File = isset($_FILES['eventfile']) ? $_FILES['eventfile'] : "NA";
			
			$arr_pic['name'] = isset($event_File['name']) ? $event_File['name'] : "NA"; 
			$arr_pic['type'] = isset($event_File['type']) ? $event_File['type'] : 'NA';
			$arr_pic['tmp_name'] = isset($event_File['tmp_name']) ? $event_File['tmp_name'] : 'NA';
			$arr_pic['error'] = isset($event_File['error']) ? $event_File['error'] : 'NA';
			$arr_pic['size'] = isset($event_File['size']) ? $event_File['size'] : 'NA';
			$arr_pic['size'] = isset($event_File['size']) ? $event_File['size'] : 'NA';

			$Pic_name = $this->image_upload($arr_pic,'event');
			
			//---------------------- END --------------------//

			//---------------- Upload galley ---------------//
			$ArrGallery = array();
			
			if(isset($_FILES['filePicGall'])){
				$ArrGallery = $this->event_gallery($_FILES['filePicGall']);
			}
			//---------------------- END ------------------//
			
			//--------- Validate data from post -----------//
			$event_name = isset($_POST['txtname']) ? $_POST['txtname'] : "NA";
			$event_details = isset($_POST['txteventdetails']) ? $_POST['txteventdetails'] : "NA";
			$des = isset($_POST['txtdes']) ? $_POST['txtdes'] : "NA";
			$location = isset($_POST['txtlocation']) ? $_POST['txtlocation'] : "NA";
			$start = isset($_POST['txtStart']) ? date('Y-m-d H:i:s',strtotime($_POST['txtStart'])) : "NA";
			$end = isset($_POST['txtEnd']) ? date('Y-m-d H:i:s',strtotime($_POST['txtEnd'])) : "NA";
			$picname = isset($Pic_name['file_name']) ? $Pic_name['file_name'] : 'NA'; 
			$gallery = (isset($ArrGallery) && count($ArrGallery)>0) ? json_encode($ArrGallery) : ""; 
			//------------------ END ----------------------//

			//-------- Prepare data for DB insert ---------//
			$Arrdatas = array(
				'event_name'    => $event_name,
				'event_details' => $event_details,
				'description'   => $des,
				'pic_name'      => $picname,
				'start_at'      => $start,
				'end_at'        => $end,
				'location'      => $location,
				'image_gallery' => $gallery,
				'modified_at'   => Date('Y-m-d H:i:s'),
				'status'        => 'ENABLED'
			);
			//------------------- END --------------------//
			$this->load->model('Eventmanagement');
			$id = $this->Eventmanagement->save_events($Arrdatas);
			redirect('admindashboard/ViewEvent');
		}else{
			
			$data['user'] = isset($checkuservars['useremail']) ? $checkuservars['useremail'] : "NA";
			$this->load->model('Eventmanagement');
			$data['causes'] = $this->Eventmanagement->getCauses();
			$this->load->view('admin/addevent',$data);
		}
    }

    public function ViewEvent(){
    	
    	$data = array();
    	$checkuservars = $this->session->userdata;
    	$this->load->model('Eventmanagement');
    	$data['events'] = $this->Eventmanagement->getAllImages();
    	
    	if($this->uri->segment(3)!=''){

    		$id = base64_decode($this->uri->segment(3));
    		$dt = $this->Eventmanagement->getGallery($id);
    		
    		$data['gallery'] = json_decode($dt[0]['image_gallery'],true);
    		$data['modified_at'] = isset($dt[0]['modified_at']) ? date('d-M-Y D H:i',strtotime($dt[0]['modified_at'])) : "0000-00-00 00:00:";
    		$data['id'] = $id;
    	}
    	
    	
    	$data['user'] = isset($checkuservars['useremail']) ? $checkuservars['useremail'] : "NA";
    	
    	$this->load->view('admin/viewevent',$data);
    }

    public function removeEvent(){

    	$data = array();

    	$checkuservars = $this->session->userdata;
    	$this->load->model('Eventmanagement');
    	if($this->uri->segment(3)!=''){
    		$id = base64_decode($this->uri->segment(3));

    		$dt = $this->Eventmanagement->removeEvent($id);	
    		// var_dump($dt);
    		// die;	
    	}
    	redirect('admindashboard/ViewEvent');
    }

    public function editEvent(){
    	$data = array();
    	$checkuservars = $this->session->userdata;
    	if(!isset($checkuservars['usertype']) && $checkuservars['usertype'] != "ADMIN" && !isset($checkuservars['status']) && $checkuservars['status'] != "true"){

			$this->session->set_userdata('status','Something went wrong..!!Please try again');
			redirect('Home');
		}


		$data['user'] = $checkuservars['useremail'];
	    $this->load->model('Eventmanagement');
	    $data['causes'] = $this->Eventmanagement->getCauses();
		if(isset($_POST['btnSubmit']) && $_POST['btnSubmit']!=""){

			//-------------- Upload Single File --------------//
			$event_File = isset($_FILES['eventfile']) ? $_FILES['eventfile'] : "NA";
			$Pic_name = "";
			if(isset($event_File['name']) && $event_File['name'] != ""){
				$arr_pic['name'] = isset($event_File['name']) ? $event_File['name'] : "NA"; 
				$arr_pic['type'] = isset($event_File['type']) ? $event_File['type'] : 'NA';
				$arr_pic['tmp_name'] = isset($event_File['tmp_name']) ? $event_File['tmp_name'] : 'NA';
				$arr_pic['error'] = isset($event_File['error']) ? $event_File['error'] : 'NA';
				$arr_pic['size'] = isset($event_File['size']) ? $event_File['size'] : 'NA';
				$arr_pic['size'] = isset($event_File['size']) ? $event_File['size'] : 'NA';

				$Pic_name = $this->image_upload($arr_pic,'event');
			}
			//---------------------- END --------------------//

			//------- Get existing Images from gallery --------//
			$gallArr = array();
			$id = $_POST['btnSubmit'];
			$rs = $this->Eventmanagement->getGallery($id);
			$gallArr = isset($rs[0]['image_gallery']) ? json_decode($rs[0]['image_gallery'],true) : array(); 
			// echo '<pre>';
			// var_dump($gallArr);
			// die;
			//-------------------- END -----------------------//

			//---------------- Upload galley ---------------//
			$ArrGallery = array();

			if(isset($_FILES['filePicGall'])){
				$ArrGallery = $this->event_gallery($_FILES['filePicGall']);

				foreach ($ArrGallery as $ikey => $ivalue)
				{
					if(!in_array($ivalue, $gallArr)){
						array_push($gallArr, $ivalue);
					}
				}
			}
			//---------------------- END ------------------//

			//--------- Validate data from post -----------//
			$event_name = isset($_POST['txtname']) ? $_POST['txtname'] : "NA";
			$event_details = isset($_POST['txteventdetails']) ? $_POST['txteventdetails'] : "NA";
			$des = isset($_POST['txtdes']) ? $_POST['txtdes'] : "NA";
			$location = isset($_POST['txtlocation']) ? $_POST['txtlocation'] : "NA";
			$start = isset($_POST['txtStart']) ? date('Y-m-d H:i:s',strtotime($_POST['txtStart'])) : "NA";
			$end = isset($_POST['txtEnd']) ? date('Y-m-d H:i:s',strtotime($_POST['txtEnd'])) : "NA";
			$picname = isset($Pic_name['file_name']) ? $Pic_name['file_name'] : 'NA'; 
			$gallery = (isset($gallArr) && count($gallArr)>0 ) ? json_encode($gallArr) : "NA"; 
			//------------------ END ----------------------//


			//-------- Prepare data for DB update ---------//
			$Arrdatas = array();
			if($picname!="NA" && $gallery!="NA"){

				$Arrdatas = array(
					'event_name'    => $event_name,
					'event_details' => $event_details,
					'description'   => $des,
					'pic_name'      => $picname,
					'start_at'      => $start,
					'end_at'        => $end,
					'location'      => $location,
					'image_gallery' => $gallery,
					'modified_at'   => Date('Y-m-d H:i:s')
				);
			}elseif($picname!="NA"){
				$Arrdatas = array(
					'event_name'    => $event_name,
					'event_details' => $event_details,
					'description'   => $des,
					'pic_name'      => $picname,
					'start_at'      => $start,
					'end_at'        => $end,
					'location'      => $location,
					'modified_at'   => Date('Y-m-d H:i:s')
				);
			}elseif($gallery!="NA"){
				$Arrdatas = array(
					'event_name'    => $event_name,
					'event_details' => $event_details,
					'description'   => $des,
					'image_gallery' => $gallery,
					'start_at'      => $start,
					'end_at'        => $end,
					'location'      => $location,
					'modified_at'   => Date('Y-m-d H:i:s')
				);
			}else{
				$Arrdatas = array(
					'event_name'    => $event_name,
					'event_details' => $event_details,
					'description'   => $des,
					'start_at'      => $start,
					'end_at'        => $end,
					'location'      => $location,
					'modified_at'   => Date('Y-m-d H:i:s')
				);
			}

			//------------------- END --------------------//
			
			//------------ Get ID from POST --------------//
			$id = $_POST['btnSubmit'];
	    	$res = $this->Eventmanagement->update_event($id,$Arrdatas);
	 
			//------------------- END ------------------//

			redirect('admindashboard/ViewEvent');
		}else{
	    	if($this->uri->segment(3)!=''){
	    		$id = base64_decode($this->uri->segment(3));
	    		$data['event'] = $this->Eventmanagement->getEvent($id);
	    	}

	    	$this->load->view('admin/editevent',$data);
	    }
    }

    public function remove_img_from_gallery(){

    	if($this->uri->segment(3)!="" && $this->uri->segment(4)!=""){
    		$id = base64_decode($this->uri->segment(3));
    		$img_name = base64_decode($this->uri->segment(4));
    		
    		$this->load->model('Eventmanagement');
    		$rs = $this->Eventmanagement->getGallery($id);
    		$arr = array();
    		$arr = isset($rs[0]['image_gallery']) ?  json_decode($rs[0]['image_gallery'],true) : array();
    		$newArr = array();
    		//------- Modify gallery images ----------//
    		if(in_array($img_name,$arr)){
    			foreach ($arr as $ikey => $ivalue){
    				if($img_name!=$ivalue){
    					array_push($newArr, $ivalue);	
    				}
    			}	
    		}
    		//----------------- END ----------------//

    		//-------- Prepare data for -----------//
    		$dataArr = array();
    		$dataArr = array(
    			'image_gallery' => json_encode($newArr),
    			'modified_at'   => date('Y-m-d H:i:s')
    		);
    		//---------------- END ---------------//
    		$res = $this->Eventmanagement->update_gallery($id,$dataArr);
    		redirect('Admindashboard/ViewEvent');
    	}else{
    		echo 'error';
    	}
    }

    public function donationDetails(){

    	$checkuservars = $this->session->userdata;
    	$data['user'] = isset($checkuservars['useremail']) ? $checkuservars['useremail'] : "NA";
    	$this->load->model('Donationmanagement');
    	$data['donation'] = $this->Donationmanagement->getDonationList();
    	$this->load->view('admin/donationlist',$data);
    }
}
?>