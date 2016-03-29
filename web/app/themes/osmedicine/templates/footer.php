<footer class="content-info">
<span class="left">&copy;2016 Marco Gesualdi</span><span class="right">
<?php $page=get_page_by_title( 'Credits' );
    $content = apply_filters('the_content', $page->post_content); 
    if($content !=="") {
    ?>
<a class="credits" style="margin-right:1rem;" href="#credits" >Credits</a> <?php } ?> Web Agency Menthalia</span> 
</footer>

<div id="credits" >
	<h3> Credits </h3>
	<?php  echo $content; ?>
</div>
