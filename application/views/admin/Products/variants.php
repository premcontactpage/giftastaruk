<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
       <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add variants</h3>
          <a href="<?=base_url()?>products" class="btn btn-danger" style="float: right;">Go Back</a>
        </div>
        <?php if(count($data)>0){ ?>
        <form role="form" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?=$product_id?>">
          <input type="hidden" name="status" value="edit">
          <div class="box-body">
            <?php $j=1; foreach($data as $da){ ?>
            <div class="row">
              <div class="form-group col-md-2">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" class="form-control" name="edit_image[]">
                <input type="hidden" name="id[]" value="<?=$da->id?>">
                <img src="<?=base_url()?>assets/uploads/variants/<?=$da->image?>">
              </div>
              <div class="form-group col-md-2">
                <label for="exampleInputEmail1 ">Color</label>
                <input type="text" class="form-control" name="edit_color[]" value="<?=$da->color?>" placeholder="Enter color" required="">
              </div>
              <div class="form-group col-md-2">
              <label for="exampleInputEmail1 ">Price</label>
              <input type="text" class="form-control" name="edit_price[]" value="<?=$da->price?>" placeholder="Enter price" >
            </div>
              <?php if($j==1){ ?>
              <div class="form-group col-md-4" style="margin-top: 25px;">
                <a href="javascript:void[0]" class="btn btn-sm btn-success add_field_button"><i class="fa fa-plus"></i></a>
                <a href="<?=base_url()?>delete/<?=$da->id?>__product_variants" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
              </div>
             <?php }else{ ?>
             <div class="form-group col-md-4" style="margin-top: 25px;">
                <a href="<?=base_url()?>delete/<?=$da->id?>__product_variants" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
              </div>
            <?php } ?>
            </div>
           <?php  $j++; } ?>
            <span class="input_fields_wrap"></span>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      <?php }else{ ?>
        <form role="form" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?=$product_id?>">
          <input type="hidden" name="status" value="add">
          <div class="box-body">
            <div class="row">
            <div class="form-group col-md-2">
              <label for="exampleInputEmail1">Image</label>
              <input type="file" class="form-control" name="image[]" required="">
            </div>
            <div class="form-group col-md-2">
              <label for="exampleInputEmail1 ">Color</label>
              <input type="text" class="form-control" name="color[]" placeholder="Enter color" required="">
            </div>
            <div class="form-group col-md-2">
              <label for="exampleInputEmail1 ">Price</label>
              <input type="text" class="form-control" name="price[]" placeholder="Enter price" >
            </div>
            <div class="form-group col-md-3" style="margin-top: 25px;">
              <a href="javascript:void[0]" class="btn btn-sm btn-success add_field_button"><i class="fa fa-plus"></i></a>
            </div>
            </div>
            <span class="input_fields_wrap"></span>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      <?php } ?>
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row"><div class="form-group col-md-2"><label for="exampleInputEmail1">Image</label><input type="file" class="form-control" name="image[]" required=""></div><div class="form-group col-md-2"><label for="exampleInputEmail1 ">Color</label><input type="text" class="form-control" name="color[]" placeholder="Enter color" required=""></div><div class="form-group col-md-2"><label for="exampleInputEmail1 ">Price</label><input type="text" class="form-control" name="price[]" placeholder="Enter price" ></div><div class="form-group col-md-3" style="margin-top: 25px;"><a href="javascript:void[0]" class="btn btn-sm btn-danger remove_field"><i class="fa fa-trash"></i></a></div></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent().parent('div').remove(); x--;
    })
});
</script>