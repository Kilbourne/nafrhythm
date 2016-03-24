<article <?php post_class(); ?>>
<div class="image-wrap"><?php the_post_thumbnail(); ?></div><div class="content-wrap">
  <header>
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
  </div>
</article>
