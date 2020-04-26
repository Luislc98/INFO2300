<header>
  <h1 id="title"><?php print_title() ?></h1>

  <nav id="menu">
    <ul>
      <?php
      foreach( $pages as $page ) {
        $file = $page[0];
        $name = $page[1];

        echo '<li';
        if ($current_file == $file) {
          // Indicate the current page.
          echo ' class=\'current_page\'';
        }
        echo '><a href="' . $file . '">' . $name . '</a></li>';
      }
      ?>
    </ul>
  </nav>
</header>
