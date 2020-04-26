<?php
include("includes/init.php");

$messages = array();

// Set maximum file size for uploaded files.
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;

// Users must be logged in to upload files!
if ( isset($_POST["submit_upload"]) && is_user_logged_in() ) {
  $upload_info = $_FILES["box_file"];
  //$_FILES["input_name"]
  if (move_uploaded_file($_FILES["input_name"] ($_FILES["box_file"]) , $upload_info)) {
    echo "File is valid, and was successfully uploaded.\n";
    $uploadfile = $uploaddir . basename($_FILES['box_file']['input_name']);
}
  else{
  echo "File is invalid.\n";
  }
  $new_path = "uploads/documents/ID.FILE_EXT";
  move_uploaded_file( $_FILES["box_file"]["tmp_name"], $new_path );

  // TODO: filter input for the "box_file" and "description" parameters.
  // Hint: filtering input for files means checking if the upload was successful

  // TODO: If the upload was successful, record the upload in the database
  // and permanently store the uploaded file in the uploads directory.

}
?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>2300 Plop Box</h1>

    <p>Welcome to the 2300 Plop Box, a file storing service!</p>

    <?php
    // If the user is logged in, let them upload files and view their uploaded files.
    if ( is_user_logged_in() ) {

      foreach ($messages as $message) {
        echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
      }
      ?>

      <h2>Upload a File</h2>

      <!-- TODO: Peer review this form checking to make sure it properly supports file uploads. -->
      <form id="uploadFile" action="box.php" method="post" enctype="multipart/form-data">
        <ul>
          <li>
            <!-- MAX_FILE_SIZE must precede the file input field -->
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

            <label for="box_file">Upload File:</label>
            <input id="box_file" type="file" name="box_file">
          </li>
          <li>
            <label for="box_desc">Description:</label>
            <textarea id="box_desc" name="description" cols="40" rows="5"></textarea>
          </li>
          <li>
            <button name="submit_upload" type="submit">Upload File</button>
          </li>
        </ul>
      </form>

      <h2>Saved Files</h2>

      <ul>
        <?php
        $records = exec_sql_query(
          $db,
          "SELECT * FROM documents WHERE user_id = :user_id;",
          array(':user_id' => $current_user['id'])
          )->fetchAll();

        if (count($records) > 0) {
          foreach($records as $record){
            echo "<li><a href=\"uploads/documents/" . $record["id"] . "." . $record["file_ext"] . "\">" . htmlspecialchars($record["file_name"]) . "</a> - " . htmlspecialchars($record["description"]) . "</li>";
          }
        } else {
          echo '<p><strong>No files uploaded yet. Try uploading a file!</strong></p>';
        }
        ?>
      </ul>
      <?php
    } else {
      ?>
      <p><strong>You need to sign in before you can use Plop Box.</strong></p>

      <?php
      include("includes/login.php");
    }
    ?>

  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
