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
          <h3 class="box-title">Add Product</h3>
          <a href="<?=base_url()?>products" class="btn btn-danger" style="float: right;">Go Back</a>
        </div>
        <form role="form" action="" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Product name</label>
              <input type="text" class="form-control" name="product_name" placeholder="Product name" required="">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">URL Name</label>
              <input type="text" class="form-control" name="url_name" placeholder="URL name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Offer price</label>
              <input type="number" class="form-control" name="offer_price" min="1">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Price</label>
              <input type="number" class="form-control" name="price" min="1" required="">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Product images (Multiple uploads)</label>
              <input type="file" class="form-control" name="images[]" accept="image/x-png,image/gif,image/jpeg" multiple="" required="">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea class="form-control" name="description" required rows="4" id="editor1"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Care instructions</label>
              <textarea class="form-control" name="care_instructions" required rows="4" id="editor2"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Delivery Information</label>
              <textarea class="form-control" name="delivery_info" required rows="4" id="editor6"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Meta title</label>
              <textarea class="form-control" name="meta_title" required rows="4" id="editor3"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Meta keywords</label>
              <textarea class="form-control" name="meta_keywords" required rows="4" id="editor4"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Meta description</label>
              <textarea class="form-control" name="meta_desc" required rows="4" id="editor5"></textarea>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
<script type="text/javascript" src="https://ckeditor.com/assets/libs/ckeditor4/4.16.0/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace( 'editor1' );
  CKEDITOR.replace( 'editor2' );
  CKEDITOR.replace( 'editor3' );
  CKEDITOR.replace( 'editor4' );
  CKEDITOR.replace( 'editor5' );
  CKEDITOR.replace( 'editor6' );
</script>