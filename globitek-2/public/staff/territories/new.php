<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('../states/show.php');
}
$id = $_GET['id'];
$state_result = find_state_by_id($id);
// No loop, only one result
$state = db_fetch_assoc($state_result);

//set default values for all the variables
  //$this_state = $state['id'];
  //$state['id'] = db_insert_id($db);
   $errors = array();
   $territory = array(
      'name' => '',
      'position' => '',
    //  'state_id' => $state['id']
   );

   if(is_post_request()) {

     // Confirm that values are present before accessing them.
     if(isset($_POST['name'])) { $territory['name'] = $_POST['name']; }
     if(isset($_POST['position'])) { $territory['position'] = $_POST['position']; }

     $result = insert_territory($territory);
     if($result === true) {
        $state['id'] = db_insert_id($db);
       redirect_to('../territories/show.php?id=' . $state['id']);
     } else {
       $errors = $result;
     }
   }


?>

<?php
//to get this state id
//if(!isset($_GET['id'])) {
//  redirect_to('../states/index.php');
//}
//$id = $_GET['id'];
//$state_result = find_state_by_id($id);
// No loop, only one result
//$state = db_fetch_assoc($state_result);
?>

<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/show.php?id=<?php echo $state['id'];?>">Back to State Details</a><br />

  <h1>New Territory</h1>

  <?php echo display_errors($errors); ?>
  <!-- TODO add form -->
  <form action="new.php" method="post">
      Name:<br />
      <input type="text" name="name" value="<?php echo $territory['name']; ?>" /><br />
      Positon:<br />
      <input type="text" name="position" value="<?php echo $territory['position']; ?>" /><br />
      <br />
      <input type="submit" name="submit" value="Create"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
