<?php
add_action('after_setup_theme', 'theme_stetup');
function theme_stetup() {
	add_theme_support( 'post-thumbnails', array( 'post' ) );
	add_image_size( 'custom-size', 360, 280, true );
	add_image_size( 'banner-size', 567, 567, true );
	add_image_size( 'clive-thumb', 329, 356, true );
	
	add_image_size( 'clive-new-size', 500, 500, true );
}

function alt_tag($postid) {
	  $imgid = get_post_thumbnail_id($postid);
	  $image_alt = get_post_meta( $imgid, '_wp_attachment_image_alt', true);
	  if($image_alt != '' ) {
		  $alt = $image_alt;
	  } else {
		  $alt = get_the_title($postid);
	  }
	  return $alt; 
}
function load_more(){
	header("Content-Type: text/html");
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0; 
    
    
	$blog_List_args = array('post_type' => 'post', 'offset' => ($ppp*($page-1)) + 4, 'paged' => $page, 'posts_per_page' => $ppp, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC' );
	$blog_List_Query = get_posts( $blog_List_args );  
	//echo $blog_List_Query->request;
		if(count($blog_List_Query)){
		 foreach($blog_List_Query as $blog_List_result) { ?>
			<?php $imgsrc = get_the_post_thumbnail_url($blog_List_result->ID,'large'); ?>
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
<?php 
		} 
	}  else {
		echo 0;
	}
	die();
}
add_action('wp_ajax_load_more','load_more');
add_action('wp_ajax_nopriv_load_more','load_more');

	add_action( 'add_meta_boxes', 'custom_meta_fields' );
	function custom_meta_fields() {
		add_meta_box('Home Banner','Home Banner' ,'custom_meta_fields_html', 'post', 'advanced', 'high');
		
	}

function custom_meta_fields_html(){
	 global $post;
   $url =get_post_meta($post->ID,'home_banner_url', true);  
   
    ?>
    <style>
	
		.div_clone{
			margin-bottom:20px;
		}
    </style>
     <div class="div_clone_001">
		
		<div class="div_clone">
		<input id="home_banner_url" class="home_banner_url" name="home_banner_url" type="text" value="<?php echo $url != '0' ? $url : ''; ?>"  style="width:400px;" />
		<input id="my_upl_button" class="my_upl_button" type="button" value="Upload Image" />
		<br/>
		<img src="<?php echo $url != '0' ? $url : '';?>" style="<?php echo $url != '0' ? 'width:150px;' : '' ?>" id="picsrc" class="picsrc"/>
	
		</div>
		
    </div>
   
    <script>
    jQuery(document).ready( function( $ ) {
        jQuery('.my_upl_button').live('click', function() {
			var selecter = jQuery(this);
            window.send_to_editor = function(html) {
                imgurl = jQuery(html).attr('src');
                selecter.parent().find('.home_banner_url').val(imgurl);
                selecter. parent().find('.picsrc').attr("src",imgurl);
                selecter. parent().find('.picsrc').css("width",'150px');
                tb_remove();
            }
            formfield = jQuery('.home_banner_url').parent( ".div_clone" ).attr('name');
            tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true&tab=library' );
            return false;
        });
       
		
    });
    </script>
  <?php
}

function custom_fields_save_post($postid,$post){
	$home_banner_url = $_POST['home_banner_url'];
	delete_post_meta($postid,'home_banner_url');
	$home_banner_url = $home_banner_url == '' ? 0 : $home_banner_url;
	if(count($home_banner_url) > 0 ) {
		add_post_meta($postid,'home_banner_url',$home_banner_url);
	}
}

add_action('save_post', 'custom_fields_save_post');

function get_attachment_id_by_url( $url, $size ) { 
	
	$parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );
	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );
	if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
		return;
	}
	global $wpdb;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );
    $imgURL =   wp_get_attachment_image_src($attachment[0], $size);
	 
	 return $imgURL[0];
	
}
add_action('admin_menu', 'create_menu_themes_menu');

function create_menu_themes_menu() {

	//create new top-level menu
	add_menu_page('Themes setting', 'Themes setting', 'administrator', 'themes-setting', 'themes_html' );

	//call register settings function
	add_action( 'admin_init', 'register_themes_settings' );
}


