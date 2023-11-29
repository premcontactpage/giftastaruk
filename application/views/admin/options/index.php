<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Product tags </h1>
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
                  <th>Add tags</th>
                  <th>Tags added</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i=1; if(count($data)>0){ foreach($data as $da){ $option = $this->common_library->option_count($da->id); ?>
                    <tr>
                       <td><?=$i?></td>
                       <td><?=$da->product_name?></td>
                       <td><a href="<?=base_url()?>add-tags/<?=$da->id?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add tags</a></td>
                       <td>
                        <?php if(count($option)>1){ echo count($option).' Tags added'; }else{ echo count($option).' Tag added'; }  ?></td>
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
