<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");



$messages = array();

// max fiel siz eis 10MB
const MAX_FILE_SIZE = 1000000;

// Users must be logged in
// Source: lab 8, Kyle Harms
if ( isset($_POST["submit_upload"]) && is_user_logged_in() ) {
  // get the info about  uploaded files.
  $upload_info = $_FILES["member_file"];
  $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $upload_location_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  if ( $upload_info['error'] == UPLOAD_ERR_OK ) {
    // check if file uploaded correctly
    // call file name
    $upload_name = basename($upload_info["name"]);
    echo '<script>console.log("Your stuff here")</script>';
    // call file extension
    $upload_ext = strtolower( pathinfo($upload_name, PATHINFO_EXTENSION) );
    $sql = "INSERT INTO images ( location_name,file_name, file_ext, description,user_id) VALUES ( :location, :filename, :extension, :description,:user_id)";
    $params = array(
      ':location' => $upload_location_name,
      ':filename' => $upload_name,
      ':extension' => $upload_ext,
      ':description' => $upload_desc,
      ':user_id' => $current_user['id'],
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      //move file to directory
      $file_id = $db->lastInsertId("id");
      $id_filename = 'uploads/images/' . $file_id . '.' . $upload_ext;
      if ( move_uploaded_file($upload_info["tmp_name"], $id_filename ) ) {
        // Successfully moved the tmp uploaded file to the uploads directory.
      }
      else {
        array_push($messages, "Failed to upload file. TODO");
      }

    }
    else {
      array_push($messages, "Failed to upload file. TODO");
    }
  } else {
    // Upload failed.
    array_push($messages, "Failed to upload file. TODO");
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" media="all" />
  <title>Home</title>
</head>

<body>
<?php
  $title = "Member Zone ";
  include("includes/header.php");

 ?>

<p> If you are a member of our appreciation society, you can use your travel wisdom to help aspiring travels plan their next trip.
    Please Login using your Username and Password to add locations worth traveling to.
</p>
<?php
if ( is_user_logged_in() ) {
  // Add a logout query string parameter
  $logout_url = htmlspecialchars( $_SERVER['PHP_SELF'] ) . '?' . http_build_query( array( 'logout' => '' ) );

  echo '<li > <a id="logout" href="' . $logout_url . '">Sign Out ' . htmlspecialchars($current_user['username']) . '</a> </li>';
}
?>
<div id="content-wrap">
    <?php
    // If the user is logged in, let them upload files and view their uploaded files.
    if ( is_user_logged_in() ) {

      foreach ($messages as $message) {
       echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
      }
      ?>
      <!-- Source:Lab 8 Kyle Harms -->
      <h2>Add a Location to our list </h2>
      <!-- TODO: Peer review this form checking to make sure it properly supports file uploads. -->
      <form id="uploadFile" action="login.php" method="post" enctype="multipart/form-data">
        <ul>
          <li>
            <!-- MAX_FILE_SIZE must precede the file input field -->
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

            <label for="member_file">Upload File:</label>
            <input id="member_file" type="file" name="member_file">
          </li>
          <li>
            <label for="member_name">Location Name (required):</label>

            <input type="text" id="member_name" name="name">
          </li>
          <li>
            <label for="member_desc">Description:</label>
            <textarea id="member_desc" name="description" cols="35" rows="1"></textarea>
          </li>
          <li>
            <button name="submit_upload" type="submit">Upload File</button>
          </li>
        </ul>
      </form>


      <h2>Your Uploaded Locations</h2>

<ul>
  <?php

if (isset($_GET['delete_location'])) {
  $deleting = FALSE;
  $delete_location = filter_input(INPUT_GET, 'delete_location', FILTER_SANITIZE_STRING);
//makes the variable lowercase so it fits parameter of databases
  $delete_location = strtolower( trim( $delete_location ) );
  $select_deleted_image = exec_sql_query(
    $db,
    "SELECT * FROM images WHERE location_name = :locname AND user_id=:user;",
    array(':locname' => $delete_location,':user' => $current_user['id'] )
    )->fetchAll();
  if ( $delete_location != '' && count($select_deleted_image) > 0 ) {
    $deleting = TRUE;
    $delete_image = exec_sql_query(
      $db,
      "DELETE FROM images WHERE location_name = :locname;",
      array('locname' => $delete_location )
      )->fetchAll();

    if (count($select_deleted_image) > 0){
      $delete_image_tags = exec_sql_query(
        $db,
        "DELETE FROM image_tags WHERE image_id = :delete_image_id;",
        array('delete_image_id' => $select_deleted_image[0]['id'] )
        )->fetchAll();
        // delete image from file
        unlink('uploads/images/' . $select_deleted_image[0]['id'] . '.' . $select_deleted_image[0]['upload_ext']);
    }

    } else {
    }
  }
else {
  $deleting = FALSE;
}
  $user_locations = exec_sql_query(
    $db,
    "SELECT * FROM images WHERE user_id = :user_id;",
    array(':user_id' => $current_user['id'])
    )->fetchAll();
// check to see if current user has uploaded any locations on list
  if (count($user_locations) > 0) {
    foreach($user_locations as $locations){
      echo '<a href="login.php?' . http_build_query( array( 'id' => $locations['id'] ) ) . '"><img id="gallery" src="uploads/images/' . $locations['id'] . '.jpg" alt="' . htmlspecialchars($locations['id']) . '"/></a>' . PHP_EOL;
      echo '<p class="locationtitle" >'. 'Title:   ' .htmlspecialchars($locations['location_name']).  '<p>';
      echo '<p>'. 'Description:   '  .htmlspecialchars($locations['description']).  '<p>';
    }
  } else {
    echo '<p><strong>You have not added a travel recommendation to our list. Feel free to give your advice!</strong></p>';
  }

if ( isset($_POST["delete_tag"])  ) {
  echo '<script>console.log("first if passes")</script>';
  $show_delete_tag_results = FALSE;
  $delete_tag_to_image = filter_input(INPUT_POST, 'tag_to_image', FILTER_SANITIZE_STRING);
  $delete_tag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING);

  $is_image_user = exec_sql_query(
    $db,
    "SELECT * FROM images WHERE user_id = :user_id;",
    array(':user_id' => $current_user['id'])
    )->fetchAll();
  //makes the variable lowercase so it fits parameter of databases
  $delete_tag_to_image = strtolower( trim( $delete_tag_to_image ) );
  $delete_tag = strtolower( trim( $delete_tag ) );
  if ( $delete_tag != '' && $delete_tag_to_image != '' ) {
    echo '<script>console.log("Your stuff here")</script>';
    $show_delete_tag_results = TRUE;
    // gets the image record of location
    $delete_tag_to_location = exec_sql_query(
      $db,
      "SELECT * FROM images WHERE location_name = :location_add AND user_id=:user;",
      array(':location_add' => $delete_tag_to_image , ':user' => $current_user['id'])
      )->fetchAll();
    // search tag table to see if inputted string is already a tag
    $is_tag_existent = exec_sql_query(
      $db,
      "SELECT * FROM tags WHERE tag = :created_tag;",
      array(':created_tag' => $delete_tag)
      )->fetchAll();
  // check to see if tag and location exist
    if (count($is_tag_existent) > 0 && count($delete_tag_to_location) > 0 ) {
      echo '<script>console.log("both tag and image read")</script>';
      $sql_deleting_tag = "DELETE FROM image_tags WHERE image_id=:new_image_id AND tag_id=:new_tag_id ";
      $params_existing_tag = array(

        ':new_image_id' => $delete_tag_to_location[0]['id'],
        ':new_tag_id' => $is_tag_existent[0]['id'],
      );
      $result_delete_tag = exec_sql_query($db, $sql_deleting_tag, $params_existing_tag);
    }

    else {
      echo '<script>console.log("else passes")</script>';
    }
  }
}
else {
  // Form was not submitted.

  $show_delete_tag_results = FALSE;
}
?>
</ul>
<p> If you want to remove a location you had previously added to our travel list, please fill out the form below.
</p>
<form id="delete_image_Form" action="login.php" method="get">
  <label for="delete_field">Location Name:</label>
  <input type="text" id="delete_field" name="delete_location" value="<?php if ( isset($delete_location) ) { echo htmlspecialchars($delete_location); } ?>"/>
  <button type="submit">Delete</button>
</form>
<p> Think that one of the tips you gave about the location was actually a mistake? Just fill out the name of the location and the tag to fix your mistake!
<p>
<form id="deletetagForm" action="login.php" method="post">
  <label for="delete_tag_field">Tag:</label>

  <input type="text" id="delete_tag_field" name="tag" value="<?php if ( isset($tag) ) { echo htmlspecialchars($tag); } ?>"/>
  <label for="locationname">Location Name:</label>
  <input type="text" id="locationname" name="tag_to_image" value="<?php if ( isset($tag_to_image) ) { echo htmlspecialchars($delete_tag_to_image); } ?>"/>

  <button name="delete_tag" type="submit">Delete tag</button>
</form>

  <?php

  }
   else {
    ?>
  <p><strong>You need to sign in before you can add a destination to our list.</strong></p>
    <ul>
      <?php
          foreach ($session_messages as $message) {

          echo "<li><strong>" . htmlspecialchars($message) . "</strong></li>\n";
          }
      ?>
    </ul>

        <form id="loginForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
          <ul>
            <li>
              <label for="username">Username:</label>
              <input id="username" type="text" name="username" />
            </li>
            <li>
              <label for="password">Password:</label>
              <input id="password" type="password" name="password" />
            </li>
            <li>
              <button name="login" type="submit">Sign In</button>

            </li>
          </ul>
        </form>
            <?php

          }
          ?>





</div>
<?php include("includes/footer.php"); ?>


</body>
</html>
