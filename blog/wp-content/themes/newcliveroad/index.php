<?php 
	global $wpdb; 
    get_header(); 
     
	$blog_banner_args = array('post_type' => 'post', 'posts_per_page' => 4, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC',
								/*'meta_query' => array(array('key' => 'home_banner_url', 'value' => '0','compare' => '!=')) */
							  );
	$blog_banner_Query = get_posts( $blog_banner_args );  
	if(count($blog_banner_Query) > 0 ){
?>

 <div class="fixparent">
		<div class="homeSlider">
			<?php foreach($blog_banner_Query as $blog_banner_reslt) {  ?>
			<?php //$url = get_post_meta(get_the_ID(),'home_banner_url', true);   ?>
			<?php $imgsrc = get_the_post_thumbnail_url($blog_banner_reslt->ID,'full'); ?>
			<?php $url = $imgsrc != '' ? $imgsrc : 'https://dummyimage.com/500x500/ccc/000' ?>
			<div class="item <?php echo $blog_banner_reslt->ID?>">
				<div class="slider-img" style="overflow: hidden;padding: 0% 5%;">
					<a href="<?php echo get_permalink($blog_banner_reslt->ID) ?>" style="background: url(<?php echo $url ?>) no-repeat center center / cover; display: block;"><img src="<?php echo $url ?>" title="<?php echo $blog_banner_reslt->post_title; ?>" alt="<?php echo alt_tag( $blog_banner_reslt->ID ) ?>" style="opacity:0;"/></a>
				</div>
				<div class="sliderBody">
					<h3><?php echo $blog_banner_reslt->post_title ?></h3>
					<p><a href="<?php echo get_permalink($blog_banner_reslt->ID) ?>">READ MORE</a></p>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>  
<?php } ?>	
	
	<?php 
		$blog_List_args = array('post_type' => 'post', 'offset' => 4, 'posts_per_page' => 6, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC' );
		$blog_List_Query = get_posts( $blog_List_args );  
			if(count($blog_List_Query) > 0 ){
	?>
	<div class="blogs">
		<div class="container">
			<div class="row responsive">
				<?php foreach($blog_List_Query as $blog_List_result) { ?>
					<?php $imgsrc = get_the_post_thumbnail_url($blog_List_result->ID,'full'); ?>
					<?php $imgsrc = $imgsrc != '' ? $imgsrc : 'http://www.threecliveroad.com/blog/wp-content/uploads/2017/11/dummyimage-360x280.jpg'?>
				<div class="col span_4">
					<div class="postImage">
						<a href="<?php echo get_permalink($blog_List_result->ID) ?>">
							<img src="<?php echo $imgsrc ?>" alt="<?php echo alt_tag( $blog_List_result->ID ) ?>" height="auto" width="500px">
						</a>
					</div>
					<div class="postMeta">	
						<h3>
							<a href="<?php echo get_permalink($blog_List_result->ID) ?>"><?php echo $blog_List_result->post_title ?></a>
						</h3>
					</div>
					<?php $blog_list_content = $blog_List_result->post_excerpt != '' ? $blog_List_result->post_excerpt : $blog_List_result->post_content ?>
					<div class="postBody">
						<p class="excerpt"><?php echo wp_trim_words($blog_list_content,20,'...'); ?> </p>
						<p><a href="<?php echo get_permalink($blog_List_result->ID) ?>">READ MORE</a></p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="loadMore">
			<input type="hidden" value="2" name="current_page" id="current_page">
			<h5><a href="javascript:void(0)" id="load_more">LOAD MORE</a></h5>
		</div>
	</div>
	<?php } ?>
	<div class="followUs">
		<h5>FOLLOW US</h5> 
		<?php $ge_option = get_option('addition_field'); ?>
		<div class="social">
			<p>
                <span><a href="<?php echo $ge_option['facebook'] ?>" target="_blank"><img src="<?php echo $ge_option['home_banner_url'] ?>" title="Follow us on Facebook" alt="FB" width="auto" height="auto;"></a></span>
				<a id="title" href="<?php echo $ge_option['facebook'] ?>" target="_blank">FACEBOOK</a>
			</p>
			<p>
				<span><a href="<?php echo $ge_option['instagram'] ?>" target="_blank"><img src="<?php echo $ge_option['instagram_img_url'] ?>" title="Follow us on Instagram" alt="insta" width="auto" height="auto;"></a></span>                
				<a id="title" href="<?php echo $ge_option['instagram'] ?>" target="_blank">INSTAGRAM</a>
			</p>
			
			<p>
				<span><a href="<?php echo $ge_option['twitter'] ?>" target="_blank"><img src="<?php echo $ge_option['twitter_img_url'] ?>" title="Follow us on Pinterest" alt="Pinterest" width="auto" height="auto;"></a></span>
				<a id="title" href="<?php echo $ge_option['twitter'] ?>" target="_blank">PINTEREST</a>
			</p>
		</div>
		<div class="quote">
			<p><?php echo $ge_option['quotes'] ?></p>
		</div>
	</div>
	
		
	</div>
<script>
		
	jQuery(document).ready(function() {
		
		jQuery("#load_more").on("click", function(){ // When btn is clicked.
			jQuery("#load_more").html('Loading...');
			jQuery("#load_more").attr("disabled",true); // Disable the button, temp.
			load_more_post();
		});
		
		var ppp = 6; // Post per page
		var pageNumber = 1;		
		
		function load_more_post(){
			pageNumber++;
			var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=load_more';
			jQuery.ajax({
				type: "POST",
				dataType: "html",
				url: '<?php echo admin_url("admin-ajax.php") ?>',
				data: str,
				success: function(response){
					
					if(response == 0) {											
						jQuery("#load_more").html("No more post found");
					} else {
					
					jQuery("#load_more").html('LOAD MORE');
					jQuery("#load_more").attr("disabled",false);
					jQuery(".responsive").append(response);
					
					resizeImages(); //call resize function.
					
				}
			}

			});
			return false;
		}
		
		
	});
	
jQuery(window).resize( function() {
	resizeImages(); //call resize function.
});

jQuery(window).load( function() {
	resizeImages(); //call resize function.
});

function resizeImages(){
	jQuery('.homeSlider img').each(function() {
		 var widths = jQuery(this).width();
		 jQuery(this).parent('a').height(widths);
	});
	jQuery('.postImage').each(function() {
		 var widths = jQuery(this).find('img').width();
		 jQuery(this).find('img').height(widths);
	});
}
</script>

<?php get_footer() ?>
