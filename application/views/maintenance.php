<!DOCTYPE html>
<html>
<head>
	<title>Under maintenance</title>
	<style type="text/css">
		body, html {
		  height: 100%;
		  overflow:hidden;
		}

		.bgimg {
		  /* Background image */
		  background-image: url('<?php echo base_url("assets/img/header-bg.jpg");?>');
		  /* Full-screen */
		  height: 100%;
		  width: 100%;
		  /* Center the background image */
		  background-position: center;
		  /* Scale and zoom in the image */
		  background-size: cover;
		  /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
		  position: relative;
		  /* Add a white text color to all elements inside the .bgimg container */
		  color: red;
		  /* Add a font */
		  font-family: "Courier New", Courier, monospace;
		  /* Set the font-size to 25 pixels */
		  font-size: 25px;
		  text-shadow: 3px 2px black;
		}

		/* Position text in the top-left corner */
		.topleft {
		  position: absolute;
		  top: 0;
		  left: 16px;
		}

		/* Position text in the bottom-left corner */
		.bottomleft {
		  position: absolute;
		  bottom: 0;
		  left: 16px;
		}

		/* Position text in the middle */
		.middle {
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  text-align: center;
		}

		/* Style the <hr> element */
		hr {
		  margin: auto;
		  width: 40%;
		}
	</style>
	<script type="text/javascript">
		function noBack()
         {
             window.history.forward()
         }
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt) { if (evt.persisted) noBack() }
        window.onunload = function() { void (0) }
	</script>
</head>
<body>
	<div class="bgimg">
  		<div class="topleft">
    		<p><img src="<?php echo base_url('assets/img/logo.png');?>" height="80" width="110" /></p>
  		</div>
  		<div class="middle">
    		<h1>Page is under maintenance.</h1>
    		<hr>
    		<h5>Inconvenience is regreted.</h5>
    		<hr>
    		<!-- <h5><a href="<?php echo base_url('Admindashboard');?>">Back</a></h5> -->
  		</div>
  		<div class="bottomleft">
    		<h5>Coming back soon..</h5>
  		</div>
	</div>
</body>
</html>