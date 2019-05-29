<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php do_action( 'fl_head_open' ); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo apply_filters( 'fl_theme_viewport', "<meta name='viewport' content='width=device-width, initial-scale=1.0' />\n" ); ?>
<?php echo apply_filters( 'fl_theme_xua_compatible', "<meta http-equiv='X-UA-Compatible' content='IE=edge' />\n" ); ?>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" href="http://www.threecliveroad.com/media/favicon/default/Clive_Favicon_310316_Final.jpg" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.threecliveroad.com/media/favicon/default/Clive_Favicon_310316_Final.jpg" type="image/x-icon" />
<?php FLTheme::title(); ?>
<?php FLTheme::favicon(); ?>
<?php FLTheme::fonts(); ?>
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid Serif:300,400,700" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid Sans:400" />
    
<link rel="stylesheet" href="https://use.typekit.net/ptr4boi.css">

<?php

wp_head();

FLTheme::head();

?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">
<?php

FLTheme::header_code();

do_action( 'fl_body_open' );

?>
<div class="fl-page">
	<?php

	do_action( 'fl_page_open' );

	//FLTheme::fixed_header();

	do_action( 'fl_before_top_bar' );

	//FLTheme::top_bar();

	do_action( 'fl_after_top_bar' );
	do_action( 'fl_before_header' );

	//FLTheme::header_layout();

	do_action( 'fl_after_header' );
	do_action( 'fl_before_content' );

	?>
	<div class="fl-page-content" itemprop="mainContentOfPage">

		<?php do_action( 'fl_content_open' ); ?>
        
     
<header id="header" class="page-header">
    <div class="page-header-container headerContainer">
        <div class="row">
            <div class="col span_12">
            <div class="home-logo">
                <a class="logo" href="http://www.threecliveroad.com/index.php/">
                    <img src="http://www.threecliveroad.com/skin/frontend/clive/master/images/Clive_logo_133_76px.png" alt="No. 3 Clive Road" class="small">
                </a>
            </div><!--
            --><div class="navigation">
                    <div class="mobile-nav"><i class="fa fa-navicon fa-2x"></i></div>
                    <nav id="nav">
                <ol class="nav-primary">
                    <li class="level0 nav-1 first"><a href="http://www.threecliveroad.com/index.php/tea.html" class="level0">Tea</a></li><li class="level0 nav-2"><a href="http://www.threecliveroad.com/index.php/paper.html" class="level0">Paper</a></li><li class="level0 nav-3"><a href="http://www.threecliveroad.com/index.php/accessories.html" class="level0">Accessories</a></li><li class="level0 nav-4"><a href="http://www.threecliveroad.com/index.php/journal.html" class="level0">Journal</a></li><li class="level0 nav-5 last"><a href="http://www.threecliveroad.com/index.php/press.html" class="level0">Press</a></li>
                    <li class="level0 nav-6 last onlyMobile"><a href="http://www.threecliveroad.com/tea@3/" class="level0 tea3Hover"><img src="http://www.threecliveroad.com/skin/frontend/clive/master/images/tea@3-logo.svg" title="tea@3" alt="tea@3" style="height: 19px;vertical-align: middle;width: 60px;" class="mouseHoverOut">
            <img src="http://www.threecliveroad.com/skin/frontend/clive/master/images/tea@3-yellow-logo.svg" title="tea@3" alt="tea@3" style="height: 19px;vertical-align: middle;width: 60px;" class="mouseHoverShow">
            <img src="http://www.threecliveroad.com/skin/frontend/clive/master/images/tea@3-black.svg" title="tea@3" alt="tea@3" style="height: 19px;vertical-align: middle;width: 60px;" class="onlyMobileShow"></a>
            </li>
                       
                </ol>
            </nav>
                </div>
            </div>
        </div>
    </div>
</header>

        
<?php /* ?>        
<?php wp_head(); ?>
<?php echo file_get_contents('http://www.threecliveroad.com/blog-header'); ?>
<?php */ ?>
        
<script>
    jQuery(document).ready(function () {
        jQuery('.mobile-nav').click(function () {
           jQuery('nav#nav').slideToggle(); 
        });
    });
</script>
