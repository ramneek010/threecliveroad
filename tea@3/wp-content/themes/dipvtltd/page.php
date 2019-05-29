<?php get_header();
global $post, $wpdb;
//print_R($rs);
 ?>
<?php while(have_posts() ) { the_post() ?>
	<?php echo the_content() ?>
<?php } ?>
<?php get_footer() ?>
