<?php
include("includes/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">INFO/CS 2300; NBA 5301</h1>

      <p>This semester you'll author your front-end content in HTML, CSS, and Javascript. You'll author your back-end content in PHP.</p>

      <section>
        <h2>PHP</h2>

        <p>You're running PHP version: <strong><?php echo htmlspecialchars(phpversion()); ?></strong>.</p>
        <p><strong>If you're not running at least version 7.0, please ask a TA for help.</strong></p>
      </section>

      <section>
        <h2>SQLite</h2>

        <figure id="database">
          <!-- Image source: https://openclipart.org/detail/94723/database-symbol -->
          <img alt="Database" src="images/db.svg"/>
          <figcaption>
            <cite>source: <a href="https://openclipart.org/detail/94723/database-symbol">https://openclipart.org/detail/94723/database-symbol</a></cite>)
          </figcaption>
        </figure>

        <p>You'll also learn how to utilize databases to store data for your web pages. We'll be using the development database, SQLite.</p>

        <p>This is a list of common Databases. Observe that this list is written from a SQLite database. <strong>If you do not see a list of databases below, please notify a TA that your PHP does not include SQLite Support.</strong></p>

        <ul>
          <?php
          $result = exec_sql_query($db, 'SELECT * FROM Software');
          foreach ($result as $row) { ?>
            <li><?php echo htmlspecialchars($row["name"]); ?></li>
          <?php } ?>
        </ul>
      </section>
    </article>
  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
