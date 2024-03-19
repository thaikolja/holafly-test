<?php 
/**
 * Admire functions and definitions
 *
 * @package SKT Admire
 */
 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'skt_admire_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
	function skt_admire_setup() {
	/**
	* Set the content width based on the theme's design and stylesheet.
	*
	* @since SKT Admire 1.0
	*/	
	$GLOBALS['content_width'] = apply_filters( 'skt_admire_content_width', 640 );
	load_theme_textdomain( 'skt-admire', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );	
	add_theme_support( 'custom-logo', array(
		'height'      => 61,
		'width'       => 200,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => esc_html__( 'Header Menu', 'skt-admire' ),			
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
	} 
endif; // skt_admire_setup
add_action( 'after_setup_theme', 'skt_admire_setup' );
function skt_admire_widgets_init() { 	
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on sidebar', 'skt-admire' ),
		'id'            => 'sidebar-pages',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h3 class="widget-title titleborder"><span>',
		'after_title'   => '</span></h3>',
		'after_widget'  => '</aside>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on blog', 'skt-admire' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h3 class="widget-title titleborder"><span>',
		'after_title'   => '</span></h3>',
		'after_widget'  => '</aside>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-admire' ),
		'id'            => 'fc-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-admire' ),
		'id'            => 'fc-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-admire' ),
		'id'            => 'fc-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );		
		
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-admire' ),
		'id'            => 'fc-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Info Box', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-admire' ),
		'id'            => 'footer-infobox',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'skt-admire' ),
		'description'   => esc_html__( 'Appears on page footer copyright', 'skt-admire' ),
		'id'            => 'footer-copyright',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'after_widget'  => '</aside>',
	) );			
}
add_action( 'widgets_init', 'skt_admire_widgets_init' );

