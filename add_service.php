
<?php
  $page_title = 'All Services';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('tbl_service')
?>
<?php
 if(isset($_POST['add_serv'])){
   $req_field = array('sname');
   $req_field = array('CostOfService');

   validate_fields($req_field);
   $sname = remove_junk($db->escape($_POST['sname']));
   $cos = remove_junk($db->escape($_POST['CostOfService']));
   
 
   if(empty($errors)){
      $sql  = "INSERT INTO tbl_service (s_name,CostOfService)";
      $sql .= " VALUES ('{$sname}','{$cos}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Service");
        redirect('add_service.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert Service.");
        redirect('add_service.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('add_service.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add Patient</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_service.php">
            <div class="form-group">
                <input type="text" class="form-control" name="sname" placeholder="Service Name">
                <input type="text" class="form-control" name="CostOfService" placeholder="Cost of Service">
                

            </div>
            <button type="submit" name="add_serv" class="btn btn-primary">Add Service</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Services</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Service </th>
                     <th>Cost Of Service</th>
                     
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['s_name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['costOfservice'])); ?></td>
                    
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
