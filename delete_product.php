<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $product = find_by_id('opportunity',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","Missing Opportunity id.");
    redirect('product.php');
  }
?>
<?php
  $delete_id = delete_by_id('opportunity',(int)$product['id']);
  if($delete_id){
      $session->msg("s","Opportunity deleted.");
      redirect('product.php');
  } else {
      $session->msg("d","Opportunity deletion failed.");
      redirect('product.php');
  }
?>
