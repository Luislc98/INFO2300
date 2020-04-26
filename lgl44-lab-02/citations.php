<?php
include("includes/init.php");

$title = "Citations";
?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Citation Rules</h1>
      <ol>
        <li>
          <p>Every resource that you use that you did <strong>NOT</strong> create specifically for this class (external resource) must have a citation visible on the screen near the resource <strong>AND</strong> must include a citation to the resource in the code as a comment.</p>
          <figure>
            <!-- Source: https://infosci.cornell.edu/logo.png -->
            <img src="images/infosci-logo.png" alt="Cornell InfoSci Logo"/>
            <figcaption>
              Source: <cite><a href="https://infosci.cornell.edu/">Cornell University, Information Science</a></cite>
            </figcaption>
          </figure>
        </li>
        <li>
          <p>
            Every resource that you use that you created specifically for this class (<em>non</em>-external resource) must have a citation in the code as a comment.
          </p>
          <figure>
            <!-- Source: (original work) Kyle Harms -->
            <img src="images/harms-selfie.jpg" alt="Selfie of Kyle Harms"/>
          </figure>
        </li>
      </ol>
    </article>
  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
