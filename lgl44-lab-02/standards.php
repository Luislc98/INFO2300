<?php
include("includes/init.php");

$title = "Standards";

$standards = array(
  "All code is your own work, unless the assignment states otherwise.",
  "Content is cited correctly as specified in the syllabus.",
  "Your website is designed to meet the needs of a specific target audience(s).",
  "Design employs visual design principles.",
  "Your design is aesthetically pleasing.",
  "A multi-page site should be well organized and include proper navigation.",
  "Your code is documented with comments where appropriate.",
  "Main page is named index.html or index.php.",
  "The HTML is well structured for your site’s content (i.e. use of <header>, <main>, <section>, <aside>, <footer>, <strong>, <em>).",
  "No <b> or <i>, etc.",
  "External styling via CSS. No inline or internal styling (i.e. <style> elements or style=\"\" attributes).",
  "Multiple CSS files are okay as long it’s for legitimate structural reasons.",
  "Your code (HTML, CSS, JavaScript, PHP) is well written, readable, formatted, and properly indented.",
  "No broken or dead links. Remember that some computers use case sensitive file and folder names!",
  "Your instructor’s computer is case sensitive.",
  "No hotlinking of external resources. This almost always includes embedding.",
  "Google fonts is hotlinking unless you host the fonts locally.",
  "Validated HTML5 and CSS3. You must have 0 errors; warnings are permitted.",
  "Error free code (PHP). Warnings are okay.",
  "All files are reasonably sized (~< 1MB) for the web (this includes: images, videos, PDFs, etc.)",
  "Well organized site files.",
  "Images are located in an images directory.",
  "Your CSS files are located in the styles directory.",
  "Your PHP includes are located in the includes directory.",
  "You have tested your website in Firefox and Chrome."
);

// $a_standard should be a string
function print_standard($a_standard)
{
  echo "<li>" . htmlspecialchars($a_standard) . "</li>";
}

?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Assignment Standards</h1>
      <section>
        <p><strong>This web page is an example of the standards you are expected follow this semester. This example web page follows the guidelines below.</strong></p>

        <p>Coding and design guidelines:</p>
        <ul>
          <?php
          foreach ($standards as $s) {
            print_standard($s);
          }
          ?>
        </ul>

      </section>
    </article>
  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
