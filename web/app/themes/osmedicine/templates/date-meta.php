<?php 
	$categories=get_the_category();
	$cat=get_category( $categories[0] );
 ?>
<time class="updated <?php echo $cat->slug.'-cat-bg-color';?>" datetime="<?= get_post_time('c', true); ?>"><span class="day"><?= get_the_date
('d'); ?></span><span class="month"><?= get_the_date('M Y'); ?></span> </time>
<div class="single-title-wrap">
      <h1 class="entry-title"><?php the_title(); ?></h1><?php 




	if(count($categories)>0){
	?>
	<ul class="entry-category-list">
	<?php
	foreach ($categories as $key => $category) {
		$cat = get_category( $category );
		?>
	<li class="entry-category <?php echo $cat->slug.'-cat-bg-color';?>">
		<a href="<?= get_category_link( $category ); ?>"><?= $cat->name; ?></a>
	</li>
	<?php
	}
	?>
	</ul> 
	<?php
	}

?>
      </div>      