<?php	

/**
 * safreen functions and definitions
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 */

/*
 * Set up the content width value based on the theme's design.
 *
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function safreen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'safreen_content_width', 1000 );
}
add_action( 'after_setup_theme', 'safreen_content_width', 0 );



if ( ! function_exists( 'safreen_setup' ) ) :
//**************safreen SETUP******************//
function safreen_setup() {
//Custom Background
add_theme_support( 'custom-background', array(
	'default-color' => 'FFF',
	
) );

/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
add_theme_support( 'title-tag' );
		
		
// Add default posts and comments RSS feed links to head.
add_theme_support('automatic-feed-links');


// Declare WooCommerce support
add_theme_support( 'woocommerce' );



// Declare HTML5 search-form
add_theme_support( 'html5', array( 'search-form' ) );



//Post Thumbnail	
add_theme_support( 'post-thumbnails' );

//Register Menus
register_nav_menus( array(
		'primary' => __( 'Primary Navigation(Header)', 'safreen' ),
		
	) );

// Enables post and comment RSS feed links to head
add_theme_support('automatic-feed-links');

/*
	 * Enable support for custom logo.
	 *
	 *  @since safreen
	 */
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width' => true,
		
	) );
	add_theme_support( 'custom-logo', array(
   'header-text' => array( 'site-title', 'site-description' ),
) );
	

/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on safreen, use a find and replace
		 * to change 'safreen' to the name of your theme in all the template files
		 */
		 
load_theme_textdomain('safreen', get_template_directory() . '/languages');  
 
 
}
endif; // safreen_setup
add_action( 'after_setup_theme', 'safreen_setup' );



if ( ! function_exists( 'safreen_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since safreen
 */
function safreen_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


/* safreen first image */

function safreen_catch_that_image() {
global $post, $posts;
ob_start();
ob_end_clean();
if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)){
$safreenfirst_img = $matches [1] [0];
return $safreenfirst_img;
}
else {
$safreenfirst_img = esc_url(get_template_directory_uri()."/images/blank1.jpg");
return $safreenfirst_img;
}
}


