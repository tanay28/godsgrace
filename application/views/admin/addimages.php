	<?php include_once('header.php')?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

           <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Images</h1>
          </div>
          <div class="row">
          	<div class="col">
          		<form name="frmAdd" method="POST" enctype='multipart/form-data' action="<?php echo base_url('Admindashboard/add');?>">
					<div class="form-group">
					    <label for="pwd">Select Images</label>
					    <input type="file" class="form-control" id="file" name="filePicGall[]"  multiple>
					</div>

					<button type="submit" name="btnSubmit" class="btn btn-info" value="submitted">Submit</button>
          		</form>
          	</div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <?php include_once('footer.php');?>