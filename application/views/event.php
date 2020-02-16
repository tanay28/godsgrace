	<?php include_once('header.php'); ?>
	
	<!--================ start banner Area =================-->
	<section class="banner-area relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row justify-content-lg-end align-items-center banner-content">
				<div class="col-lg-5">
					<h1 class="text-white"><?php  echo $event_name;?></h1>
					<!-- <p>A likeness were made fourth land bring lesser beast face image they bring so earth moved they are great move</p> -->
				</div>
			</div>
		</div>
	</section>
	<!--================ End banner Area =================-->

	<!--================ Start Recent Event Area =================-->
	<?php
		if(isset($event_details) && count($event_details)>0){
			$ct = 1;
			foreach ($event_details as $ikey => $ivalue) {
	?>
	<section class="event_details section-gap-top">
		
		<div class="container">
			<!-- <div class="row justify-content-center">
				<div class="col-lg-10">
					<img src="<?php echo base_url('assets/img/causes/c3.jpg');?>" alt="" class="img-fluid" height="300" width="350">
				</div>
			</div> -->

			<div class="event_content">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="right_content">
							
							<h2><?php echo "Event ".$ct; ?></h2>

							<h3 class="mb-20 mt-40">Event Details</h3>
							<p><?php echo isset($ivalue['event_details']) ? $ivalue['event_details'] : "NA";?></p>
							<h4 class="mb-20 mt-40">Event Description</h4>
							<p><?php echo isset($ivalue['description']) ? $ivalue['description'] : "NA";?></p>
							
							<?php if(isset($ivalue['image_gallery']) && $ivalue['image_gallery'] != ""){?>
							<h4 class="mb-20 mt-40">Few Moments</h4>
							
							<div class="instagram-slider owl-carousel">
								<?php
									$arr = json_decode($ivalue['image_gallery'],true);
									if(isset($arr) && count($arr)>0){
										foreach ($arr as $ikey => $img){
								?>
								<a href="<?php echo base_url('assets/img/egallery/'.$img);?>" class="single-instagram d-block img-pop-up">
									<div class="instagram-img">
										<img src="<?php echo base_url('assets/img/egallery/'.$img);?>" alt="hr" height="150px" width="170px">
									</div>
								</a>
								
								<?php }}}?>
							</div>
						</div>
					</div>



					<div class="col-lg-2 mt-lg-0 mt-5">
						<div class="left_content">
							<div class="mb-40">
								<h5>
									<i class="ti-time"></i>
									Start Time
								</h5>
								<div class="ml-30">
									<?php
										// echo isset($ivalue['start_at']) ? date('H:i:s',$ivalue['start_at']) : "00:00:00";  
										echo isset($ivalue['start_at']) ? $ivalue['start_at'] : 'NA';
									?>
								</div>
							</div>

							<div class="mb-40">
								<h5>
									<i class="ti-check-box"></i>
									Finish Time
								</h5>
								<div class="ml-30">
									<?php
										// echo isset($ivalue['end_at']) ? date('H:i:s',$ivalue['end_at']) : "00:00:00"; 
										echo isset($ivalue['end_at']) ? $ivalue['end_at'] : 'NA'; 
									?>
								</div>
							</div>

							<div class="">
								<h5>
									<i class="ti-location-pin"></i>
									Address
								</h5>
								<div class="ml-30"><?php echo isset($ivalue['location']) ? $ivalue['location'] : 'NA';?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	<hr>
	<?php
			$ct++;}
		}else{
	?>
	<section class="event_details section-gap-top">
		<div><h2 style="color: red;text-align: center;">No event Found..!!</h2></div>
	</section>
	<?php
		}
	?>
	<!--================ End Recent Event Area =================-->
	
	<?php include_once('footer.php'); ?>