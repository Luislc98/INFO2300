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

      // Log Out link
      if ( is_user_logged_in() ) {
        // Add a logout query string parameter
        $logout_url = htmlspecialchars( $_SERVER['PHP_SELF'] ) . '?' . http_build_query( array( 'logout' => '' ) );

        echo '<li id="nav-last"><a href="' . $logout_url . '">Sign Out ' . htmlspecialchars($current_user['username']) . '</a></li>';
      }
      ?>
    </ul>
  </nav>
</header>
