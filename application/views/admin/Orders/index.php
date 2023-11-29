<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?=ucfirst($status)?> Orders </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Date&time</th>
                  <th>Order id</th>
                  <th>Username</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php $total_amount = 0; $i=1; if(count($orders)>0){ foreach($orders as $da){  ?>
                    <tr>
                       <td><?=$i?></td>
                       <td style="font-size:10px;"><b><?=date('M d, Y h:i A',strtotime($da->created_datetime))?></b></td>
                       <td><a href="<?=base_url()?>view/<?=$da->id?>">#<?=$da->order_number?></a></td>
                       
                       <td><?=$da->user_fname.' '.$da->user_lname?></td>
                       <td><?=$da->alt_mobile?></td>
                       <td><?=$da->user_email?></td>
                       <td><?=number_format($da->paid_amount+$da->shipping_fee,2)?></td>
                       <td>
                         <?php if($da->order_status=='New'){ ?>
                          <span class="label label-success">New</span>
                         <?php }else{ ?>
                          <span class="label label-danger">Disputed</span>
                         <?php } ?>
                       </td>
                       <td>
                        <a href="<?=base_url()?>view/<?=$da->id?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void[0]" onclick="send_mail('<?=$da->user_fname.' '.$da->user_lname?>','<?=$da->user_email?>')" class="btn btn-sm btn-primary"><i class="fa fa-envelope"></i></a>
                       </td>
                    </tr>
                  <?php $i++; $total_amount += $da->paid_amount+$da->shipping_fee;  } } ?>
                </tbody>
              </table>
              
              <b>Total amount: <?=number_format($total_amount,2)?></b>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- Modal -->
<div id="mailModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <form id="myform" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send mail to <b id="name"></b></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
           <label for="exampleInputEmail1">Subject</label>
           <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required="">
           <input type="hidden" name="email">
           <input type="hidden" name="username">
        </div>
        <div class="form-group">
           <label for="exampleInputEmail1">Message</label>
           <textarea  class="form-control" name="message" placeholder="Enter message" rows="5" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
  </div>
</div>
<script type="text/javascript" src="https://ckeditor.com/assets/libs/ckeditor4/4.16.0/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace( 'editor1' );
</script> 
<script>
    function send_mail(name,email)
    {
        $('input[name=username]').val(name);
        $('input[name=email]').val(email);
        $('#name').text(name+' ('+email+')');
        $('#mailModal').modal('show');
    }
    
    
$("form").submit(function(e) {
$('#cover-spin').show();
e.preventDefault();
    var form = $("#myform");

    var formData = new FormData(form[0]);
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>Default_controller/sendIt',
            //dataType: 'json', //not sure but works for me without this
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false, //this is requireded please see answers above
            //cache: false, //not sure but works for me without this
                success: function() 
                {
                  $('#cover-spin').hide();
                  swal('Success',"Mail sent successful",'success');
                  $("#myform")[0].reset();

                  $('#age_group').hide();
                  $('#district').hide();
                  $('#mailModal').modal('hide');

                }, //You missed this
                error: function() 
                {
                  alert("Something went wrong");
                }
        });
});
</script>
