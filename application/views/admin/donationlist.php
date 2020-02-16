	<?php include_once('header.php')?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

           <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Details of Donations</h1>
          </div>

          <div class="row">
          	<div class="col">
          		<table class="table table-striped">
				    <thead>
				      <tr>
				      	<th>#</th>
				        <th>Full Name</th>
				        <th>Email</th>
				        <th>Conatct No</th>
				        <th>Amount</th>
				        <th>Razorpay Payment Id</th>
				        <th>Payment Made On</th>
				      </tr>
				    </thead>
				    <tbody>
				      <?php
				      	if(isset($donation) && count($donation)>0){
				      		$ct = 1;
				      		foreach ($donation as $ikey => $ivalue) {
				      ?>
				      <tr>
				        <td><?php echo $ct;?></td>
				        <td><?php echo ucfirst($ivalue['fullname']);?></td>
				        <td><?php echo $ivalue['email'];?></td>
				        <td><?php echo $ivalue['contactno'];?></td>
				        <td><?php echo $ivalue['amount'];?></td>
				        <td><?php echo $ivalue['razorpay_payment_id'];?></td>
				        <td><?php echo date('d/m/yy H:i:s',strtotime($ivalue['dated_on']));?></td>
				      </tr>
				      <?php
				      		$ct++;}
				      	} 
				      ?>
				    </tbody>
				</table>
          	</div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <?php include_once('footer.php');?>