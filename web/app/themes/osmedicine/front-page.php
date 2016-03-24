<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php 
  	$slides=get_posts(array(
  		"post_type"=>"home_slider",
  		"posts_per_page"=>-1
  	));
  	if(!!count($slides)){
  		echo "<div class='full-slider'>
    			<ul>";
    			//echo var_dump($slides);
  		foreach ($slides as $key => $slide) {
  			//echo var_dump($slide);
  			echo "<li>".get_the_post_thumbnail( $slide->ID, "full")."</li>";
  		}
  		echo "</ul>
				</div>";
  	}
   ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
