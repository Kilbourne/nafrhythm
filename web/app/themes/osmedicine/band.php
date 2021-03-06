<?php 
/*
Template Name: Band Template
*/
?>

  <?php get_template_part('templates/page', 'header'); ?>
   <?php 
  	$band=get_posts(array( 
  		"post_type"=>"band",
  		"posts_per_page"=>-1
  		));
  	$display='';  	
  	if(count($band)>0){
  	foreach ($band as $key => $componente) {
  		setup_postdata($GLOBALS['post'] =& $componente );
  		if($key===0){
  ?>
  			<div class="extended-disc-panel not-visible">
  				<h1><?php the_title( ); ?></h1>
  				 <h2><?= get_field('strumento',$componente->ID); ?></h2>
  				 <div class="details">
            <?php 
            if(has_post_thumbnail($componente)){
              echo get_the_post_thumbnail($componente->ID,'thumbnail'); 
            }else{
              echo '<img src="'.get_stylesheet_directory_uri().'/dist/images/avatar-placeholder.png'.'" alt=""> ';
            }
             ?>
  				 	<div class="desc-wrap">
              <?php the_content(); ?>  
            </div>
  				 	
  				 </div> 
  				
  			</div>
  <?php  
  		}

  			$display.="<li id='".$componente->ID."' class='";
  			if($key===0) $display.="active";
  			$display.="'>";
                    if(has_post_thumbnail($componente)){
              $thumb= get_the_post_thumbnail($componente->ID,'thumbnail'); 
            }else{
              $thumb= '<img src="'.get_stylesheet_directory_uri().'/dist/images/avatar-placeholder.png'.'" alt=""> ';
            }
  			$display.="<a  class='componente-link' href='".get_post_permalink( $componente->ID )."'><div> ". $thumb ."</div>
  			<div><h3>". get_the_title( )."</h3>
  				 <h4>". get_field('strumento',$componente->ID)."</h4></div></a></li>";
  		
  		wp_reset_postdata();
  	}
  	//for($x=0; $x<4;$x++){
  	//	$display.= '<li class="empty-list"></li>';
  	//}
  	echo '<div class="discs-list">'.$display.'</div>';
  }
   ?>


 