	<!--================ Start Image Gallery =================-->
	<section class="instagram-area section-gap-top">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="section-title">
						<h2><span>Image</span> Gallery</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="instagram-slider owl-carousel">
			<?php
				if(isset($gallery) && count($gallery)>0){
					foreach ($gallery as $ikey => $ivalue){
			?>
			<a href="<?php echo base_url('assets/img/gallery/'.$ivalue["name"]);?>" class="single-instagram d-block img-pop-up">
				<div class="instagram-img">
					<img src="<?php echo base_url('assets/img/gallery/'.$ivalue["name"]);?>" alt="">
				</div>
			</a>
			
			<?php
					}
				}
			?>
		</div>
	</section>
	<!--================ Start Image Gallery =================-->
	
	<!--================ start footer Area =================-->
	<footer class="footer">
		<div class="footer-area">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-5 col-md-6 col-sm-6">
						<!-- <div class="single-footer-widget tp_widgets">
							<h4 class="footer_title large_title">About Us</h4>
							<p>
								Do you want to be even more successful? Learn to love learning and growth. The more effort you put into
								improving your skills, the bigger the payoff you will get. Realize that things will be hard at first, but the
								rewards will be worth it.
							</p>
							
						</div> -->
					</div>
				
					<div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Contact Us</h4>
							<div class="ml-5">
								<p class="sm-head">
									<span class="fa fa-location-arrow"></span>
									Head Office
								</p>
								<p>
									7/5 Chawk Musalman Para, P.O- Baidyabati, District – Hooghly West Bengal Pin-712222
								</p>

								<p class="sm-head">
									<span class="fa fa-phone"></span>
									Phone Number
								</p>
								<p>
									+91-9038266783
								</p>

								<p class="sm-head">
									<span class="fa fa-envelope"></span>
									Email
								</p>
								<p>
									email@email.com
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area =================-->

	<script src="<?php echo base_url('assets/js/vendor/jquery-2.2.4.min.js');?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="<?php echo base_url('assets/js/vendor/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.ajaxchimp.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/parallax.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/owl.carousel.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/isotope.pkgd.min.js');?>"></script>
	<!-- <script src="<?php //echo base_url('js/jquery.nice-select.min.js');?>"></script> -->
	<script src="<?php echo base_url('assets/js/jquery.magnific-popup.min.js');?>"></script>
	
	<script src="<?php echo base_url('assets/js/jquery.sticky.js');?>"></script>
	<script src="<?php echo base_url('assets/js/main.js');?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#dismiss').click(function(){
				window.location.href = "<?php echo base_url('Home')?>";
			});
			<?php
			  	$msg = "";
			  	$msg = $this->session->userdata('status');
			  	if($msg!=""){
			?>
			$('#modalLoginForm').modal('show');
			<?php
			  	}
			?>
		});
	</script>
</body>

</html>

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    	<div class="modal-content">
	      <div class="modal-header text-center">
	        <h4 class="modal-title w-100 font-weight-bold">Log in</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body mx-3">
	      	<form action="<?php echo base_url('Login');?>" name="frm" method="post">
		       	<div class="form-group">
			    	<label for="email">Email address:</label>
			    	<input type="email" class="form-control" id="email" name="txtEmail">
			  	</div>
			  	<div class="form-group">
			    	<label for="pwd">Password:</label>
			    	<input type="password" class="form-control" id="pwd" name="txtPassword">
			  	</div>
			  	<button type="submit" class="btn btn-default">Login</button>
			  	<?php
			  		$msg = "";
			  		$msg = $this->session->userdata('status');
			  		if($msg!=""){
			  	?>
			  	<span class="alert alert-danger" role="alert" style="height: 40px; padding: 2px;">Invalid 
			  	credentials..!! Please try again.</span>
			  	<?php
			  		} 
			  	?>
			</form>
	      </div>
	    </div>
    
  </div>
</div>