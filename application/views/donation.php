<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donation form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url('assets/donation/fonts/material-icon/css/material-design-iconic-font.min.css')?>">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/donation/css/style.css')?>">

    <style type="text/css">
        .home-menu {
            position: relative;
            bottom: 100px;
            left: 264px;
            text-decoration: none;
        }
        .razorpay-payment-button {
            color: #ffffff !important;
            background-color: #7266ba;
            border-color: #7266ba;
            font-size: 14px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="container">
            <form enctype='multipart/form-data' method="POST" name="frm" class="appointment-form" action="javascript:void()">
                <h3>
                    Make A Donation Now! You May Change Lives Forever
                </h3>
                <div class="form-group-1">
                    <input type="text" name="name" id="name" placeholder="Your Name" required />
                    <input type="email" name="email" id="email" placeholder="Email" required />
                    <input type="number" name="phone_number" id="phoneno" placeholder="Phone number" required />
                    
                    <select name="cmbAmount" onchange="getval(this)" id="amount">
                        <option slected value="">Select Amount</option>
                        <option value="100">Rs. 100</option>
                        <option value="500">Rs. 500</option>
                        <option value="1000">Rs. 1000</option>
                        <option value="custom">Custom amount</option>
                    </select>
                      <input type="text" name="txtcusamount" id="custom_amount" placeholder="Enter custom amount" style="display: none"  />
                </div>
                <input type="hidden" value="Hidden Element" name="hidden">
                <input type="submit" name="submit" class="submit donate" value="Donate now" />
            </form>
            <div >
                <a class="home-menu" href="<?php echo base_url('Home')?>">Home</a>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?php echo base_url('assets/donation/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/donation/js/main.js');?>"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">

       document.addEventListener('contextmenu', event => event.preventDefault());
       function getval(sel){
            var status = sel.value;
            if(status == 'custom'){
                $('#custom_amount').show('slow');
            }else{
                $('#custom_amount').hide('slow');
            }
       }

       //-------------- Razor Pay ------------------//

       $(document).ready(function(){
        
            var SITEURL = "<?php echo base_url()?>";
            $('body').on('click', '.donate', function(e){
               
               //alert('Page under maintenance..');
                var amount = 0;
                if($('#amount').val() == "custom"){
                    amount = $('#custom_amount').val();
                }else{
                    amount = $('#amount').val();
                }
                var email = $('#email').val();
                var name = $('#name').val();
                var phno = $('#phoneno').val();
               
                var options = {
                    "key": "rzp_test_47C753Kg4MNXFP",
                    "amount": (amount * 100), // 2000 paise = INR 20
                    "name": "Godgrace",
                    "description": "Donation",
                    "handler": function (response){
                      $.ajax({
                            url: SITEURL + 'Donation/donate',
                            type: 'post',
                            data: {
                                razorpay_payment_id: response.razorpay_payment_id , 
                                totalAmount : amount ,
                                email : email,
                                phone_number : phno,
                                name : name
                            }, 
                            success: function (msg) {
                               window.location.href = SITEURL + 'Donation/RazorThankYou';
                            },
                            error: function (err){
                                console.log("Inside Error ",err)
                                
                            }
                        }); 
                    },
                    "theme": {
                        "color": "#528FF0"
                    }
                };
                console.log(options);
                var rzp1 = new Razorpay(options);
                rzp1.open();
                e.preventDefault();
            });
       }); 
    </script>
</body>
</html>