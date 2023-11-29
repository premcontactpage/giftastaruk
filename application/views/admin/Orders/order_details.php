
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Order details
      <small>#<?=$order[0]->order_number?></small>
    </h1>
  </section>

  <?php
  $address       = $this->common_library->fetch_user_address($order[0]->address_id);
  $order_details = $this->common_library->fetch_order_details($order[0]->id);
  ?>

  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Order details - <?=$order[0]->order_number?>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Shipping address
        <address>
          <strong><?=$address[0]->user_fname.' '.$address[0]->user_lname?>, </strong><br>
          <?=$address[0]->user_address?><br>
          <?=$address[0]->city.', '.$address[0]->state.', '.$address[0]->country.' - '.$address[0]->pincode?><br>
          <b>Landmark  : </b><?=$address[0]->user_landmark?><br>
          <strong>Phone  :</strong> +91 <?=$address[0]->alt_mobile?><br>
          <strong>Email  :</strong> <?=$address[0]->user_email?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
         Contact Information
          <address>
        <?php if($address[0]->contact_user_name!=""){ ?>
        <strong>Contact Name  :</strong>  <?=$address[0]->contact_user_name?><br>
        <?php }else{ ?>
        <strong>Contact Name  :</strong>  ---<br>
        <?php } ?>
        <?php if($address[0]->contact_mobile!=""){ ?>
        <strong>Contact Mobile  :</strong> +91 <?=$address[0]->contact_mobile?>
        <?php }else{ ?>
        <strong>Contact Mobile  :</strong> ---
        <?php } ?>
        </address>
        
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Order number #<?=$order[0]->order_number?></b><br>
        <br>
        <b>Paid on : </b> <?=date('d M, Y h:i A',strtotime($order[0]->created_datetime))?><br>
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
              <th>Color</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($order_details)){ foreach($order_details as $or){ ?>
            <tr>
              <td>1</td>
              <td><?=$or->product_name?></td>
              <td><?=$or->product_price?></td>
              <td><?=$or->color?></td>
            </tr>
            <?php } } ?>
      
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">

      <div class="col-xs-12 table-responsive">
        <h4>Tag data</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product name</th>
              <th>Tag name</th>
              <th>Tag data</th>
            </tr>
          </thead>
          <tbody id="details_here">
            
      
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

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
              <th style="width:50%">Coupon discount (-):</th>
              <td>Rs.<?=number_format($order[0]->discount_amount,2)?></td>
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

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="<?=base_url()?>print/<?=$order[0]->id?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        <?php if($order[0]->order_status=='New'){ ?>
        <a href="<?=base_url()?>Default_controller/update_order/<?=$order[0]->id?>" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Set it as Disputed
        </a>
      <?php } ?>
        
      </div>
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
  <div id="imgModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" style="text-align: center;">
          <img style="width: 300px;" id="modal_img" src="" style="cursor: pointer;">
        </div>
        <div class="modal-footer">
          <a href="#" id="download" class="btn btn-success" download>Download</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <script type="text/javascript">
    
    
    fetch_order_details();
    $('#details_here').html('<tr><td colspan="3">Loading Please wait...</td></tr>');
    function fetch_order_details()
    {
        $.post('<?=base_url()?>fetch-order-details-ajax',{order_id:'<?=$order[0]->id?>'},function(respo){
            $('#details_here').html(respo);
            showImg();
        })
    }
    
    function showImg()
    {
        $('img').click(function(){
      var src = $(this).attr('src');
      $('#modal_img').attr('src',src);
      $('#download').attr('href',src);
      if($(this).attr('data')=='src')
      {
        $('#imgModal').modal('show');
      }
    })
    }
  </script>