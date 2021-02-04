<?php
  $page_title = 'All Patients';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('tbl_patient')
?>
<?php
 if(isset($_POST['add_pat'])){
   $req_field = array('categorie-name');
   $req_field = array('NationalID');
   $req_field = array('Email');
   $req_field = array('Phone');
   $req_field = array('DateOfBirth');
   $req_field = array('FirstVisit');
   $req_field = array('Gender');
   $req_field = array('comments');

   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   $Email = remove_junk($db->escape($_POST['Email']));
   $ID = remove_junk($db->escape($_POST['NationalID']));
   $Phone= remove_junk($db->escape($_POST['Phone']));
   $dob = remove_junk($db->escape($_POST['DateOfBirth']));
   $firstvisit = remove_junk($db->escape($_POST['FirstVisit']));
   $Gender = remove_junk($db->escape($_POST['Gender']));
   $comments = remove_junk($db->escape($_POST['comments']));
   if(empty($errors)){
      $sql  = "INSERT INTO tbl_patient (name,Nationalid,Email,phone,DOB,FirstVisit,Gender,COMMENTS)";
      $sql .= " VALUES ('{$cat_name}','{$ID}','{$Email}','{Phone}','{$dob}','{$firstvisit}','{$Gender}','{$comments}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Patient");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert Patient.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
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
          <form method="post" action="categorie.php">
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name" placeholder="Patiens Name">
                <input type="text" class="form-control" name="NationalID" placeholder="NationalID">
                <input type="text" class="form-control" name="Email" placeholder="Email">
                <input type="text" class="form-control" name="Phone" placeholder="Phone">
                <input type="Date" class="form-control" name="DateOfBirth" placeholder="Date of Birth">
                <input type="Date" class="form-control" name="FirstVisit" placeholder="FirstVisit">
                <input type="text" class="form-control" name="Gender" placeholder="Gender">
                <input type="text" class="form-control" name="comments" placeholder="comments">             
                

            </div>
            <button type="submit" name="add_pat" class="btn btn-primary">Add Patient</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Patients</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Name</th>
                     <th>NationalId</th>
                      <th>Email</th>
                      <th>Phone</th>
                     <th>DOB</th>
                      <th>FirstVisit</th>
                      <th>Gender</th>
                      <th>COMMENTS</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['NationalId'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['Email'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['phone'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['DOB'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['FirstVisit'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['Gender'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cat['COMMENTS'])); ?></td>
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
