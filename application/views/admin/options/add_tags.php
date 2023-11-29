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
          <h3 class="box-title">Add Tag options</h3>
          <a href="<?=base_url()?>options" class="btn btn-danger" style="float: right;">Go Back</a>
        </div>
        <?php if(count($data)>0){ ?>
        <form role="form" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?=$product_id?>">
          <input type="hidden" name="status" value="edit">
          <div class="box-body">
            <?php $j=1; foreach($data as $da){ ?>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" value="<?=$da->name?>" name="edit_name[]" placeholder="Enter name" required="">
                <input type="hidden" name="id[]" value="<?=$da->id?>">
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1 ">Tag</label>
                <select class="form-control" name="edit_tag[]" required="">
                  <option value="">select tag</option>
                  <option <?php if($da->tag=='text'){ echo "selected"; } ?> value="text">Text</option>
                  <option <?php if($da->tag=='email'){ echo "selected"; } ?> value="email">Email</option>
                  <option <?php if($da->tag=='number'){ echo "selected"; } ?> value="number">Number</option>
                  <option <?php if($da->tag=='file'){ echo "selected"; } ?> value="file">File Upload</option>
                  <option <?php if($da->tag=='date'){ echo "selected"; } ?> value="date">Date</option>
                  <option <?php if($da->tag=='color'){ echo "selected"; } ?> value="color">Color Pick</option>
                  <option <?php if($da->tag=='textarea'){ echo "selected"; } ?> value="textarea">Short Note</option>
                  <option <?php if($da->tag=='checkbox'){ echo "selected"; } ?> value="checkbox">Chackbox</option>
                  <option <?php if($da->tag=='radio'){ echo "selected"; } ?> value="radio">Radio button</option>
                  <option <?php if($da->tag=='dropdown'){ echo "selected"; } ?> value="dropdown">Dropdown</option>
                </select>
              </div>
              <?php if($j==1){ ?>
              <div class="form-group col-md-4" style="margin-top: 25px;">
                <a href="javascript:void[0]" class="btn btn-sm btn-success add_field_button"><i class="fa fa-plus"></i></a>
                <a href="<?=base_url()?>delete/<?=$da->id?>__tag_options" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
              </div>
             <?php }else{ ?>
             <div class="form-group col-md-4" style="margin-top: 25px;">
                <a href="<?=base_url()?>delete/<?=$da->id?>__tag_options" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
            <div class="form-group col-md-4">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" name="name[]" placeholder="Enter name" required="">
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputEmail1 ">Tag</label>
              <select class="form-control" name="tag[]" required="">
                <option value="">select tag</option>
                <option value="text">Text</option>
                <option value="email">Email</option>
                <option value="number">Number</option>
                <option value="file">File Upload</option>
                <option value="date">Date</option>
                <option value="color">Color Pick</option>
                <option value="textarea">Short Note</option>
                <option value="checkbox">Chackbox</option>
                <option value="radio">Radio button</option>
                <option value="dropdown">Dropdown</option>
              </select>
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
            $(wrapper).append('<div class="row"><div class="form-group col-md-4"><label for="exampleInputEmail1">Name</label><input type="text" class="form-control" name="name[]" placeholder="Enter name" required=""></div><div class="form-group col-md-4"><label for="exampleInputEmail1 ">Tag</label><select class="form-control" name="tag[]" required=""><option value="">select tag</option><option value="text">Text</option><option value="email">Email</option><option value="number">Number</option><option value="file">File Upload</option><option value="date">Date</option><option value="color">Color Pick</option><option value="textarea">Short Note</option><option value="checkbox">Chackbox</option><option value="radio">Radio button</option><option value="dropdown">Dropdown</option></select></div><div class="form-group col-md-3" style="margin-top: 25px;"><a href="javascript:void[0]" class="btn btn-sm btn-danger remove_field"><i class="fa fa-trash"></i></a></div></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent().parent('div').remove(); x--;
    })
});
</script>