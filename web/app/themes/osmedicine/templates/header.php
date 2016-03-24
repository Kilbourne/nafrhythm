<header class="banner" id="responsive-menu">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/gesualdo_logo.svg" alt="<?php bloginfo('name'); ?>"></a> 
    <nav class="nav-primary" >
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
      <div class="social-wrap">
        <h3>Social & Contatti</h3>
        <div class="social">
          <a href=""><span class="fb"></span></a>
          <a href=""><span class="insta"></span></a>
          <a href=""><span class="yt"></span></a>
          <a href=""><span class="mail"></span></a>
        </div>
      </div>
    </nav>
  </div>
</header>
