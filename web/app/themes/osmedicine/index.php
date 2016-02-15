<?php 
use Roots\Sage\Extras;
get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div class="category news"><?php  Extras\loop_category('news');?></div>
<div class="category research-science"><?php  Extras\loop_category('research_science');?></div>
<div class="category hi-tech-medicine"><?php  Extras\loop_category('hi-tech_medicine');?> </div>




