<?php include_once('header.php')?>
	<div class="container-fluid">

	   <!-- Page Heading -->
	  <div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">List of Events</h1>
	  </div>
	  <div class="row">
	  	<div class="col">
	  		<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Event Name</th>
			      <th scope="col">Event Details</th>
			      <th scope="col">Description</th>
			      <th scope="col">Started at</th>
			      <th scope="col">Finished at</th>
			      <th scope="col">Location</th>
			      <th scope="col">Header Image</th>
			      <th scope="col">View Image Gallery</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  		if(isset($events) && count($events)>0){
			  			$ct = 0;
			  			foreach ($events as $ikey => $ivalue) {
			  	?>
			    <tr>
			      <th scope="row"><?php echo $ct+1; ?></th>
			      <td><?php echo isset($ivalue['event_name']) ? $ivalue['event_name'] : 'NA';  ?></td>
			      <td><?php echo isset($ivalue['event_details']) ? $ivalue['event_details'] : 'NA';  ?></td>
			      <td><?php echo isset($ivalue['description']) ? $ivalue['description'] : 'NA';  ?></td>
			      <td><?php echo isset($ivalue['start_at']) ? $ivalue['start_at'] : 'NA';  ?></td>
			      <td><?php echo isset($ivalue['end_at']) ? $ivalue['end_at'] : 'NA';  ?></td>
			      <td><?php echo isset($ivalue['location']) ? $ivalue['location'] : 'NA';  ?></td>
			      <td><img src="<?php echo base_url('assets/img/egallery/'.$ivalue['pic_name']); ?>" height="50px" width="70px"  alt="No image"/ ></td>
			      
			      <?php if($ivalue['image_gallery']!=""){?> 
			      <td><a id="gclick" href="<?php echo base_url('admindashboard/ViewEvent/'.base64_encode($ivalue['id']));?>">Click</a></td>
			     <?php }else{?>
			     <td><a href="javascript:void()">NA</a></td>
			     <?php } ?>

			      <td> 
			      	<a id="gclick" href="<?php echo base_url('admindashboard/editEvent/'.base64_encode($ivalue['id']));?>"><i class="fa fa-edit"></i></a> |  
			      	
			      	<a id="gclick" href="<?php echo base_url('admindashboard/removeEvent/'.base64_encode($ivalue['id']));?>"><i class="fa fa-trash"></i></a>
			      </td>
			    </tr>
			    <?php
			    	$ct++;}
			    } 
			    ?>
			  </tbody>
			</table>
	  	</div>
	  </div>
	  <hr/>
	  <div class="row" id="gheading" style="display: none">
	  	<div class="col">
	  		<div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-top: 25px;">
         	<h1 class="h3 mb-0 text-gray-800">Image Gallery</h1>
      		</div>
	  	</div>
	  </div>
	  <div class="row" id="gallery" style="display: none">
	  	<?php
	  		if(isset($gallery) && count($gallery)>0){
	  			foreach ($gallery as $ikey => $img_name){
	  	?>
	  	<div class="col-lg-6">
	  		<div class="card mb-3">
			  <img src="<?php echo base_url('assets/img/egallery/'.$img_name);?>" class="card-img-top" alt="..." >
			  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		            <div class="dropdown no-arrow">
		                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
		                </a>
		                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		                  <!-- <div class="dropdown-header">Actions:</div>
		                  <button class="dropdown-item" id="togglestatenable">Enable</button>
		                  <button class="dropdown-item" id="togglestatdisable">Disable</button>
		                  <div class="dropdown-divider"></div> -->
		                  <button class="dropdown-item" onclick=window.location.href="<?php echo base_url('admindashboard/remove_img_from_gallery/'.base64_encode($id)).'/'.base64_encode($img_name);?>">Remove</button>  
		                </div>
		            </div>
		      </div>
			  <div class="card-body">
			    <h5 class="card-title"><?php echo $img_name;?></h5>
			    <p class="card-text"><small class="text-muted">Last updated at <?php echo $modified_at;?></small></p>
			  </div>
			</div>
	  	</div>
	  	<?php
	  		}
	  	}
	  	?>
	  </div>
	  
	 
</div>
<?php include_once('footer.php');?>
<script type="text/javascript">
	$(document).ready(function(){
		// $("#gclick").on('click',function(){
		// 	alert('gotta');
		// 	// $('#gheading').show('slow');
		// 	// $('#gallery').show('slow');
		// });
		<?php if(isset($gallery) && count($gallery)>0){?>
			$('#gheading').show('slow');
			$('#gallery').show('slow');
		<?php }else{?>
			$('#gheading').hide('slow');
			$('#gallery').hide('slow');
		<?php }?>
	});
</script>