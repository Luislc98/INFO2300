<?php
include("includes/init.php");

// open connection to database
$db = open_sqlite_db("secure/roster.sqlite");

function print_record($record) {
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["netid"]);?></td>
    <td><?php echo htmlspecialchars($record["last_name"] . ', ' . $record["first_name"]);?></td>
    <td><?php echo htmlspecialchars($record["grade"]);?></td>
  </tr>
  <?php
}
?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">

    <h2>Check your Grade</h2>

    <form action="gradebook.php" method="post">
      <label>NetID:</label>
      <input type="text" name="netid" required/>
      <label>Password:</label>
      <input type="password" name="password" required/>
      <button type="submit">Check Grade</button>
    </form>

    <?php
    if ( isset($_POST['netid']) ) {
      $netid = $_POST['netid'];
      ?>

      <h2>Grade</h2>

      <table>
        <tr>
          <th>NetID</th>
          <th>Name</th>
          <th>Grade</th>
        </tr>

        <?php
        $sql = "SELECT * FROM students WHERE netid = :netid;";
        $params = array(
          ':netid' => $netid
        );
        $records = exec_sql_query($db, $sql, $params)->fetchAll();
        foreach($records as $record) {
          print_record($record);
        }
      }
      ?>
    </table>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
