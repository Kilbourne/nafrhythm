<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php 
  	$dischi=get_posts(array( 
  		"post_type"=>"dischi",
  		"posts_per_page"=>-1
  		));
  	$display="";  	
  	if(count($dischi)>0){
  	foreach ($dischi as $key => $disco) {
  		setup_postdata($GLOBALS['post'] =& $disco );
  		if($key===0){
  ?>
  			<div class="extended-disc-panel not-visible">
  				<div class="copertina">
  					<h3 class="disco-title"><?= $disco->post_title ?></h3>
  					<?= get_the_post_thumbnail($disco->ID,'thumbnail'); ?>
  				</div><div class="tracklist">
  					<h3>Tracklist</h3>
  					<div>
  						<?= get_field('tracklist',$disco->ID); ?>
  					</div>
  				</div><div class="descrizione-disco">
  					<h3>in breve...</h3>
  					<div>
  						<?php the_excerpt(); ?>
  					</div>
  					
  					<audio id="music" src="<?php if(get_field('audio_sample',$disco->ID)){ echo get_field('audio_sample',$disco->ID); }?>"  preload="auto">
					  Your browser does not support the <code>audio</code> element.
					</audio>
  					<button id="pButton" class="play"> Ascolta un medley dell'album</button>
  					
  				</div>
  			</div>
  <?php  
  		}

  			$display.="<li id='".$disco->ID."' class='";
  			if($key===0) $display.="active";
  			$display.="'>";
  			$display.="<a  class='disco-link' href='".get_post_permalink( $disco->ID )."'>". get_the_post_thumbnail($disco->ID,'thumbnail') ."</a></li>";
  		
  		wp_reset_postdata();
  	}
  	for($x=0; $x<4;$x++){
  		$display.= '<li class="empty-list"></li>';
  	}
  	echo '<div class="discs-list">'.$display.'</div>';
  }
   ?>
<?php endwhile; ?>
