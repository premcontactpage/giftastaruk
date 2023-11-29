<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Ratings <a href="javascript:void[0]" data-toggle="modal" data-target="#addModal" class="btn btn-success" style="float: right;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a></h1>
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
                  <th>Product name</th>
                  <th>User name</th>
                  <th>Title</th>
                  <th>Rating</th>
                  <th>Review date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i=1; if(count($review)>0){ foreach($review as $da){ $product = $this->common_library->product_data($da->product_id); ?>
                    <tr>
                       <td><?=$i?></td>
                       <td><?=$product[0]->product_name?></td>
                       <td><?=$da->user_name?></td>
                       <td><?=$da->title?></td>
                       <td><?=$da->rating?></td>
                       <td><?=date('Y-m-d',strtotime($da->date))?></td>
                       <td>
                         <?php if($da->status==1){ ?>
                          <span class="label label-success">Active</span>
                         <?php }else{ ?>
                          <span class="label label-danger">Inactive</span>
                         <?php } ?>
                       </td>
                       <td>
                        <?php if($da->status==1){ ?>
                         <a href="<?=base_url()?>change-status/0__<?=$da->id?>__rating" class="btn btn-sm btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                       <?php }else{ ?>
                         <a href="<?=base_url()?>change-status/1__<?=$da->id?>__rating" class="btn btn-sm btn-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
                       <?php } ?>
                         <a href="javascript:void[0]" onclick="deleteit('<?=base_url()?>delete/<?=$da->id?>__rating')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                         <a href="javascript:void[0]" onclick="edit_data('<?=$da->id?>','<?=$da->product_id?>','<?=$da->user_name?>','<?=$da->title?>','<?=$da->review?>','<?=$da->rating?>','<?=$da->date?>')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
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
          <h4 class="modal-title">Add Rating</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputPassword1">Product</label>
            <select class="form-control" name="product_id" required="">
              <option value="">select product</option>
              <?php if(count($data)>0){ foreach($data as $p){ ?>
                <option value="<?=$p->id?>"><?=$p->product_name?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">User name</label>
            <input type="text" class="form-control" name="user_name" min="1" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Rating</label>
            <select class="form-control" name="rating" required="">
              <option value="">select rating</option>
              <?php for($k=1;$k<=5;$k++){ ?>
                <option value="<?=$k?>"><?=$k?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Title</label>
            <input type="text" class="form-control" name="title" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Review</label>
            <textarea class="form-control" rows="3" name="review" required=""></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Review date</label>
            <input type="date" class="form-control" name="date" required="">
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
          <h4 class="modal-title">Edit Rating</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputPassword1">Product</label>
            <select class="form-control" name="product_id" required="">
              <option value="">select product</option>
              <?php if(count($data)>0){ foreach($data as $p){ ?>
                <option value="<?=$p->id?>"><?=$p->product_name?></option>
              <?php } } ?>
            </select>
            <input type="hidden" name="id">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">User name</label>
            <input type="text" class="form-control" name="user_name" min="1" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Rating</label>
            <select class="form-control" name="rating" required="">
              <option value="">select rating</option>
              <?php for($k=1;$k<=5;$k++){ ?>
                <option value="<?=$k?>"><?=$k?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Title</label>
            <input type="text" class="form-control" name="title" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Review</label>
            <textarea class="form-control" rows="3" name="review" required=""></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Review date</label>
            <input type="date" class="form-control" name="date" required="">
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
  function edit_data(id,product,username,title,review,rating,date)
  {
    $('input[name=id]').val(id);
    $('select[name=product_id] option[value="'+product+'"]').attr('selected',true);
    $('input[name=user_name]').val(username);
    $('select[name=rating] option[value="'+rating+'"]').attr('selected',true);
    $('input[name=title]').val(title);
    $('textarea[name=review]').val(review);
    $('input[name=date]').val(date);
    $('#editModal').modal('show');
  }
</script>