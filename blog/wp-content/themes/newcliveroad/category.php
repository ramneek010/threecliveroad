<?php get_header(); ?>
<?php  $queried_object = get_queried_object(); ?>
<div class="blogWrapper">
		<div class="explore">
			<h3 id="sectionTitle">
				<?php echo $queried_object->name ?>
			</h3>
			<div class="articles">
				<?php 
				$blog_List_args = array('post_type' => 'post','fields' => 'ids', 'posts_per_page' => 10, 'post_status' => 'publish', 'orderby' => 'date','order' =>'DESC',
										'tax_query' => array(array('taxonomy' => 'category','fields'=>'term_id', 'terms'=>array($queried_object->term_id)))
									   );
				$blog_List_Query = new WP_Query( $blog_List_args );  
				if($blog_List_Query->have_posts()){
			?>
				<ul class="blogs">
						<?php while($blog_List_Query->have_posts()) { $blog_List_Query->the_post() ?>
							<?php $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'thumbnail')[0]; ?>
							<?php $imgsrc = $imgsrc != '' ? $imgsrc : 'http://www.threecliveroad.com/blog/wp-content/uploads/2017/11/dummyimage-360x280.jpg'?>
					<li>
						<a href="<?php the_permalink() ?>" title="<?php echo get_the_title() ?>">
							<img src="<?php echo $imgsrc ?>" title="<?php echo get_the_title() ?>" alt="<?php echo alt_tag( get_the_ID() ) ?>">
						</a>
						<a id="date" href="<?php the_permalink() ?>"><?php echo get_the_date('d.M.Y',get_the_ID()) ?></a>
						<a id="description" href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a>
					</li>
					<?php } ?>
				
					
				</ul>
			<?php } ?>
		
			</div>
			<div class="loadMore" style="margin: 0px auto;">
			<input type="hidden" value="2" name="current_page" id="current_page">
			<h5><a href="javascript:void(0)" id="load_more">LOAD MORE</a></h5>
		</div>
		</div>
	</div>

<script>
	jQuery(document).ready(function() {
		jQuery('#load_more').click(function(){
			var current_page = jQuery("#current_page").val();
			var term_id = '<?php echo $queried_object->term_id ?>';
			jQuery(this).html('Please wait');
			jQuery(this).attr('id','load_mores');
			jQuery('#load_mores').html('Please wait');
			jQuery.post('<?php echo admin_url("admin-ajax.php") ?>',{'paged':current_page,'term_id':term_id, 'action':'category_wise_more_post'},function(rst){
				jQuery('#load_mores').attr('id','load_more');
				if(rst == 0 ) {
					jQuery('#load_more'). html('NO MORE BLOG');
				} else {
					var update_current_page = parseInt(jQuery("#current_page").val())+1;
					jQuery("#current_page").val(update_current_page);
					jQuery('.blogs'). append(rst);
					jQuery('#load_more'). html('LOAD MORE');
				}
			});
			return false;
		});
	});
</script>
<?php get_footer(); ?>
