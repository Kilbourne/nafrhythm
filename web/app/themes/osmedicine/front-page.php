<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php
  	$slides=get_posts(array(
  		"post_type"=>"home_slider",
  		"posts_per_page"=>-1
  	));
  	if(false){
  		echo "<div class='full-slider'>
    			<ul>";
    			//echo var_dump($slides);
  		foreach ($slides as $key => $slide) {
  			//echo var_dump($slide);
  			echo "<li>".get_the_post_thumbnail( $slide->ID, "large")."</li>";
  		}
  		echo "</ul>
				</div>";
  	}
    echo wp_get_attachment_image( get_field('full-width_background_image','option'), "large");
   ?>
  <?php get_template_part('templates/content', 'page'); ?>
  <audio src="<?php  echo get_field('audio_homepage','option');?>" autoplay loop>
  Il tuo browser non supporta l'elemento <code>audio</code>.
</audio>
<?php endwhile; ?>
