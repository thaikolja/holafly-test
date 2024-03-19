<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Admire
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
/**
	 * Add action wp_body_open hook.
	 *
	 * @since 1.0
	 */
 do_action( 'wp_body_open' ); 
?>
<a class="skip-link screen-reader-text" href="#content_navigator">
<?php esc_html_e( 'Skip to content', 'skt-admire' ); ?>
</a>
<?php
	$pagethumb = esc_html(get_theme_mod('inner_page_banner_thumb'));
	$woopagethumb = esc_html(get_theme_mod('woo_page_banner_thumb'));
	$postthumb = esc_html(get_theme_mod('inner_post_banner_thumb'));	
	$hidepageheader = esc_html(get_theme_mod('hide_page_header', 'off'));
	$woohidepageheader = esc_html(get_theme_mod('hide_woo_page_header', 'off'));
	$hidepostheader = esc_html(get_theme_mod('hide_post_header', 'off'));

	get_template_part('templates/header', 'layouts');
?>
<div class="clear"></div>