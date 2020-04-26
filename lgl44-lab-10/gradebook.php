<?php
include("includes/init.php");

function print_record($record) {
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["last_name"] . ', ' . $record["first_name"]);?></td>
    <td><?php echo htmlspecialchars($record["grade"]);?></td>
  </tr>
  <?php
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">

    <?php
    if ( is_user_logged_in() ) {
      ?>
      <h2>Grade</h2>

      <table>
        <tr>
          <th>Name</th>
          <th>Grade</th>
        </tr>

        <?php
        $sql = "SELECT * FROM students WHERE user_id = :user_id;";
        $params = array(
          ':user_id' => $current_user['id']
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          $records = $result->fetchAll();
          print_record($records[0]);
        }
        ?>
      </table>
      <?php
    } else {
      ?>
      <h2>Check your Grade</h2>

      <p><strong>You need to sign in before you can view your grade.</strong></p>

      <?php
      include("includes/login.php");
    }
    ?>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
