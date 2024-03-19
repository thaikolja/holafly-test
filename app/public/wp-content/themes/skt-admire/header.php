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
	get_template_part('templates/header', 'layouts');
if ( !is_home() && !is_front_page() && is_page() && !skt_admire_is_realy_woocommerce_page()) { 
	?>
			<div class="clear"></div>
			<div class="inner-banner-thumb">
	<?php
				if ( has_post_thumbnail() ) {
										echo esc_url(the_post_thumbnail('full'));
				} else {
					if (!empty($pagethumb)) { 
						?>
						<img src="<?php echo esc_url($pagethumb); ?>" />
						<?php } } ?>   
				<div class="banner-container"><h1><?php the_title(); ?></h1></div>
				<div class="clear"></div>
			</div>
			<?php
}

	if ( !is_home() && !is_front_page() && !is_page() && is_category() || is_archive()) { 
		if ( class_exists( 'WooCommerce' ) && is_shop()) {
			 $shop = get_option( 'woocommerce_shop_page_id' );
	?>
			<div class="clear"></div>
			<div class="inner-banner-woo-page-thumb">
				<?php
				if ( has_post_thumbnail($shop) ) {
										echo esc_url(get_the_post_thumbnail( $shop ));
				} else {
					if (!empty($woopagethumb)) {
						?>
						<img src="<?php echo esc_url($woopagethumb); ?>" />
						<?php }  } ?>  
				<div class="banner-container">
						 <h1><?php woocommerce_page_title(); ?></h1> 
				</div>
				<div class="clear"></div>
			</div>
			<?php
		}
		 else { 
				?>
			<div class="clear"></div>
			<div class="inner-banner-post-thumb mixthumb">
				<?php if (!empty($postthumb)) { ?>
						<img src="<?php echo esc_url($postthumb); ?>" />
						<?php } ?>  
				<div class="banner-container">
					<?php
					if ( class_exists( 'WooCommerce' ) ) {
						if ( is_woocommerce() ) {
							?>
							<h1><?php woocommerce_page_title(); ?></h1>
							<?php
						} else {
							?>
							<h1><?php the_archive_title(); ?></h1>
						<?php	
						}			 
					} else { 
						?>
				<h1><?php the_archive_title(); ?></h1>
			<?php } ?>	
				</div>
				<div class="clear"></div>
			</div>
			<?php
		} 
	} 
	
	if (is_single()) { 
		if ( class_exists( 'WooCommerce' )) {
			$shop = get_option( 'woocommerce_shop_page_id' );
				?>
			<div class="clear"></div>
			<div class="inner-banner-woo-page-thumb">
				<?php
				if ( has_post_thumbnail($shop) ) {
										echo esc_url(get_the_post_thumbnail( $shop ));
				} else {
					if (!empty($woopagethumb)) {
						?>
						<img src="<?php echo esc_url($woopagethumb); ?>" />
						<?php }  } ?>  
				<div class="banner-container">
						 <h1><?php the_title(); ?></h1> 
				</div>
				<div class="clear"></div>
			</div>
			<?php
		}
		 else { 
				?>
			<div class="clear"></div>
			<div class="inner-banner-post-thumb mixthumb">
				<?php if (!empty($postthumb)) { ?>
						<img src="<?php echo esc_url($postthumb); ?>" />
						<?php } ?>  
				<div class="banner-container">
					<?php
					if ( class_exists( 'WooCommerce' ) ) {
						if ( is_woocommerce() ) {
							?>
							<h1><?php woocommerce_page_title(); ?></h1>
							<?php
						} else {
							?>
							<h1><?php the_title(); ?></h1>
						<?php	
						}			 
					} else { 
						?>
				<h1><?php the_title(); ?></h1>
			<?php } ?>	
				</div>
				<div class="clear"></div>
			</div>
			<?php
		} 
	} 	

	if ( class_exists( 'WooCommerce' ) ) {
		if (is_account_page() ) { 
			?>
			<div class="clear"></div>
			<div class="inner-banner-woo-page-thumb">
				<?php 
				if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail( get_option( 'woocommerce_myaccount_page_id' ) );
				} else {
					if (!empty( $woopagethumb )) { 
						?>
						<img src="<?php echo esc_url($woopagethumb); ?>" />
					<?php }  } ?>  
				<div class="banner-container">
			<h1><?php the_title(); ?></h1>
				</div>
				<div class="clear"></div>
			</div>
<?php
			  }	
		if ( is_cart() ) { 
			?>
			<div class="clear"></div>
			<div class="inner-banner-woo-page-thumb">
				<?php 
				if ( has_post_thumbnail() ) {
										echo get_the_post_thumbnail( get_option( 'woocommerce_cart_page_id' ) );
				} else {
					if (!empty( $woopagethumb )) { 
						?>
						<img src="<?php echo esc_url($woopagethumb); ?>" />
						<?php }  } ?>  
				<div class="banner-container">
			<h1><?php the_title(); ?></h1>
				</div>
				<div class="clear"></div>
			</div>
		<?php
			  } 
		if ( is_checkout() ) { 
			?>
			<div class="clear"></div>
			<div class="inner-banner-woo-page-thumb">
			<?php 
				if ( has_post_thumbnail() ) {
			echo get_the_post_thumbnail( get_option( 'woocommerce_checkout_page_id' ) );
				} else {
					if (!empty($woopagethumb) ) { 
						?>
						<img src="<?php echo esc_url($woopagethumb); ?>" />
						<?php }  } ?>  
				<div class="banner-container">
			<h1><?php the_title(); ?></h1>
				</div>
				<div class="clear"></div>
			</div>
	<?php } } ?>  
	<div class="clear"></div>