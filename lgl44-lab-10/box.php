<?php
include("includes/init.php");

$messages = array();

// Set maximum file size for uploaded files.
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;

// Users must be logged in to upload files!
if ( isset($_POST["submit_upload"]) && is_user_logged_in() ) {

  // get the info about the uploaded files.
  $upload_info = $_FILES["box_file"];
  $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

  if ( $upload_info['error'] == UPLOAD_ERR_OK ) {
    // The upload was successful!

    // Get the name of the uploaded file without any path
    $upload_name = basename($upload_info["name"]);

    // Get the file extension of the uploaded file
    $upload_ext = strtolower( pathinfo($upload_name, PATHINFO_EXTENSION) );

    $sql = "INSERT INTO documents (user_id, file_name, file_ext, description) VALUES (:user_id, :filename, :extension, :description)";
    $params = array(
      ':user_id' => $current_user['id'],
      ':filename' => $upload_name,
      ':extension' => $upload_ext,
      ':description' => $upload_desc,
    );

    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      // We successfully inserted the record into the database, now we need to
      // move the uploaded file to it's final resting place: uploads directory
      $file_id = $db->lastInsertId("id");
      $id_filename = 'uploads/documents/' . $file_id . '.' . $upload_ext;

      if ( move_uploaded_file($upload_info["tmp_name"], $id_filename ) ) {
        // Successfully moved the tmp uploaded file to the uploads directory.
      } else {
        array_push($messages, "Failed to upload file. TODO");
      }
    } else {
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
