<?php
/**
 * SKT Admire Theme Customizer
 *
 * @package SKT Admire
 */
 
function skt_admire_custom_header_setup() {
/**
 * Custom header
 *
 * @since SKT Admire 1.0
 */
	add_theme_support( 'custom-header', apply_filters( 'skt_admire_custom_header_args', array(
		'default-text-color'     => '949494',
		'width'                  => 1600,
		'height'                 => 230,
		'wp-head-callback'       => 'skt_admire_header_style',
		'default-text-color' => false,
		'header-text' => false,
	) ) );
}
add_action( 'after_setup_theme', 'skt_admire_custom_header_setup' );
if ( ! function_exists( 'skt_admire_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see skt_admire_custom_header_setup().
 */
	function skt_admire_header_style() {
		?>    
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
			?>
		#topbar-area, .header{
			background: url(<?php echo esc_url(get_header_image()); ?>) no-repeat;
			background-position: center top;
			background-size:cover;
		}
	<?php endif; ?>	
	</style>
	<?php
	}
endif; // skt_admire_header_style 

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */ 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
function skt_admire_customize_register( $wp_customize ) {
	//Add a class for titles
	class SKTAdmire_Info extends WP_Customize_Control {
		public $type = 'info';
		public $label = '';
		public function render_content() {
			?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
		<?php
		}
	}
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->add_setting('color_scheme', array(
			'default'	=> '#0098ff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'color_scheme', array(
			'label' => esc_html__('Color Scheme', 'skt-admire'),			
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);

	// Header Panel
	$wp_customize->add_panel( 'basic_panel', array(
	 'priority'       => 10,
	  'capability'     => 'edit_theme_options',
	  'title'          => __('Basic', 'skt-admire'),
	  'description'    => __('Basic Options', 'skt-admire'),
	) );
	
	// Header Layouts
	$wp_customize->add_section('basic_fonts_option', array(
			'title'	=> esc_html__('Fonts Typography', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'basic_panel',
	));	
	
	$font_choices = 
		array(		
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
	
	// Site Identity Extra Field
	
	$wp_customize->add_setting(
		'site_title_fonts',
		array(
			'sanitize_callback' => 'skt_admire_sanitize_fonts',
			'default' => 'Poppins'
	));

	$wp_customize->add_control(
		'site_title_fonts',
		array(
			'label' => __('Site Title Font Family', 'skt-admire'),
			'type' => 'select',
			'description' => __('Select your desired font for the site title.', 'skt-admire'),
			'section' => 'title_tagline',
			'choices' => $font_choices
	));	

	$wp_customize->add_setting('site_title_font_size', array(
			'default'	=> '33px',
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('site_title_font_size', array(
			'label'	=> esc_html__('Site Title Font Size', 'skt-admire'),
			'section'	=> 'title_tagline',
			'setting'	=> 'site_title_font_size'
	));
	
	$wp_customize->add_setting('site_title_color', array(
			'default'	=> '#21201f',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'site_title_color', array(
			'label' => esc_html__('Site Title Color', 'skt-admire'),				
			'section' => 'title_tagline',
			'settings' => 'site_title_color'
		))
	);	
	
	$wp_customize->add_setting('logo_top_spacing', array(
			'default'	=> '32px',
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('logo_top_spacing', array(
			'label'	=> esc_html__('Logo Top Spacing', 'skt-admire'),
			'section'	=> 'title_tagline',
			'setting'	=> 'logo_top_spacing'
	));		
	
	$wp_customize->add_setting(
		'body_fonts',
		array(
			'sanitize_callback' => 'skt_admire_sanitize_fonts',
			'default' => 'Poppins'
	));
	
	$wp_customize->add_control(
		'body_fonts',
		array(
			'label' => __('Site Content Font Family', 'skt-admire'),
			'type' => 'select',
			'description' => __( 'Select your desired font for the body', 'skt-admire' ), 
			'section' => 'basic_fonts_option',   
			'choices' => $font_choices
	));	
	
	$wp_customize->add_setting('site_content_font_size', array(
			'default'	=> '17px',
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('site_content_font_size', array(
			'label'	=> esc_html__('Site Content Font Size', 'skt-admire'),
			'section'	=> 'basic_fonts_option',
			'setting'	=> 'site_content_font_size'
	));	

	// Header Panel
	$wp_customize->add_panel( 'header_panel', array(
	 'priority'       => 10,
	  'capability'     => 'edit_theme_options',
	  'title'          => __('Header', 'skt-admire'),
	  'description'    => __('Header Description Goes Here', 'skt-admire'),
	) );
	
	// Header Layouts
	$wp_customize->add_section('header_layouts', array(
			'title'	=> esc_html__('Header Layouts', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'header_panel',
	));	
	
	$wp_customize->add_setting( 'skt_admire_header_layouts', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'header_layout1', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'skt_admire_header_layouts', //Set a unique ID for the control
	 array(
		'label'      => __( 'Select Header Layouts', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'More Header Layouts Availabel in Pro Version.', 'skt-admire'),
		'settings'   => 'skt_admire_header_layouts', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'header_layouts', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'header_layout1' => 'Layout 1',
		)
	)
	) );	
	
	// Header Color And Typography
	$wp_customize->add_section('header_color_typography', array(
			'title'	=> esc_html__('Header Color And Typography', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'header_panel',
	));	
	
	$wp_customize->add_setting(
		'header_menu_fonts',
		array(
			'sanitize_callback' => 'skt_admire_sanitize_fonts',
			'default' => 'Poppins'
	));

	$wp_customize->add_control(
		'header_menu_fonts',
		array(
			'label' => __('Menu Font Family', 'skt-admire'),
			'type' => 'select',
			'section' => 'header_color_typography',
			'choices' => $font_choices
	));	
	
	$wp_customize->add_setting('header_menu_font_size', array(
			'default'	=> '17px',
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('header_menu_font_size', array(
			'label'	=> esc_html__('Menu Font Size', 'skt-admire'),
			'section'	=> 'header_color_typography',
			'setting'	=> 'header_menu_font_size'
	));	
	
	$wp_customize->add_setting('header_menu_text_color', array(
			'default'	=> '#21201f',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'header_menu_text_color', array(
			'label' => esc_html__('Menu Text Color', 'skt-admire'),				
			'section' => 'header_color_typography',
			'settings' => 'header_menu_text_color'
		))
	);	
	
	$wp_customize->add_setting('header_menu_hover_text_color', array(
			'default'	=> '#0098ff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'header_menu_hover_text_color', array(
			'label' => esc_html__('Menu Hover Text Color', 'skt-admire'),				
			'section' => 'header_color_typography',
			'settings' => 'header_menu_hover_text_color'
		))
	);	
	
	$wp_customize->add_setting('header_menu_active_text_color', array(
			'default'	=> '#0098ff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'header_menu_active_text_color', array(
			'label' => esc_html__('Menu Active Text Color', 'skt-admire'),				
			'section' => 'header_color_typography',
			'settings' => 'header_menu_active_text_color'
		))
	);
	
	$wp_customize->add_setting( 'transparent_header_frontpage', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'on', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'transparent_header_frontpage', //Set a unique ID for the control
	 array(
		'label'      => __( 'Transparent Header On Frontpage', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'Using this option you can managed transparent header.', 'skt-admire'),
		'settings'   => 'transparent_header_frontpage', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'header_color_typography', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'on' => 'On',
			'off' => 'Off',
		)
	)
	) );	
	
	$wp_customize->add_setting('header_bg_color_opacity', array(
			'default'	=> '1',
			'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('header_bg_color_opacity', array(
			'label' => esc_html__('Frontpage Header Background Color Opacity [Add Value In Format : 0.1 to 1]', 'skt-admire'),				
			'section' => 'header_color_typography',
			'settings' => 'header_bg_color_opacity'
	));	
	
	$wp_customize->add_setting( 'transparent_header_inner', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'off', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'transparent_header_inner', //Set a unique ID for the control
	 array(
		'label'      => __( 'Transparent Header On Inner Page/Post', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'Using this option you can managed transparent header.', 'skt-admire'),
		'settings'   => 'transparent_header_inner', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'header_color_typography', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'on' => 'On',
			'off' => 'Off',
		)
	)
	) );	
	
	$wp_customize->add_setting('inner_header_bg_color_opacity', array(
			'default'	=> '1',
			'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('inner_header_bg_color_opacity', array(
			'label' => esc_html__('Inner Page/Post Header Background Color Opacity [Add Value In Format : 0.1 to 1]', 'skt-admire'),				
			'section' => 'header_color_typography',
			'settings' => 'inner_header_bg_color_opacity'
	));			

	// Header Panel
	$wp_customize->add_panel( 'post_page_panel', array(
	 'priority'       => 10,
	  'capability'     => 'edit_theme_options',
	  'title'          => __('Post & Page', 'skt-admire'),
	  'description'    => __('Post and Page Options', 'skt-admire'),
	) );

	// Inner Page Banner Settings
	$wp_customize->add_section('inner_page_banner', array(
			'title'	=> esc_html__('Page Header Settings', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'post_page_panel',
	));	
	
	$wp_customize->add_setting('inner_page_banner_thumb', array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inner_page_banner_thumb', array(
		'section' => 'inner_page_banner',
		'label'	=> esc_html__('Upload Default Banner Image', 'skt-admire'),
		'description' => __( 'For Display Different Banner Image On Each Page Set Page Featured Image. Set Image Size (1400 X 270) For Better Resolution.', 'skt-admire'),
		'settings' => 'inner_page_banner_thumb',
		'button_labels' => array(// All These labels are optional
					'select' => 'Select Image',
					'remove' => 'Remove Image',
					'change' => 'Change Image',
					)
	)));

	 // Inner Page Banner Settings
		 
	// Inner Post Banner Settings
	$wp_customize->add_section('inner_post_banner', array(
			'title'	=> esc_html__('Post Header Settings', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'post_page_panel',
	));	
	
	$wp_customize->add_setting('inner_post_banner_thumb', array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inner_post_banner_thumb', array(
		'section' => 'inner_post_banner',
		'label'	=> esc_html__('Upload Default Banner Image', 'skt-admire'),
		'description' => __( 'For Display Different Banner Image On Each Post Set Post Featured Image. Set Image Size (1400 X 270) For Better Resolution.', 'skt-admire'),
		'settings' => 'inner_post_banner_thumb',
		'button_labels' => array(// All These labels are optional
					'select' => 'Select Image',
					'remove' => 'Remove Image',
					'change' => 'Change Image',
					)
	)));

	// WooCommerce Page Banner Settings
	$wp_customize->add_section('woo_page_banner', array(
			'title'	=> esc_html__('WooCoomerce Pages Header Settings', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'post_page_panel',
	));	
	
	$wp_customize->add_setting('woo_page_banner_thumb', array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'woo_page_banner_thumb', array(
		'section' => 'woo_page_banner',
		'label'	=> esc_html__('Upload Default Banner Image', 'skt-admire'),
		'description' => __( 'For Display Different Banner Image On Each WooCommerce Page Set Featured Image. Set Image Size (1400 X 270) For Better Resolution.', 'skt-admire'),
		'settings' => 'woo_page_banner_thumb',
		'button_labels' => array(// All These labels are optional
					'select' => 'Select Image',
					'remove' => 'Remove Image',
					'change' => 'Change Image',
					)
	)));
	 // WooCommerce Page Banner Settings		 
	 
	// Single Post Layout
	$wp_customize->add_section('single_post_layout', array(
			'title'	=> esc_html__('Single Post Layout', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'post_page_panel',
	));		 
	 
	$wp_customize->add_setting( 'single_post_layout_lists', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'single_post_layout1', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'single_post_layout_lists', //Set a unique ID for the control
	 array(
		'label'      => __( 'Select Single Post Layouts', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'More Single Post Layouts Availabel in Pro Version.', 'skt-admire'),
		'settings'   => 'single_post_layout_lists', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'single_post_layout', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'single_post_layout1' => 'Single Post Right Sidebar',
		)
	)
	) );	
	
	
	// WooCommerce Shop Page Layout
	$wp_customize->add_section('woocommerce_shop_page_layout', array(
			'title'	=> esc_html__('WooCommerce Shop Page and Category Layout', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'post_page_panel',
	));		 
	 
	$wp_customize->add_setting( 'woocommerce_shop_page_layout_lists', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'woo_shop_page_layout3', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'woocommerce_shop_page_layout_lists', //Set a unique ID for the control
	 array(
		'label'      => __( 'Select Layouts', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'More Shop Page Layouts Availabel in Pro Version.', 'skt-admire'),
		'settings'   => 'woocommerce_shop_page_layout_lists', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'woocommerce_shop_page_layout', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'woo_shop_page_layout3' => 'Shop Page Full Width',
		)
	)
	) );	 
	
	// WooCommerce Single Product Layout
	$wp_customize->add_section('woocommerce_single_product_layout', array(
			'title'	=> esc_html__('WooCommerce Single Product Layout', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'post_page_panel',
	));		 
	 
	$wp_customize->add_setting( 'woocommerce_single_product_layout_lists', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'woo_single_product_layout3', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'woocommerce_single_product_layout_lists', //Set a unique ID for the control
	 array(
		'label'      => __( 'WooCommerce Single Product Layouts', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'More Single Product Layouts Availabel in Pro Version.', 'skt-admire'),
		'settings'   => 'woocommerce_single_product_layout_lists', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'woocommerce_single_product_layout', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'woo_single_product_layout3' => 'Single Product Full Width',
		)
	)
	) );
	
		// Footer Panel
	$wp_customize->add_panel( 'footer_panel', array(
	 'priority'       => 10,
	  'capability'     => 'edit_theme_options',
	  'title'          => __('Footer', 'skt-admire'),
	  'description'    => __('Footer Options', 'skt-admire'),
	) );

	// Footer Layouts
	$wp_customize->add_section('footer_layouts', array(
			'title'	=> esc_html__('Footer Layouts', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'footer_panel',
	));	
	
	$wp_customize->add_setting( 'footer_layout_lists', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'footer_layout4', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'footer_layout_lists', //Set a unique ID for the control
	 array(
		'label'      => __( 'Select Footer Layouts', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'More Footer Layouts Availabel in Pro Version.', 'skt-admire'),
		'settings'   => 'footer_layout_lists', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'footer_layouts', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'footer_layout4' => '4 Columns',
		)
	)
	) );  
	
	// Scroll To Top
	$wp_customize->add_setting( 'scroll_to_top', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'on', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'scroll_to_top', //Set a unique ID for the control
	 array(
		'label'      => __( 'Scroll To Top', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'Scroll To Top Button appears on bottom right when you scroll down to pages.', 'skt-admire'),
		'settings'   => 'scroll_to_top', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'footer_layouts', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'on' => 'On',
			'off' => 'Off',
		)
	)
	) );
	
	// Footer Columns
	$wp_customize->add_section('footer_columns', array(
			'title'	=> esc_html__('Footer Columns', 'skt-admire'),	
			'description'	=> esc_html__('You Can Also Manage Footer Columns From Widgets >> Footer Column 1, Footer Column 2, Footer Column 3, Footer Column 4', 'skt-admire'),				
			'priority'		=> null,
			'panel'  => 'footer_panel',
	));	
	
	
	// Display Footer
	$wp_customize->add_setting( 'show_footer', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'yes', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'show_footer', //Set a unique ID for the control
	 array(
		'label'      => __( 'Display Footer', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'Using this option you can Show/Hide footer.', 'skt-admire'),
		'settings'   => 'show_footer', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'footer_columns', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'yes' => 'Yes',
			'no' => 'No',
		)
	)
	) );	

	$wp_customize->add_setting('foot_cols1_title', array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	$wp_customize->add_control('foot_cols1_title', array(
			'label'	=> esc_html__('Column 1 Title', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols1_title'
	));	
	
	$wp_customize->add_setting('foot_cols1_content', array(
			'default'	=> null,
			'sanitize_callback' => 'wp_kses_post',
    		'transport' => 'postMessage',	
	));
	$wp_customize->add_control('foot_cols1_content', array(
			'type' => 'textarea',
			'label'	=> esc_html__('Column 1 Content', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols1_content'
	));	
	
	$wp_customize->add_setting('foot_cols2_title', array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	$wp_customize->add_control('foot_cols2_title', array(
			'label'	=> esc_html__('Column 2 Title', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols2_title'
	));	
	
	$wp_customize->add_setting('foot_cols2_content', array(
			'default'	=> null,
			'sanitize_callback' => 'wp_kses_post',
    		'transport' => 'postMessage',	
	));
	$wp_customize->add_control('foot_cols2_content', array(
			'type' => 'textarea',
			'label'	=> esc_html__('Column 2 Content', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols2_content'
	));	
	
	$wp_customize->add_setting('foot_cols3_title', array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	$wp_customize->add_control('foot_cols3_title', array(
			'label'	=> esc_html__('Column 3 Title', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols3_title'
	));	
	
	$wp_customize->add_setting('foot_cols3_content', array(
			'default'	=> null,
			'sanitize_callback' => 'wp_kses_post',
    		'transport' => 'postMessage',	
	));
	$wp_customize->add_control('foot_cols3_content', array(
			'type' => 'textarea',
			'label'	=> esc_html__('Column 3 Content', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols3_content'
	));	
	
	$wp_customize->add_setting('foot_cols4_title', array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	$wp_customize->add_control('foot_cols4_title', array(
			'label'	=> esc_html__('Column 4 Title', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols4_title'
	));	
	
	$wp_customize->add_setting('foot_cols4_content', array(
			'default'	=> null,
			'sanitize_callback' => 'wp_kses_post',
    		'transport' => 'postMessage',	
	));
	$wp_customize->add_control('foot_cols4_content', array(
			'type' => 'textarea',
			'label'	=> esc_html__('Column 4 Content', 'skt-admire'),
			'section'	=> 'footer_columns',
			'setting'	=> 'foot_cols4_content'
	));	
	// Footer Color Option
	$wp_customize->add_section('footer_color', array(
			'title'	=> esc_html__('Footer Color', 'skt-admire'),					
			'priority'		=> null,
			'panel'  => 'footer_panel',
	));	
	
	$wp_customize->add_setting('footer_heading_font_size', array(
			'default'	=> '23px',
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('footer_heading_font_size', array(
			'label'	=> esc_html__('Footer Heading Font Size', 'skt-admire'),
			'section'	=> 'footer_color',
			'setting'	=> 'footer_heading_font_size'
	));	
	
	$wp_customize->add_setting('footer_background_image', array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_background_image', array(
		'section' => 'footer_color',
		'label'	=> esc_html__('Footer Background Image', 'skt-admire'),
		'settings' => 'footer_background_image',
		'button_labels' => array(// All These labels are optional
					'select' => 'Select Image',
					'remove' => 'Remove Image',
					'change' => 'Change Image',
					)
	)));	

			$wp_customize->add_setting('footer_bg_color', array(
			'default'	=> '#262f3e',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
			'label' => esc_html__('Footer Background Color', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_bg_color'
		))
	);	
	
		$wp_customize->add_setting('footer_widget_box_bg_color', array(
			'default'	=> '#2e394b',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'footer_widget_box_bg_color', array(
			'label' => esc_html__('Footer Box Background Color', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_widget_box_bg_color'
		))
	);	
	
	$wp_customize->add_setting('footer_box_bgcolor_opacity', array(
			'default'	=> '1',
			'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('footer_box_bgcolor_opacity', array(
			'label' => esc_html__('Footer Box Background Color Opacity [Add Value In Format : 0.1 to 1]', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_box_bgcolor_opacity'
	));			
	
	$wp_customize->add_setting('footer_widget_box_link_color', array(
			'default'	=> '#ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'footer_widget_box_link_color', array(
			'label' => esc_html__('Footer Box Link Color', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_widget_box_link_color'
		))
	);		
	
		$wp_customize->add_setting('footer_widget_box_link_hover_color', array(
			'default'	=> '#0098ff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'footer_widget_box_link_hover_color', array(
			'label' => esc_html__('Footer Box Link Hover Color', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_widget_box_link_hover_color'
		))
	);	
	
		$wp_customize->add_setting('footer_title_color', array(
			'default'	=> '#ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'footer_title_color', array(
			'label' => esc_html__('Footer Title Color', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_title_color'
		))
	);
	
		$wp_customize->add_setting('footer_content_color', array(
			'default'	=> '#ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'footer_content_color', array(
			'label' => esc_html__('Footer Content Color', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_content_color'
		))
	);		
	
		$wp_customize->add_setting('footer_text_color', array(
			'default'	=> '#ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'footer_text_color', array(
			'label' => esc_html__('Copyright Text Color', 'skt-admire'),				
			'section' => 'footer_color',
			'settings' => 'footer_text_color'
		))
	);	
	
	$wp_customize->add_section('footer_text_copyright', array(
			'title'	=> esc_html__('Footer Copyright Text', 'skt-admire'),		
			'description' => esc_html__('You Can Also Manage Copyright From Widgets >> Footer Copyright', 'skt-admire'),		
			'priority'		=> null,
			'panel'  => 'footer_panel',
	));

	// Display Footer
	$wp_customize->add_setting( 'show_copyright', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	 array(
		'default'    => 'yes', //Default setting/value to save
		'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
		'sanitize_callback' => 'skt_admire_sanitize_select',
		'transport'  => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
	 $wp_customize, //Pass the $wp_customize object (required)
	 'show_copyright', //Set a unique ID for the control
	 array(
		'label'      => __( 'Display Copyright Text', 'skt-admire' ), //Admin-visible name of the control
		'description' => __( 'Using this option you can Show/Hide footer copyright.', 'skt-admire'),
		'settings'   => 'show_copyright', //Which setting to load and manipulate (serialized is okay)
		'priority'   => 10, //Determines the order this control appears in for the specified section
		'section'    => 'footer_text_copyright', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		'type'    => 'select',
		'choices' => array(
			'yes' => 'Yes',
			'no' => 'No',
		)
	)
	) );	

	$wp_customize->add_setting('footer_text', array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	$wp_customize->add_control('footer_text', array(
			'label'	=> esc_html__('Add Copyright Text Here', 'skt-admire'),
			'section'	=> 'footer_text_copyright',
			'setting'	=> 'footer_text'
	));		 
}
add_action( 'customize_register', 'skt_admire_customize_register' );
//Integer
function skt_admire_sanitize_integer( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	}
}
function skt_admire_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize select.
 *
 * @since 1.0.0
 *
 * @param mixed                $input The value to sanitize.
 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
 * @return mixed Sanitized value.
 */
function skt_admire_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

//setting inline css.
function skt_admire_custom_css() {
	wp_enqueue_style(
		'admire-custom-style',
		get_template_directory_uri() . '/css/admire-custom-style.css', array(), '1.0' );
		
		$logotopspacing = esc_html(get_theme_mod('logo_top_spacing', '32px')); 
		$sitecontentfontsize = esc_html(get_theme_mod('site_content_font_size', '17px')); 
		$sitetitlefontsize = esc_html(get_theme_mod('site_title_font_size', '33px')); 
		$sitetitlecolor = esc_html(get_theme_mod('site_title_color', '#21201f'));
		$color = esc_html(get_theme_mod('color_scheme'));
		$headerbgcolor = esc_html(get_theme_mod('header_bg_color', '#ffffff')); 
		$footerbgcolor = esc_html(get_theme_mod('footer_bg_color', '#262f3e' ));
		$footerboxopacity = esc_html(get_theme_mod( 'footer_box_bgcolor_opacity', 1));
		$footerwidgetboxbgcolor = esc_html(get_theme_mod('footer_widget_box_bg_color', '#2e394b' ));
		$footerbgconvert = esc_html(skt_admire_hex2rgb($footerwidgetboxbgcolor));
		$footertransbg = 'rgba(' . $footerbgconvert . ',' . $footerboxopacity . ')';
		$footerbgimage = esc_html(get_theme_mod('footer_background_image'));
		$footerheadingfontsize = esc_html(get_theme_mod('footer_heading_font_size', '23px'));
		$footerwidgetboxlinkcolor = esc_html(get_theme_mod('footer_widget_box_link_color', '#ffffff' ));
		$footerwidgetboxlinkhovercolor = esc_html(get_theme_mod('footer_widget_box_link_hover_color', '#0098ff' ));
		$footertextcolor = esc_html(get_theme_mod('footer_text_color', '#ffffff')); 
		$footertitlecolor = esc_html(get_theme_mod('footer_title_color', '#ffffff')); 
		$footercontentcolor = esc_html(get_theme_mod('footer_content_color', '#ffffff'));
		$headerbgconvert = esc_html(skt_admire_hex2rgb($headerbgcolor));
		$headerbgcoloropacity = esc_html(get_theme_mod( 'header_bg_color_opacity', 1));
		$transbg = 'rgba(' . $headerbgconvert . ',' . $headerbgcoloropacity . ')';
		$transbgmob = 'rgba(' . $headerbgconvert . ', 1)';
		$innerheaderbgcoloropacity = esc_html(get_theme_mod( 'inner_header_bg_color_opacity', 1));
		$transbginner = 'rgba(' . $headerbgconvert . ',' . $innerheaderbgcoloropacity . ')';
		$transbginnermob = 'rgba(' . $headerbgconvert . ', 1)';
		$menufontsize = esc_html(get_theme_mod('header_menu_font_size', '17px')); 
		$menucolor = esc_html(get_theme_mod('header_menu_text_color', '#21201f')); 
		$menuhovercolor = esc_html(get_theme_mod('header_menu_hover_text_color', '#0098ff')); 
		$menuactivecolor = esc_html(get_theme_mod('header_menu_active_text_color', '#0098ff'));
		 //Fonts 
		$headings_font = esc_html(get_theme_mod('headings_fonts', 'Poppins')); 
		$body_font = esc_html(get_theme_mod('body_fonts', 'Poppins')); 
		$menufont = esc_html(get_theme_mod('header_menu_fonts', 'Poppins'));
		$sitetitlefont = esc_html(get_theme_mod('site_title_fonts', 'Poppins'));

		$custom_css = "
					body{font-size:{$sitecontentfontsize};}
					.pagination .nav-links span.current, .pagination .nav-links a:hover, #commentform input#submit:hover, .wpcf7 input[type='submit'], input.search-submit,
					.recent-post .morebtn:hover, .read-more-btn, .woocommerce-product-search button[type='submit'], .head-info-area, .designs-thumb, .hometwo-block-button,
					.aboutmore, .view-all-btn a:hover, .get-button a, .custom-cart-count{ background-color: {$color}; }
					.titleborder span:after{border-bottom-color: {$color} !important;}
					.sticky{border-right-color: {$color} !important;}

					#sidebar ul li a:hover, #sidebar a:hover, #sidebar ul li.current-cat a, #sidebar ul li.current_page_item a, #sidebar ul li.current-menu-item a, a:hover{color: {$color}; }

					body.home #topbar-area, body.home .header{background-color: {$transbg};}
					#topbar-area, .header{background-color: {$transbginner};}
					.header-holder.admirefixed{background-color: {$headerbgcolor};}
					#footer{background-color: {$footerbgcolor}; background-image: url({$footerbgimage});}
					.footer-row{background-color: {$footertransbg};}
					.footer h3{color: {$footertitlecolor}; font-size: {$footerheadingfontsize};}
					.footcontent{color: {$footercontentcolor};}
					.footer-row a{color: {$footerwidgetboxlinkcolor} !important;}
					.footer-row a:hover, .footer-cols ul li.current_page_item a, .footer-cols ul li.current-menu-item a{color: {$footerwidgetboxlinkhovercolor} !important;}
					.copyright-txt{color: {$footertextcolor} !important;}
					.logo, body.wp-custom-logo .logo{padding-top:{$logotopspacing};}
					.main-navigation{font-size:{$menufontsize};}
					.main-navigation ul li a{color: {$menucolor};}
					.main-navigation ul li a:hover, .main-navigation ul li:hover a, .focus a, .main-navigation ul li a:focus{color: {$menuhovercolor};}
					.main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_item a, .main-navigation ul li.current-menu-parent a, .main-navigation ul li.current-menu-ancestor a{color: {$menuactivecolor};}
					.logo h2{color: {$sitetitlecolor}; font-size:{$sitetitlefontsize};}
					@media screen and (max-width: 1024px) {
						body.home #topbar-area, body.home .header{background-color: {$transbgmob};}
						#topbar-area, .header{background-color: {$transbginnermob} !important;}
					}
				";	
			
	if ( $body_font ) {
					$font_pieces = $body_font;
					$custom_css .= "body, button, input, select, textarea{ font-family: {$font_pieces}; }";
	}
	if ( $headings_font ) {
	$font_pieces = $headings_font;
	$custom_css .= "#sidebar label, h1, h2, h3, h4, h5, h6{ font-family: {$font_pieces}; }";
	$custom_css .= "#footer label, #footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6{ font-family: {$font_pieces} !important; }";
	}	
	if ( $menufont ) {
	$font_pieces = $menufont;
	$custom_css .= ".main-navigation li{font-family: {$font_pieces} !important;}";
	}	
	if ( $sitetitlefont ) {
	$font_pieces = $sitetitlefont;
	$custom_css .= ".logo h2{font-family: {$font_pieces} !important;}";
	}											
				wp_add_inline_style( 'admire-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'skt_admire_custom_css' );          
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function skt_admire_customize_preview_js() {
	wp_enqueue_script( 'skt_admire_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'skt_admire_customize_preview_js' );