<?php
require_once('../../../private/initialize.php');

//set default values for all the variables
   $errors = array();
   $state = array(
      'name' => '',
      'code' => '',
      'countryid' => ''
   );

   if(is_post_request()) {

     // Confirm that values are present before accessing them.
     if(isset($_POST['name'])) { $state['name'] = $_POST['name']; }
     if(isset($_POST['code'])) { $state['code'] = $_POST['code']; }
     if(isset($_POST['countryid'])) { $state['countryid'] = $_POST['countryid']; }

     $result = insert_state($state);
     if($result === true) {
       $new_id = db_insert_id($db);
       redirect_to('show.php?id=' . $new_id);
     } else {
       $errors = $result;
     }
   }
?>
<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>New State</h1>
  <?php echo display_errors($errors); ?>
  <!-- TODO add form -->
  <form action="new.php" method="post">
      Name:<br />
      <input type="text" name="name" value="<?php echo h($state['name']); ?>" /><br />
      Code:<br />
      <input type="text" name="code" value="<?php echo h($state['code']); ?>" /><br />
      Country ID:<br />
      <input type="text" name="countryid" value="<?php echo h($state['countryid']); ?>" /><br />
      <br />
      <input type="submit" name="submit" value="Create"  />
  </form>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
