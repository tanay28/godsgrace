<?php include_once('header.php')?>
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.datetimepicker.css');?>">	
	 <!-- Begin Page Content -->
        <div class="container-fluid">

           <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Event</h1>
          </div>
          <div class="row">
          	<div class="col-8">
          		<form name="frmAdd" method="POST" enctype='multipart/form-data' action="<?php echo base_url('Admindashboard/editEvent');?>">

					<div class="form-group">
					    <label for="name">Cause name</label>
					    <!-- <input type="text" class="form-control" id="name" name="txtname" required=""> -->
					    <select class="form-control" name="txtname" required="">
					    	<?php
					    		if(isset($causes) && count($causes)>0){

					    			foreach ($causes as $ikey => $causename) {

					    				if(isset($event[0]['event_name']) && $event[0]['event_name']!="" && $event[0]['event_name'] == $causename['name']){
					    	?>
					    	<option value="<?php echo $causename['name'];?>" selected>
					    		<?php echo $causename['name']; ?>
					    	</option>
					    	<?php
					    		}else{
					    	?>
					    	<option value="<?php echo $causename['name'];?>">
					    		<?php echo $causename['name'];?>
					    	</option>
					    	<?php
					    				}
					    			}
					    		}
					    	?>
					    </select>
					</div>

					<div class="form-group">
					    <label for="details">Event details</label>
					    <input type="text" class="form-control" id="details" name="txteventdetails" required="" value="<?php echo isset($event[0]['event_details']) ? $event[0]['event_details'] : "NA";?>">
					</div>

					<div class="form-group">
					    <label for="des">Event description</label>
					    <textarea class="form-control" name="txtdes" id="des" required=""><?php echo isset($event[0]['description']) ? $event[0]['description'] : "NA";?></textarea>
					</div>

					<div class="form-group">
					    <label for="location">Event location</label>
					    <textarea class="form-control" name="txtlocation" id="location" required=""><?php echo isset($event[0]['location']) ? $event[0]['location'] : "NA";?></textarea>
					</div>

					<div class="form-group">
						<label for="datetimepicker1">Started at</label>
						<input type="text" value="<?php echo isset($event[0]['start_at']) ? $event[0]['start_at'] : "NA";?>" name="txtStart" required="" class="form-control" id="datetimepicker1"/>
					</div>

					<div class="form-group">
						<label for="datetimepicker2">Ended at</label>
						<input type="text" value="<?php echo isset($event[0]['end_at']) ? $event[0]['end_at'] : "NA";?>" name="txtEnd" required="" class="form-control" id="datetimepicker2"/>
					</div>
					
					<div class="form-group">
					    <label for="file">Event image</label>
					    <img src="<?php echo base_url('assets/img/egallery/'.$event[0]['pic_name']);?>" height="160px" width="250px">
					</div>					

					<div class="form-group">
					    <label for="file">Want to change above image : &nbsp;</label>
					    <label class="radio-inline">
					    	<input type="radio" name="optradio" value="yes" id="optradioyes"> Yes
					    </label>&nbsp;
						<label class="radio-inline">
							<input type="radio" name="optradio" value="no" id="optradiono" checked=""> No
						</label>
					</div>
					<div class="form-group" id="mul_image" style="display: none">
						<label for="file">Event image</label>
						<input type="file" class="form-control" id="file" name="eventfile">
					</div>
					<div class="form-group">
					    <label for="file">Want to update image gallery : &nbsp;</label>
					    <label class="radio-inline">
					    	<input type="radio" name="optradio1" value="yes" id="optradioyes1"> Yes
					    </label>&nbsp;
						<label class="radio-inline">
							<input type="radio" name="optradio1" value="no" id="optradiono1" checked=""> No
						</label>
					</div>
					<div class="form-group" id="mul_image1" style="display: none">
						 <label for="mfile">Select images for gallery</label>
					    <input type="file" class="form-control" id="mfile" name="filePicGall[]" multiple>
					</div>

					<button type="submit" name="btnSubmit" class="btn btn-info" value="<?php echo isset($event[0]['id']) ? $event[0]['id'] : "";?>">Edit</button>
          		</form>
          	</div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once('footer.php');?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datetimepicker.full.js');?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$.datetimepicker.setLocale('en');
		$('#datetimepicker1').datetimepicker({
			formatTime:'H:i',
			formatDate:'Y/m/d',
			//defaultDate:'8.12.1986', // it's my birthday
			// defaultDate:'+03.01.1970', // it's my birthday
			// defaultTime:'10:00',
			timepickerScrollbar:false
		});

		$('#datetimepicker2').datetimepicker({
			formatTime:'H:i',
			formatDate:'Y/m/d',
			//defaultDate:'8.12.1986', // it's my birthday
			// defaultDate:'+03.01.1970', // it's my birthday
			// defaultTime:'10:00',
			timepickerScrollbar:false
		});



		$('#mul_image').hide();
		$('#mul_image1').hide();

		$('#optradioyes').click(function(){
			$('#mul_image').show('slow');
		});

		$('#optradiono').click(function(){
			$('#mul_image').hide('slow');
		});

		$('#optradioyes1').click(function(){
			$('#mul_image1').show('slow');
		});

		$('#optradiono1').click(function(){
			$('#mul_image1').hide('slow');
		});
	});
</script>