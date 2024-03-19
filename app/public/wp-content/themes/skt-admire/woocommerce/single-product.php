<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header();
$woosingleprodlayout = esc_html(get_theme_mod('woocommerce_single_product_layout_lists', 'woo_single_product_layout3'));
?>
<div class="page_wrap layer_wrapper">
	<div id="content">
		<div class="container">
			<div class="single_product_area <?php echo esc_html($woosingleprodlayout); ?>"> 	
			<div class="single_wrap">
				<div class="single_post_prod">
					<?php
		/**
		 * Woocommerce before main content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * 
		 * @since SKT Admire 1.0				 
		 */
		do_action( 'woocommerce_before_main_content' );
					?>
					<?php 
					while ( have_posts() ) :
						 the_post();
						?>
					<?php wc_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; // end of the loop. ?>
					<?php
		/**
		 * WooCommerce after main content hook.
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 * 
		 * @since SKT Admire 1.0		
		 */
		do_action( 'woocommerce_after_main_content' );
					?>
				</div>
			</div>
			<?php if ( 'woo_single_product_layout1' == $woosingleprodlayout || 'woo_single_product_layout2' == $woosingleprodlayout ) { ?>
				<?php get_sidebar('woocommerce'); ?>
			<?php } ?>
			<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!--layer_wrapper class END-->
<?php
get_footer();
