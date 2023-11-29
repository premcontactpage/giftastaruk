<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <!-- general form elements -->
       <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Product</h3>
          <a href="<?=base_url()?>products" class="btn btn-danger" style="float: right;">Go Back</a>
        </div>
        <form role="form" action="" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Product name</label>
              <input type="text" class="form-control" value="<?=$data[0]->product_name?>" name="product_name" placeholder="Product name" required="">
              <input type="hidden" name="id" value="<?=$data[0]->id?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">URL Name</label>
              <input type="text" class="form-control" value="<?=$data[0]->url_name?>" name="url_name" placeholder="URL name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Offer price</label>
              <input type="number" class="form-control" name="offer_price" value="<?=$data[0]->offer_price?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Price</label>
              <input type="number" class="form-control" name="price" min="1" value="<?=$data[0]->price?>" required="">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Product images (Multiple uploads)</label>
              <input type="file" class="form-control" name="images[]" accept="image/x-png,image/gif,image/jpeg" multiple="">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea class="form-control" name="description" required rows="4" id="editor1"><?=$data[0]->description?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Care instructions</label>
              <textarea class="form-control" name="care_instructions" required rows="4" id="editor2"><?=$data[0]->care_instructions?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Delivery Information</label>
              <textarea class="form-control" name="delivery_info" required rows="4" id="editor6"><?=$data[0]->delivery_info?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Meta title</label>
              <textarea class="form-control" name="meta_title" required rows="4" id="editor3"><?=$data[0]->meta_title?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Meta keywords</label>
              <textarea class="form-control" name="meta_keywords" required rows="4" id="editor4"><?=$data[0]->meta_keywords?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Meta description</label>
              <textarea class="form-control" name="meta_desc" required rows="4" id="editor5"><?=$data[0]->meta_desc?></textarea>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
  <div class="row">
    <div class="box-footer">
      <ul class="mailbox-attachments clearfix">
        <?php if(count($images)>0){ foreach($images as $im){ ?>
       <li style="height: 145px;">
        <span class="mailbox-attachment-icon has-img"><img style="width: 200px;height: 100px;" onclick="open_img('<?=base_url()?>assets/uploads/product/<?=$im->images?>')" src="<?=base_url()?>assets/uploads/product/<?=$im->images?>" alt="Attachment"></span>
        <div class="mailbox-attachment-info">
          <a href="#" class="mailbox-attachment-name"></a>
          <span class="mailbox-attachment-size">
            <a href="<?=base_url()?>delete/<?=$im->id?>__product_images" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i>&nbsp;&nbsp; Remove</a>
            <a href="javascript:void[0]" onclick="change('<?=$im->id?>')" class="btn btn-success btn-xs pull-left"><i class="fa fa-eye"></i>&nbsp;&nbsp; Priority (<?=$im->priority?>)</a>
          </span>
        </div>
      </li>
      <?php } } ?>
    </ul>
  </div>
</div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="" id="img" style="width: 570px;height: 400px">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="priority" class="modal fade" role="dialog">
  <form method="post" action="<?=base_url()?>update-priority">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <input type="number" name="priority" class="form-control" required="">
        <input type="hidden" name="id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  </form>
</div>

<script type="text/javascript">
  CKEDITOR.replace( 'editor1' );
  CKEDITOR.replace( 'editor2' );
  CKEDITOR.replace( 'editor3' );
  CKEDITOR.replace( 'editor4' );
  CKEDITOR.replace( 'editor5' );
  CKEDITOR.replace( 'editor6' );

  function open_img(img)
  {
    $('#img').attr('src',img);
    $('#myModal').modal('show');
  }

  function change(id)
  {
    $('input[name=id]').val(id);
    $('#priority').modal('show');
  }
</script>