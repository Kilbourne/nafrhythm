<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); 
      previous_post_link();
      next_post_link();

       
       
    
       $categories=get_the_category();
        $orig_post = $post;
     $args=array( 
            'category__in' => $categories,
            'post__not_in' => array($post->ID),
            'posts_per_page'=>3
          );  
     $my_query = new wp_query( $args );
     
     if ( have_posts() ) {
     
        ?>
<div class="related-posts">
   <ul class="related-post-list">
        <?php
         while( $my_query->have_posts() ) {
    $my_query->the_post(); ?>

<li class="related-post">
  <div class="related-post-img-wrap">
    
  </div>  
  <div class="related-post-date"><?php the_date() ?></div>   
  <h4 class="related-post-title"><?php the_title() ?></h4> 
</li>   

    <?php
  }
    ?>
    </ul>
 </div> 
    <?php
     }
    $post = $orig_post;
    wp_reset_query();

     

       
      ?>
    </footer>
    <?php // comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>

