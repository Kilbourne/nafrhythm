 <?php get_template_part('templates/page', 'header'); ?>
<?php 
if ( function_exists( 'envira_gallery' ) ) { envira_gallery( 'galleria-1', 'slug' ); }
 ?>