<div class="entry-meta">
<time class="updated" datetime="<?= get_post_time('c', true); ?>"><span class="day"><?= get_the_date('d'); ?></span><span class="month"><?= get_the_date('M Y'); ?></span> </time>
<?php 

if(is_single()){
	$categories=get_the_category();

	if(count($categories)>0){
	?>
	<ul class="entry-category-list">
	<?php
	foreach ($categories as $key => $category) {
		$cat = get_category( $category );
		?>
	<li class="entry-category">
		<a href="<?= get_category_link( $category ); ?>"><?= $cat->name; ?></a>
	</li>
	<?php
	}
	?>
	</ul> 
	<?php
	}
}
?>
<!--
<p class="byline author vcard"><? // __('By', 'sage'); ?> <a href="<? // get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><? // get_the_author(); ?></a></p>
-->
</div> 