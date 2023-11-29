
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Joyfulsuprises | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice" style="margin: 95px 25px;">
    <!-- title row -->
  <?php
  $address       = $this->common_library->fetch_user_address($order[0]->address_id);
  $order_details = $this->common_library->fetch_order_details($order[0]->id);
  ?>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Shipping address
        <address>
          <strong><?=$address[0]->user_fname.' '.$address[0]->user_lname?>, </strong><br>
          <?=$address[0]->user_address?><br>
          <?=$address[0]->city.', '.$address[0]->state.', '.$address[0]->country.' - '.$address[0]->pincode?><br>
          <b>Landmark : </b><?=$address[0]->user_landmark?><br>
          Phone: +91 <?=$address[0]->alt_mobile?><br>
          Email: <?=$address[0]->user_email?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Order number #<?=$order[0]->order_number?></b><br>
        <br>
        <b>Order amount : </b> Rs.<?=number_format($order[0]->paid_amount+$order[0]->shipping_fee,2)?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product name</th>
            <th>Product price</th>
          </tr>
          </thead>
          <tbody>
          <?php if(count($order_details)){ foreach($order_details as $or){ ?>
            <tr>
              <td>1</td>
              <td><?=$or->product_name?></td>
              <td><?=$or->product_price?></td>
            </tr>
            <?php } } ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
       
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>Rs.<?=number_format($order[0]->paid_amount,2)?></td>
            </tr>
            <tr>
              <th style="width:50%">Delivery charges:</th>
              <td>Rs.<?=number_format($order[0]->shipping_fee,2)?></td>
            </tr>
            
            <tr>
              <th>Total:</th>
              <td>Rs.<?=number_format($order[0]->paid_amount+$order[0]->shipping_fee,2)?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
