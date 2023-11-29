<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Products <a href="<?=base_url()?>create-product" class="btn btn-success" style="float: right;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a></h1>
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
                  <th>Offer price</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Actions</th>
                  <!--<th>Home</th>-->
                  <th>Product variants</th>
                  <th>Priority</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i=1; if(count($data)>0){ foreach($data as $da){ ?>
                    <tr>
                       <td><?=$i?></td>
                       <td><?=$da->product_name?></td>
                       <td><?=$da->offer_price?></td>
                       <td><?=$da->price?></td>
                       <td>
                         <?php if($da->status==1){ ?>
                          <span class="label label-success">Active</span>
                         <?php }else{ ?>
                          <span class="label label-danger">Inactive</span>
                         <?php } ?>
                       </td>
                       <td>
                        <?php if($da->status==1){ ?>
                         <a href="<?=base_url()?>change-status/0__<?=$da->id?>__products" class="btn btn-sm btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                       <?php }else{ ?>
                         <a href="<?=base_url()?>change-status/1__<?=$da->id?>__products" class="btn btn-sm btn-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
                       <?php } ?>
                         <a href="javascript:void[0]" onclick="deleteit('<?=base_url()?>delete/<?=$da->id?>__products')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                         <a href="<?=base_url()?>edit-product/<?=$da->id?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                       </td>
                       <!--<td><input type="checkbox" onclick="set_home('<?=$da->id?>',this.checked)"></td>-->
                       <td><a href="<?=base_url()?>variants/<?=$da->id?>" class="btn btn-info btn-sm"><i class="fa fa-list-ul" aria-hidden="true"></i></a></td>
                       <td>
                           <select class="form-control" onchange="change_prio('<?=$da->id?>',this.value)">
                               <option value="">select priority</option>
                               <?php if(count($data)>0){ for($count=1;$count<=count($data);$count++){ ?>
                               <option <?php if($da->priority==$count){ echo "selected"; } ?> value="<?=$count?>"><?=$count?></option>
                               <?php } } ?>
                           </select>
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
  <script>
      function set_home(id,status)
      {
          if(status==true)
          {
              var status = 1;
          }
          else
          {
              var status = 0;
          }
      }
      
      function change_prio(id,val)
      {
          $.post('<?=base_url()?>Default_controller/update_product_prio',{id:id,priority:val},function(data){
              if(data=='success')
              {
                  alert('updated successfully');
              }
          })
      }
  </script>
