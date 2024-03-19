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
get_template_part('templates/header', 'layouts');
?>
<div class="clear"></div>