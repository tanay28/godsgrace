<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Offline Donation Details</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url('assets/donation/fonts/material-icon/css/material-design-iconic-font.min.css')?>">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/donation/css/style.css')?>">

    <style type="text/css">
        .home-menu {
            position: relative;
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
        a:link {
          color: red;
        }
        a:visited {
          color: green;
        }
        a:hover {
          color: hotpink;
        }
        a:active {
          color: blue;
        }
        .details{
            font-family: "Times new roman";
            color: black;
            padding: 10px;
            font-size: 20px;
            position: relative;
            left: 10px;
            text-align: left;
            : ;
        }
        .info {
            color: red;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="container"><br>
            <h2 align="center">Bank Details</h2>
           <!--  <div class="details">
               <p><b>Bank Name :</b> <span class="info">Syndicate Bank</span></p>
                <p><b>Branch Name :</b> <span class="info">Srirampur, Hooghly</span></p>
                <p><b>IFSC Code :</b> <span class="info">SYNB0009535</span></p>
                <p><b>Account Name :</b> <span class="info">Baidhyabati  Gods Grace Foundation</span></p>
                <p><b>Account No. :</b> <span class="info">95352200042070</span></p>
            </div> -->
            <table class="details" border="0" cellspacing="0" cellpadding="0" height="300" width="480">
                <tr>
                    <td>Bank Name </td>
                    <td class="info">Syndicate Bank</td>
                </tr>
                <tr>
                    <td>Branch Name </td>
                    <td class="info">Srirampur, Hooghly</td>
                </tr>
                <tr>
                    <td>IFSC Code </td>
                    <td class="info">SYNB0009535</td>
                </tr>
                <tr>
                    <td>Account Name </td>
                    <td class="info">Baidyabati Gods Grace Foundation</td>
                </tr>
                <tr>
                    <td>Account No </td>
                    <td class="info">95352200042070</td>
                </tr>
            </table>
            <div>
                <a class="home-menu" href="<?php echo base_url('Home')?>">Home</a>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?php echo base_url('assets/donation/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/donation/js/main.js');?>"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</body>
</html>