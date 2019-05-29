<?php get_header();
global $post, $wpdb;
$rs = $wpdb->get_row("SELECT * FROM ".$wpdb->posts." WHERE ID = ".$post->ID." ", ARRAY_A);
//print_R($rs);
 ?>
<div class="blogWrapper">
	
		<?php $terms  = wp_get_post_terms($post->ID,'category'); ?>
		<?php $img 	  = get_the_post_thumbnail_url($post->ID, 'full'); ?>
		<?php //$rs = $wpdb->row("SELECT post_title FROM $wpdb->prefix.'posts' "); ?>
		<div class="postMain">
			<div class="postHeader">
				<div class="row">
					<div class="col span_12">
						<h6 id="date"><?php echo get_post_meta($post->ID, 'date_and_place', true) ?></h6>
					</div>
					<!--div class="col span_6">
						<?php ?>
						<a href="<?php //echo get_term_link($terms[0]->name, $terms[0]->taxonomy ) ?>"><h6 id="title"> <?php //echo $terms[0]->name ?></h6></a>
					</div-->
				</div>
			</div> 
			<div class="postHeading">
				<h3 id="heading"><?php echo $rs['post_title'] ?></h3>
				
			</div>
			<div class="postImage">
				<a href="javascript:void(0)"><img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php echo alt_tag($post->ID) ?>" title="<?php echo get_the_title() ?>" align="center"></a>
				<div class="imageCaption">
					<?php $imgid = get_post_thumbnail_id($post->ID);
					echo $image_alt = get_post_meta( $imgid, '_wp_attachment_image_alt', true);
					?>
				</div>
			</div>
			<div class="postBody">
				<?php echo wpautop($rs['post_content']) ?>
			</div>
		</div>
		
		<div class="explore">
			<h3 id="sectionTitle">More to explore</h3>
			<div class="articles">
				<?php 
				 $terms = wp_get_post_terms(get_the_ID(),'category', array('fields' => 'ids'));
				 $blog_List_args = array('post_type' => 'post', 'posts_per_page' => 5, 'post_status' => 'publish', 'orderby' => 'rand',
										'tax_query' => array(array('taxonomy' => 'category','fields'=>'term_id', 'terms'=>$terms))
									   );
				$blog_List_Query = get_posts( $blog_List_args );  
				if(count($blog_List_Query) > 0 ){
			?>
				<ul class="blogs">
						<?php foreach($blog_List_Query as $blog_List_result ) { ?>
							<?php $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($blog_List_result->ID),'thumbnail')[0]; ?>
							<?php $imgsrc = $imgsrc != '' ? $imgsrc : 'http://www.threecliveroad.com/blog/wp-content/uploads/2017/11/dummyimage-360x280.jpg'?>
							<?php $datePlace = get_post_meta($blog_List_result->ID,'date_and_place', true); ?>
					<li>
						<a href="<?php echo get_permalink( $blog_List_result->ID ) ?>" title="<?php echo $blog_List_result->post_title ?>">
							<img src="<?php echo $imgsrc ?>" title="<?php echo $blog_List_result->post_title ?>" alt="<?php echo alt_tag( $blog_List_result->ID ) ?>">
						</a>
						
						<a id="date" href="<?php echo get_permalink($blog_List_result->ID) ?>"><?php echo $blog_List_result->post_title ?></a>
						<a id="description" href="<?php get_permalink($blog_List_result->ID) ?>"><?php echo $datePlace!= '' ? $datePlace : get_the_date('F Y',$blog_List_result->ID) ?></a>
					</li>
					<?php } ?>
				
					
				</ul>
			<?php } ?>
			</div>
		</div>
	</div>
	<?php get_footer() ?>
