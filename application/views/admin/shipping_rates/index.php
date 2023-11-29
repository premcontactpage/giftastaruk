<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> shipping rates <a href="javascript:void[0]" data-toggle="modal" data-target="#addModal" class="btn btn-success" style="float: right;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a></h1>
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
                  <th>Sl.No</th>
                  <th>Start price</th>
                  <th>End price</th>
                  <th>Shipping price</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i=1; if(count($data)>0){ foreach($data as $da){ ?>
                    <tr>
                       <td><?=$i?></td>
                       <td><?=$da->start_price?></td>
                       <td><?=$da->end_price?></td>
                       <td><?=$da->shipping_rate?></td>
                       <td>
                         <?php if($da->status==1){ ?>
                          <span class="label label-success">Active</span>
                         <?php }else{ ?>
                          <span class="label label-danger">Inactive</span>
                         <?php } ?>
                       </td>
                       <td>
                        <?php if($da->status==1){ ?>
                         <a href="<?=base_url()?>change-status/0__<?=$da->id?>__shipping_rates" class="btn btn-sm btn-info">Change status</a>
                       <?php }else{ ?>
                         <a href="<?=base_url()?>change-status/1__<?=$da->id?>__shipping_rates" class="btn btn-sm btn-info">Change status</a>
                       <?php } ?>
                         <a href="javascript:void[0]" onclick="deleteit('<?=base_url()?>delete/<?=$da->id?>__shipping_rates')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                         <a href="javascript:void[0]" onclick="edit_data('<?=$da->id?>','<?=$da->start_price?>','<?=$da->end_price?>','<?=$da->shipping_rate?>')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                       </td>
                    </tr>
                  <?php $i++; } } ?>
                </tbody>
              </table>
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
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form method="post" action="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Shipping rate</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputPassword1">Start price</label>
            <input type="number" class="form-control" name="start_price" min="1" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">End price</label>
            <input type="number" class="form-control" name="end_price" min="1" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Shipping rate</label>
            <input type="number" class="form-control" name="shipping_rate" min="1" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form method="post" action="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Shipping rate</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputPassword1">Start price</label>
            <input type="number" class="form-control" name="start_price" min="1" required="">
            <input type="hidden" name="id">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">End price</label>
            <input type="number" class="form-control" name="end_price" min="1" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Shipping rate</label>
            <input type="number" class="form-control" name="shipping_rate" min="1" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function edit_data(id,start_price,end_price,shipping_rate)
  {
    $('input[name=id]').val(id);
    $('input[name=start_price]').val(start_price);
    $('input[name=end_price]').val(end_price);
    $('input[name=shipping_rate]').val(shipping_rate);
    $('#editModal').modal('show');
  }
</script>