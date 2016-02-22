<?php
/**
 * Template Name: Profile Page 
 */
?>
<?php acf_form_head(); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
  


				<p>My custom field: <?php the_field('codici_accesso'); ?></p>
				<?php acf_form(array('field_groups' => array(34),'form'=>false)); ?>
<?php endwhile; ?>
