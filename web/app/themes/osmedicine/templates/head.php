<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 
   $all_page_background_id=get_field('other_pages_background_image','option');
   $home_page_background_id=get_field('full-width_background_image','option');   
   ?>
  <style>
  	.page-wrapper {    
      background-image: url(<?php echo wp_get_attachment_url( $all_page_background_id ); ?> );
    }
    body.home .page-wrapper {    
      background-image: url(<?php echo wp_get_attachment_url( $home_page_background_id  ); ?> );
    }
  </style>
  <?php wp_head(); ?>
</head>