function skt_admire_scripts() {
	if ( !is_rtl() ) {
		wp_enqueue_style( 'skt-admire-basic-style', get_stylesheet_uri(), array(), '1.0' );
		wp_enqueue_style( 'skt-admire-main-style', get_template_directory_uri() . '/css/responsive.css', array(), '1.0' );		
	}
	if ( is_rtl() ) {
		wp_enqueue_style( 'skt-admire-basic-style', get_stylesheet_uri(), array(), '1.0' );
	}	
	wp_enqueue_style( 'skt-admire-editor-style', get_template_directory_uri() . '/editor-style.css', array(), '1.0' );
	wp_enqueue_style( 'skt-admire-base-style', get_template_directory_uri() . '/css/style_base.css', array(), '1.0' );
	wp_enqueue_style('skt-admire-fontawesome-css',get_template_directory_uri().'/assets/fonts/font-awesome.css', 'fontawesome-css' );
	wp_enqueue_style( 'skt-admire-default-style', get_template_directory_uri() . '/css/skt-admire-default.css', array(), '1.0' );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts', 'Poppins'));
	$body_font = esc_html(get_theme_mod('body_fonts', 'Poppins'));
	$menufont = esc_html(get_theme_mod('header_menu_fonts', 'Poppins'));
	$sitetitlefont = esc_html(get_theme_mod('site_title_fonts', 'Poppins'));

	wp_enqueue_style( 'skt-admire-default-fonts', 'https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap', array(), null );
	wp_enqueue_style( 'skt-admire-headings-fonts', 'https://fonts.bunny.net/css?family=' . $headings_font, array(), '1.0', 'screen' );	 
	wp_enqueue_style( 'skt-admire-body-fonts', 'https://fonts.bunny.net/css?family=' . $body_font, array(), '1.0', 'screen' ); 	
	wp_enqueue_style( 'skt-admire-menu-fonts', 'https://fonts.bunny.net/css?family=' . $menufont, array(), '1.0', 'screen' ); 	
	wp_enqueue_style( 'skt-admire-sitetitle-fonts', 'https://fonts.bunny.net/css?family=' . $sitetitlefont, array(), '1.0', 'screen' ); 	

	wp_enqueue_script( 'skt-admire-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '01062020', true );
	wp_enqueue_script( 'skt-admire-customscripts', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.0' );
	wp_localize_script( 'skt-admire-navigation', 'admireScreenReaderText', array(
		'expandMain'   => __( 'Open main menu', 'skt-admire' ),
		'collapseMain' => __( 'Close main menu', 'skt-admire' ),
		'expandChild'   => __( 'Expand submenu', 'skt-admire' ),
		'collapseChild' => __( 'Collapse submenu', 'skt-admire' ),
	) );	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_admire_scripts' );

require_once get_template_directory() . '/pro-customize/example-1/class-customize.php';

function skt_admire_admin_style() {
	wp_enqueue_style('skt-admire-admin-style', get_template_directory_uri() . '/css/skt-admire-admin-style.css', array(), '1.0' );
}
add_action('admin_enqueue_scripts', 'skt_admire_admin_style');

//Sanitizes Fonts 
function skt_admire_sanitize_fonts( $input ) {  
		$valid = array(
			'---Standard Fonts---' => '---Standard Fonts---',
			'Arial' => 'Arial',
			'Baskerville' => 'Baskerville',
			'Bodoni MT' => 'Bodoni MT',
			'Calibri' => 'Calibri',
			'Calisto MT' => 'Calisto MT',
			'Cambria' => 'Cambria',
			'Candara' => 'Candara',
			'Consolas' => 'Consolas',
			'Georgia' => 'Georgia',
			'Helvetica' => 'Helvetica',
			'Impact' => 'Impact',
			'Optima' => 'Optima',
			'Tahoma' => 'Tahoma',
			'Verdana' => 'Verdana',
			'Poppins' => 'Poppins',
			'Zeyada' => 'Zeyada',
			'Zhi Mang Xing' => 'Zhi Mang Xing',
			'Zilla Slab' => 'Zilla Slab',
			'Zilla Slab Highlight' => 'Zilla Slab Highlight'
		);
 
		if ( array_key_exists( $input, $valid ) ) {
				return $input;
		} else {
				return '';
		}
}

define('SKT_ADMIRE_PRO_THEME_URL','https://admiretheme.com/pricing/');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// get slug by id
function skt_admire_get_slug_by_id( $id ) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}
if ( ! function_exists( 'skt_admire_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
	function skt_admire_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
		}
	}
endif;

add_filter( 'body_class', 'skt_admire_body_class' );
function skt_admire_body_class( $classes ) {
	if ( skt_admire_is_woocommerce_activated() ) {
		$classes[] = 'woocommerce';
	}
	
		return $classes;
}

/**
 * Filter the except length to 21 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function skt_admire_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	// Set excerpt length to 55 words
		return 25;
}
add_filter( 'excerpt_length', 'skt_admire_custom_excerpt_length', 999 );
 
/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'skt_admire_is_woocommerce_activated' ) ) {
	function skt_admire_is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) {
		 return true;
		} else {
		   return false;
		}
	}
}

function skt_admire_wp_admin_style( $hook ) {
	if ( 'themes.php' != $hook ) {
			return;
	}
		wp_enqueue_style( 'skt-admire-admin-style', get_template_directory_uri() . '/css/skt-admire-admin-style.css', array(), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'skt_admire_wp_admin_style' );

// WordPress wp_body_open backward compatibility
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
/**
  * Add backwards compatibility support for wp_body_open function.
	*
	* @since  1.0.0  
  */		
				do_action( 'wp_body_open' );
	}
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function skt_admire_skip_link_focus_fix() {  
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php       
}
add_action( 'wp_print_footer_scripts', 'skt_admire_skip_link_focus_fix' );

function skt_admire_load_dashicons() {
	 wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'skt_admire_load_dashicons', 999);

add_action( 'wp_enqueue_scripts', 'skt_admire_custom_enqueue_wc_cart_fragments' );
function skt_admire_custom_enqueue_wc_cart_fragments() {
    wp_enqueue_script( 'wc-cart-fragments' );
}

add_filter( 'woocommerce_add_to_cart_fragments', 'skt_admire_refresh_mini_cart_count');
function skt_admire_refresh_mini_cart_count( $fragments ) {
		ob_start();
	?>
		<div id="mini-cart-count">
				<?php echo wp_kses_post(WC()->cart->get_cart_contents_count()); ?>
		</div>
		<?php
				$fragments['#mini-cart-count'] = ob_get_clean();
		return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'skt_admire_refresh_cart_total');
function skt_admire_refresh_cart_total( $fragments ) {
		ob_start();
	?>
		<div id="mini-cart-total">
			<?php echo esc_html_e('Total', 'skt-admire'); ?>
				<div class="clear"></div>
				<?php echo wp_kses_post(WC()->cart->get_cart_total()); ?>
		</div>
		<?php
				$fragments['#mini-cart-total'] = ob_get_clean();
		return $fragments;
}

//hex to rgb function
function skt_admire_hex2rgb( $hex ) {
	 $hex = str_replace('#', '', $hex);
 
	if (strlen($hex) == 3) {
			$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
	} else {
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
	}
	 $rgb = array($r, $g, $b);
	 return implode(',', $rgb); // returns the rgb values separated by commas
}

// enable gutenberg for woocommerce
function skt_admire_activate_gutenberg_product( $can_edit, $post_type ) {
	if ( 'product' == $post_type ) {
		$can_edit = true;
	}
	return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'skt_admire_activate_gutenberg_product', 10, 2 );

/**
* skt_admire_is_realy_woocommerce_page - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
*
* @access public
* @return bool
*/
function skt_admire_is_realy_woocommerce_page () {
    if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
        return true;
    }
    $woocommerce_keys = array ( "woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" ) ;

    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
            return true ;
        }
    }
    return false;
}

/**
 * Calling in the admin area for the Welcome Page.
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-skt-admire-admin.php';
	require get_template_directory() . '/inc/admin/class-skt-admire-welcome-notice.php';
}