<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );


function ln_custom_fonts_init( $init ) {
	 
    $custom_fonts = "Andale Mono=andale mono,times;".
                    "Arial=arial,helvetica,sans-serif;".
                    "Arial Black=arial black,avant garde;".
                    "Book Antiqua=book_antiquaregular,palatino;".
                    "Corda Light=CordaLight,sans-serif;".
                    "Courier New=courier_newregular,courier;".
                    "Droid serif=droid-serif;".
                    "Droid Serif Italic=DroidSerif-Italic;". 
                    "Droid Serif Bold=DroidSerif-Bold;". 
                    "Droid Sans=droid-sans;".
                    "Droids Sans Italic=Droids-SansItalic;".
                    "Droid Sans Bold=DroidSans-Bold;".
                    "Flexo Caps=FlexoCapsDEMORegular;".                 
                    "Lucida Console=lucida_consoleregular,courier;".
                    "Georgia=georgia,palatino;".
                    "Helvetica=helvetica;".
                    "Impact=impactregular,chicago;".
                    "Interstatelight=interstatelight;".
                    "Interstate Italic=Interstate-LightItalic;".
                    "Interstate Bold=interstatebold;".
                    "Interstate BoldItalic=Interstate-BoldItalic;".
                    "Museo Slab=MuseoSlab500Regular,sans-serif;".                   
                    "Museo Sans=MuseoSans500Regular,sans-serif;".
                    "Oblik Bold=OblikBoldRegular;".
                    "Sofia Pro Light=SofiaProLightRegular;".                    
                    "Symbol=webfontregular;".
                    "Tahoma=tahoma,arial,helvetica,sans-serif;".
                    "Terminal=terminal,monaco;".
                    "Tikal Sans Medium=TikalSansMediumMedium;".
                    "Times New Roman=times new roman,times;".
                    "Trebuchet MS=trebuchet ms,geneva;".
                    "Verdana=verdana,geneva;".
                    "Webdings=webdings;".
                    "Wingdings=wingdings,zapf dingbats".
                    "Aclonica=Aclonica, sans-serif;".
                    "Michroma=Michroma;".
                    "Paytone One=Paytone One, sans-serif;".
                    "Andalus=andalusregular, sans-serif;".
                    "Arabic Style=b_arabic_styleregular, sans-serif;".
                    "Andalus=andalusregular, sans-serif;".
                    "KACST_1=kacstoneregular, sans-serif;".
                    "Mothanna=mothannaregular, sans-serif;".
                    "Nastaliq=irannastaliqregular, sans-serif;".
                    "Samman=sammanregular;";
    $init['font_formats'] = $custom_fonts;
    // Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => '.translation',  
			'block' => 'blockquote',  
			'classes' => 'translation',
			'wrapper' => true,
			
		),  
		array(  
			'title' => '⇠.rtl',  
			'block' => 'blockquote',  
			'classes' => 'rtl',
			'wrapper' => true,
		),
		array(  
			'title' => '.ltr⇢',  
			'block' => 'blockquote',  
			'classes' => 'ltr',
			'wrapper' => true,
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init['style_formats'] = json_encode( $style_formats );  
    return $init;
}
add_filter( 'tiny_mce_before_init', 'ln_custom_fonts_init' );

add_action( 'init', 'customize_font_list' );
function customize_font_list(){
 
    $custom_fonts = array(
        'Interstatelight' => array(
            'fallback' => 'interstatelight',
          
        ),
         'Interstate Italic' => array(
            'fallback' => 'Interstate-LightItalic',
          
        ),
        'Interstate Bold' => array(
            'fallback' => 'interstatebold',
          
        ),
        'Interstate BoldItalic' => array(
            'fallback' => 'Interstate-BoldItalic',
          
        )
    );
 
    foreach($custom_fonts as $name => $settings){
        // Add to Theme Customizer
        if(class_exists('FLFontFamilies') && isset(FLFontFamilies::$system)){
            FLFontFamilies::$system[$name] = $settings;
        }
 
        // Add to Page Builder
        if(class_exists('FLBuilderFontFamilies') && isset(FLBuilderFontFamilies::$system)){
            FLBuilderFontFamilies::$system[$name] = $settings;
        }
    }
}


add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {

    if ( !empty($url) )
    $url .= ',';

    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( get_stylesheet_directory_uri() ) . 'css/custom-css.css';
    return $url;
}


add_filter( 'tiny_mce_before_init', 'fb_mce_before_init225' );

function fb_mce_before_init225( $settings ) {

    $style_formats = array(
      
        array(
            'title' => 'Interstate BoldItalic',
            'inline' => 'span',
            'styles' => array(
                'font-family'         => 'Interstate-BoldItalic', // or hex value #ff0000
                
            )
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