//Custom Excerpt Length
function excerpt($limit_safreen) {
  $excerpt = explode(' ', get_the_excerpt(), $limit_safreen);
  if (count($excerpt)>=$limit_safreen) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 

//Load CSS files

function safreen_scripts() {
wp_enqueue_style( 'safreen-style', get_stylesheet_uri() );	
wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fonts/awesome/css/font-awesome.min.css','font_awesome', true );
wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.css','foundation_css', true );
wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css','animate_css', true );
wp_enqueue_style( 'safreen_mobile', get_template_directory_uri() . '/css/safree-mobile.css' ,'safreenmobile_css', true);
wp_enqueue_style( 'sidrcss', get_template_directory_uri() . '/css/jquery.sidr.dark.css' ,'mobilemenu', true);
wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' ,'normalize_css', true);
wp_enqueue_style( 'safreen-fonts', safreen_fonts_url(), array(), null );

$safreen_header_checkbox = get_theme_mod('safreen_header_checkbox',1);
if( isset($safreen_header_checkbox) && $safreen_header_checkbox == 0 ){
wp_enqueue_style( 'safreen_header_check', get_template_directory_uri() . '/css/customcss/header_checkbox.css' ,'header_check', true);

}
$safreen_body_layout = get_theme_mod('safreen_body_layout',0);
if( isset($safreen_body_layout) && $safreen_body_layout == 1 ){
wp_enqueue_style( 'safreen_body_check', get_template_directory_uri() . '/css/customcss/body_layout.css' ,'body_layout', true);

}
$safreen_sticky_menu = get_theme_mod('safreen_sticky_menu',1);
if( isset($safreen_sticky_menu) && $safreen_sticky_menu == 0 ){
wp_enqueue_style( 'safreen_sticky_check', get_template_directory_uri() . '/css/customcss/sticky_menu.css' ,'sticky_menu', true);

}
$safreen_mobile_slider = get_theme_mod('safreen_mobile_slider',1);
if( isset($safreen_mobile_slider) && $safreen_mobile_slider == 0 ){
wp_enqueue_style( 'safreen_mobileslider_check', get_template_directory_uri() . '/css/customcss/mobile_slider.css' ,'mobile_slider', true);

}
$safreen_mobile_sidebar = get_theme_mod('safreen_mobile_sidebar',1);
if( isset($safreen_mobile_sidebar) && $safreen_mobile_sidebar == 0 ){
wp_enqueue_style( 'safreen_mobilesidebar_check', get_template_directory_uri() . '/css/customcss/mobile_sidebar.css' ,'mobile_sidebar', true);

} 
 }
 
 add_action( 'wp_enqueue_scripts', 'safreen_scripts' );


/**
 * Google Fonts
 */

function safreen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Lato, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$Roboto = _x( 'on', 'Roboto font: on or off', 'safreen' );

	/* Translators: If there are characters in your language that are not
	* supported by Noto Serif, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$Roboto_serif = _x( 'on', 'Roboto Sans Serif font: on or off', 'safreen' );

	if ( 'off' !== $Roboto || 'off' !== $Roboto_serif ) {
		$font_families = array();

		if ( 'off' !== $Roboto ) {
			$font_families[] = 'Roboto:400,400italic,700,700italic';
		}

		if ( 'off' !== $Roboto_serif ) {
			$font_families[] = 'Roboto :400,400italic,700,700italic';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Add Google Fonts, editor styles to WYSIWYG editor
 */
function safreen_editor_styles() {
	add_editor_style( array( 'editor-style.css', safreen_fonts_url() ) );
}
add_action( 'after_setup_theme', 'safreen_editor_styles' );



//Load Java Scripts 
function safreen_head_js() { 
if ( !is_admin() ) {
wp_enqueue_script('jquery');
wp_enqueue_script('safreen_js',get_template_directory_uri().'/js/safreen.js' ,array('jquery'), true);
wp_enqueue_script('safreen_other',get_template_directory_uri().'/js/safree_other.js',array('jquery'), true);
 
        # Let's make sure we don't load our pre-loader script in the customizer
        global $wp_customize;

	    # Preloader Enabled ?
        $safreen_body_preloder = get_theme_mod('safreen_body_preloder', '1');

        if ( !isset( $wp_customize ) && $safreen_body_preloder == '1' ) {
            wp_enqueue_script('safreen_preloder',get_template_directory_uri().'/js/safreen-preloder.js',array('jquery'), true);
        } else {
          wp_enqueue_style( 'safreen_preloder', get_template_directory_uri() . '/css/preloder.css' ,'safreen_preloder', true); 
        }
wp_enqueue_script('wow',get_template_directory_uri().'/js/wow.js',array('jquery'), true);
wp_enqueue_script('sidr',get_template_directory_uri().'/js/jquery.sidr.min.js',array('jquery'), true);
wp_enqueue_script('matchHeight',get_template_directory_uri().'/js/jquery.matchHeight.js',array('jquery'), true);

$safreen_Static_Sliderpara = get_theme_mod('safreen_Static_Sliderpara',1);
if( isset($safreen_Static_Sliderpara) && $safreen_Static_Sliderpara == 1 ){
wp_enqueue_script('safreen_StaticSliderh',get_template_directory_uri().'/js/halfparallax.js',array('jquery'), true);
  } else {
wp_enqueue_script('safreen_StaticSlider',get_template_directory_uri().'/js/headerParallax.js',array('jquery'), true);
  }
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

}
}
add_action('wp_enqueue_scripts', 'safreen_head_js');


/**
 * Load css for widgets
 */

function safreen_admin_style() {
  wp_enqueue_style('safreen_widgets_custom_css', get_template_directory_uri() . '/css/safreen_widgets_custom_css.css');
	wp_enqueue_style( 'safreen_fontawesome_custom_css', get_template_directory_uri() . '/fonts/awesome/css/font-awesome.min.css' );
	
	}
add_action('admin_enqueue_scripts', 'safreen_admin_style');


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function safreen_widgets_init(){
	register_sidebar(array(
	'name'          => __('Right Sidebar', 'safreen'),
	'id'            => 'sidebar',
	'description'   => __('Right Sidebar', 'safreen'),
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget_wrap">',
	'after_widget'  => '</div></div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));
	
	register_sidebar(array(
	'name'          => __('Footer Widgets', 'safreen'),
	'id'            => 'foot_sidebar',
	'description'   => __('Widget Area for the Footer', 'safreen'),
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="medium-3 columns">',
	'after_widget'  => '</div></div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));
	
	register_sidebar(array(
	'name'          => __('Service Block', 'safreen'),
	'id'            => 'sidebar-serviceblock',
	'description'   => __('With safreen Free you can only add 3 widgets to this Area. Upgrade to PRO to add unlimited Widgets.', 'safreen'),
	'before_widget' => '',
	'after_widget'  => '',
		));
		
		register_sidebar(array(
	'name'          => __('About Us', 'safreen'),
	'id'            => 'sidebar-aboutus',
	'description'   => __('With safreen Free you can only add 2 widgets to this Area. Upgrade to PRO to add unlimited Widgets.', 'safreen'),
	'before_widget' => '',
	'after_widget'  => '',
		));
		
		
				
		register_sidebar(array(
	'name'          => __('Our Team', 'safreen'),
	'id'            => 'sidebar-ourteam',
	'description'   => __('With safreen Free you can only add 4 widgets to this Area. Upgrade to PRO to add unlimited Widgets.', 'safreen'),
	'before_widget' => '',
	'after_widget'  => '',
		));

register_sidebar(array(
	'name'          => __('Our Client', 'safreen'),
	'id'            => 'sidebar-ourclient',
	'description'   => __('With safreen Free you can only add 1 widgets to this Area. Upgrade to PRO to add unlimited Widgets.', 'safreen'),
	'before_widget' => '',
	'after_widget'  => '',
		));

	
}

add_action( 'widgets_init', 'safreen_widgets_init' );

		
 // recommended plugins.
 
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'safreen_theme_register_required_plugins' );
function safreen_theme_register_required_plugins() {

    /**
* Array of plugin arrays. Required keys are name and slug.
* If the source is NOT from the .org repo, then source is also required.
*/
    $plugins = array(

         // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name' => 'Safreen Widgets', // The plugin name.
            'slug' => 'safreen-widgets', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
         // This is an example of how to include a plugin from a private repo in your theme.
       

    );

    /**
* Array of configuration settings. Amend each line as needed.
* If you want the default strings to be available under your own theme domain,
* leave the strings uncommented.
* Some of the strings are added into a sprintf, so see the comments at the
* end of each line for what each argument will be.
*/
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __( 'Install Required Plugins', 'safreen' ),
            'menu_title' => __( 'Install Plugins', 'safreen' ),
            'installing' => __( 'Installing Plugin: %s', 'safreen' ), // %s = plugin name.
            'oops' => __( 'Something went wrong with the plugin API.', 'safreen' ),
            'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'safreen' ), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'safreen' ), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'safreen' ), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'safreen' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'safreen' ), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'safreen' ), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'safreen' ), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'safreen' ), // %1$s = plugin name(s).
            'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'safreen' ),
            'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'safreen' ),
            'return' => __( 'Return to Required Plugins Installer', 'safreen' ),
            'plugin_activated' => __( 'Plugin activated successfully.', 'safreen' ),
            'complete' => __( 'All plugins installed and activated successfully. %s', 'safreen' ), // %s = dashboard link.
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}


//load widgets ,kirki ,customizer
require(get_template_directory() . '/inc/kirki/kirki.php');
require(get_template_directory() . '/inc/customizer.php');
require(get_template_directory() . '/inc/widgets.php');
require(get_template_directory() . '/inc/upsell.php');
require(get_template_directory() . '/inc/extra.php');
require(get_template_directory() . '/inc/about-theme.php');
require(get_template_directory() . '/inc/widgets/serviceblock.php');
if ( is_admin() ) {
require(get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php');
}
