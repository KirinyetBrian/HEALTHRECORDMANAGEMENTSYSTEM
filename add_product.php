<?php
  $page_title = 'Add Records';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('tbl_service');
  $all_photo = find_all('media');
  $name=find_all('tbl_patient')
?>
<?php
 if(isset($_POST['add_records'])){
   $req_fields = array('service','Date','name');
   validate_fields($req_fields);
   if(empty($errors)){
     $service  = remove_junk($db->escape($_POST['service']));
     $Date  = remove_junk($db->escape($_POST['Date']));
     $name   = remove_junk($db->escape($_POST['name']));
    

     $query  = "INSERT INTO serviceprovided (";
$query .=" s_id,Date,patientId";
$query .=") VALUES (";
$query .=
"'{$service}','{$Date}','{$name}'";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Setrvice record added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to add Service');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Record</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
            
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="service">
                      <option value="">Select Service</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['s_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>

                
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th"></i>
                     </span>
                     <input type="Date" class="form-control" name="Date" placeholder="Date">
                 
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th"></i>
                      </span>
                      <select class="form-control" name="name">
                      <option value="">Selct Patients Name</option>
                    <?php  foreach ($name as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                      
                   </div>
                  </div>
                    
                
               </div>
              </div>
              <button type="submit" name="add_records" class="btn btn-danger">Add Records</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
