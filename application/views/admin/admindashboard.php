	<?php include_once('header.php')?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

           <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Images</h1>
          </div>

          <div class="row">
          	<?php
          		if(isset($gallery) && count($gallery)>0){
          			foreach ($gallery as $ikey => $ivalue) {
          	?>
          	<div class="col-lg-6">
          		<!-- Dropdown Card Example -->
	         	<div class="card shadow mb-4">
		            <!-- Card Header - Dropdown -->
		            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		              <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($ivalue['name']) ? $ivalue['name'] : 'NA';?></h6>
		              <div class="dropdown no-arrow">
		                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
		                </a>
		                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		                  <div class="dropdown-header">Actions:</div>
		                  <?php
		                  	if(isset($ivalue['enabled']) && $ivalue['enabled'] == 'FALSE'){
		                  ?>
		                  <button class="dropdown-item" id="togglestatenable" onclick=window.location.href="<?php echo base_url('Admindashboard/enableimage/'.base64_encode($ivalue['id']));?>"; >Enable</button>
		                  <?php
		                  	}else{
		                  ?>
		                  <button class="dropdown-item" id="togglestatdisable" onclick=window.location.href="<?php echo base_url('Admindashboard/disableimage/'.base64_encode($ivalue['id']));?>">Disable</button>
		                  <?php
		                  	}
		                  ?>
		                  <div class="dropdown-divider"></div>
		                  <button class="dropdown-item" onclick=window.location.href="<?php echo base_url('Admindashboard/removeimage/'.base64_encode($ivalue['id']));?>">Remove</button>  
		                </div>
		              </div>
		            </div>
	            	<!-- Card Body -->
		            <div class="card-body" align="center">
		              <img src="<?php echo base_url('assets/img/gallery/'.$ivalue["name"]);?>" alt="" align="center" height="300" width="400">
		              <input type="hidden" id="imgId" value="<?php echo isset($ivalue['id']) ? $ivalue['id'] : 'NA';?>">
		            </div>
		            <!-- Card Footer -->
		            <div class="card-footer text-muted" style="text-align: center;">
    				  <?php
		              	if(isset($ivalue['deleted']) && $ivalue['deleted'] != 'TRUE'){
		              ?>
		              <span>Status: <img src="<?php echo $ivalue['enabled'] == 'TRUE' ? base_url('assets/admin/img/on.png') : base_url('assets/admin/img/off.png');?>" height="20" width="20"></span>
		              <?php
		              	}
		              ?>
  					</div>
	         	</div>
	        </div>
          	<?php
          			}
          		}
          	?>
          	
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <?php include_once('footer.php');?>