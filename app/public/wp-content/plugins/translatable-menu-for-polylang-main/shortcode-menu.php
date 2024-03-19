<?php
function sw_translatable_menu_shortcode ($atts) {
	ob_start();
    
  $a = shortcode_atts( array( 
      'menu-slug' => '',
      'menu-class' => '',
  ), $atts );
	
  if( function_exists('pll_current_language') ) {
    $lang_slug = pll_current_language('slug');
  } else {
    $lang_slug = '';
  }
  
  $menu_name = $a['menu-slug'] . '-' . $lang_slug;
  $menu_class = $a['menu-class'];

  wp_nav_menu( 
    array( 
      'menu' => $menu_name,
      'menu_class' => 'sw-shortcode-menu ' . $menu_class,
    ),
  );

  wp_enqueue_style(
    'sw-shortcode-menu',
    dirname( __FILE__ ) .'/shorcode-menu.css',
  );

	return ob_get_clean();
}
add_shortcode ('translatable-menu', 'sw_translatable_menu_shortcode');