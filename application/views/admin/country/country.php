

  <!-- Content Wrapper. Contains page content -->
  <?php 
    
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        Add Countries
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Countries</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="container">
        <div class="row">
    
        <div class="col-md-4">
            <form method="POST" action="<?= base_url() .'add-state'?>">
                
                <div class="form-group">
                    <label for="state">Add State</label>
                    <input class="form-control" type="text" name="state" id="state" required/>   
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add State</button>
                </div>
            </form>
        </div>
        
        <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-4">
            <form method="POST" action="<?= base_url() .'add-city'?>">
                <div class="form-group">
                    <label for="state">Select State</label>
                    <select class="form-control" name="state" required> 
                        <option value="">--Select State</option>
                        <?php 
                        if(isset($states) && count($states) > 0){
                            foreach($states as $state){
                                echo '<option value="'.$state['id'].'">'.$state['state_name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city">Add City</label>
                    <input class="form-control" type="text" name="city" id="city" required/>   
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add City</button>
                </div>
            </form>
        </div>
        </div>
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
 