function register_themes_settings() {
	//register our settings
	register_setting( 'additional-fields', 'addition_field' );
}
function themes_html() {
?>
<div class="wrap">
<h1>Your Plugin Name</h1>
<?php $geto = get_option('addition_field'); ?>
<form method="post" action="options.php">
    <?php settings_fields( 'additional-fields' ); ?>
    <?php do_settings_sections( 'additional-fields' ); ?>
    <table class="form-table">
		<tr valign="top">
        <th scope="row">Facebook Image URL</th>
		<td> <input id="home_banner_url" class="home_banner_url" id="addition_field[home_banner_url]" name="addition_field[home_banner_url]" type="text" value="<?php echo esc_attr( $geto['home_banner_url'] ); ?>"  style="width:400px;" />
		<input id="my_upl_button" class="my_upl_button" type="button" value="Upload Image" />
		<br/>
		<img src="<?php echo esc_attr( $geto['home_banner_url'] ); ?>" style="<?php echo $url != '0' ? 'width:150px;' : '' ?>" id="picsrc" class="picsrc"/>
	
		</td>
		</tr>
    
        <tr valign="top">
        <th scope="row">Facebook URL</th>
        <td><input type="text" name="addition_field[facebook]" style="width: 400px;" value="<?php echo esc_attr( $geto['facebook'] ); ?>" /></td>
        </tr>
         <tr valign="top">
        <th scope="row">Instagram Image URL</th>
		<td> <input id="home_banner_url1" class="home_banner_url1" id="addition_field[instagram_img_url]" name="addition_field[instagram_img_url]" type="text" value="<?php echo esc_attr( $geto['instagram_img_url'] ); ?>"  style="width:400px;" />
		<input id="my_upl_button1" class="my_upl_button1" type="button" value="Upload Image" />
		<br/>
		<img src="<?php echo esc_attr( $geto['instagram_img_url'] ); ?>" style="<?php echo $geto['instagram_img_url']!= '0' ? 'width:150px;' : '' ?>" id="picsrc1" class="picsrc1"/>
	
		</td>
		</tr>
        <tr valign="top">
        <th scope="row">Instagram URL</th>
        <td><input type="text" name="addition_field[instagram]" style="width: 400px;" value="<?php echo esc_attr( $geto['instagram'] ); ?>" /></td>
        </tr>
         <tr valign="top">
        <th scope="row">Twitter Image URL</th>
		<td> <input id="home_banner_url2" class="home_banner_url2" id="addition_field[twitter_img_url]" name="addition_field[twitter_img_url]" type="text" value="<?php echo esc_attr( $geto['twitter_img_url'] ); ?>"  style="width:400px;" />
		<input id="my_upl_button2" class="my_upl_button2" type="button" value="Upload Image" />
		<br/>
		<img src="<?php echo esc_attr( $geto['twitter_img_url'] ); ?>" style="<?php echo $geto['twitter_img_url']!= '0' ? 'width:150px;' : '' ?>" id="picsrc2" class="picsrc2"/>
	
		</td>
		</tr>
        <tr valign="top">
        <th scope="row">Twitter URL</th>
        <td><input type="text" name="addition_field[twitter]" style="width: 400px;" value="<?php echo esc_attr( $geto['twitter'] ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Quotes</th>
        <td><textarea name="addition_field[quotes]" style="width: 400px;height:100px;"><?php echo esc_attr( $geto['quotes'] ); ?></textarea></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<script>

	jQuery(document).ready(function() {
		jQuery('.my_upl_button').live('click', function() {
				var selecter = jQuery(this);
				window.send_to_editor = function(html) {
					imgurl = jQuery(html).attr('src');
					selecter.parent().find('.home_banner_url').val(imgurl);
					selecter. parent().find('.picsrc').attr("src",imgurl);
					selecter. parent().find('.picsrc').css("width",'150px');
					tb_remove();
				}
				formfield = jQuery('.home_banner_url').attr('name');
				tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true&tab=library' );
				return false;
			});
			jQuery('.my_upl_button1').live('click', function() {
				var selecter = jQuery(this);
				window.send_to_editor = function(html) {
					imgurl = jQuery(html).attr('src');
					selecter.parent().find('.home_banner_url1').val(imgurl);
					selecter. parent().find('.picsrc1').attr("src",imgurl);
					selecter. parent().find('.picsrc1').css("width",'150px');
					tb_remove();
				}
				formfield = jQuery('.home_banner_url1').attr('name');
				tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true&tab=library' );
				return false;
			});
			jQuery('.my_upl_button2').live('click', function() {
				var selecter = jQuery(this);
				window.send_to_editor = function(html) {
					imgurl = jQuery(html).attr('src');
					selecter.parent().find('.home_banner_url2').val(imgurl);
					selecter. parent().find('.picsrc2').attr("src",imgurl);
					selecter. parent().find('.picsrc2').css("width",'150px');
					tb_remove();
				}
				formfield = jQuery('.home_banner_url2').attr('name');
				tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true&tab=library' );
				return false;
			});
	});
</script>
<?php } 

function load_admin_things() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

add_action( 'admin_enqueue_scripts', 'load_admin_things' );


function category_wise_more_post(){
	$paged = $_POST['paged'];
	$term_id = $_POST['term_id'];
	$paged = $paged != '' ? $paged : 1;
	$blog_List_args = array('post_type' => 'post','fields' => 'ids','paged'=> $paged,'posts_per_page' => 10, 'post_status' => 'publish', 'orderby' => 'date','order' =>'DESC',
										'tax_query' => array(array('taxonomy' => 'category','fields'=>'term_id', 'terms'=>array($term_id)))
									   );
	$blog_List_Query = new WP_Query( $blog_List_args );  
	if($blog_List_Query->have_posts()){
		 while($blog_List_Query->have_posts()) { $blog_List_Query->the_post() ?>
			<?php $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'thumbnail')[0]; ?>
			<?php $imgsrc = $imgsrc != '' ? $imgsrc : 'http://www.threecliveroad.com/blog/wp-content/uploads/2017/11/dummyimage-360x280.jpg'?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo get_the_title() ?>">
				<img src="<?php echo $imgsrc ?>" title="<?php echo get_the_title() ?>" alt="<?php echo alt_tag( get_the_ID() ) ?>">
				</a>
				<a id="date" href="<?php the_permalink() ?>"><?php echo get_the_date('d.M.Y',get_the_ID()) ?></a>
				<a id="description" href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a>
			</li>
<?php 
		} 
	} else {
		echo 0;
	}
	die();
}
add_action('wp_ajax_category_wise_more_post','category_wise_more_post');
add_action('wp_ajax_nopriv_category_wise_more_post','category_wise_more_post');
