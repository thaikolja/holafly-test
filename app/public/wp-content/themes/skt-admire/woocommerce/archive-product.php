<?php 
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 */

defined( 'ABSPATH' ) || exit;
get_header();
$wooshoplayout = esc_html(get_theme_mod('woocommerce_shop_page_layout_lists', 'woo_shop_page_layout3'));
?>
<div class="page_wrap layer_wrapper">
	<div class="container">
		<div id="content_navigator" class="shoplay <?php echo esc_html($wooshoplayout); ?>">
			<div class="page_content">
				<div class="site-main">
					<div class="woocommerce">
						<header class="woocommerce-products-header">
							<?php
				/**
				 * Hook: woocommerce_archive_description.
				 * 
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 * 
				 * @since SKT Admire 1.0
				 */
				do_action( 'woocommerce_archive_description' );
							?>
						</header>
						<?php
						if ( woocommerce_product_loop() ) {
			
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 *
				 * @since SKT Admire 1.0
				 */
				do_action( 'woocommerce_before_shop_loop' );
				woocommerce_product_loop_start();
			
							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
						the_post();
			
						/**
						 * Hook: woocommerce_shop_loop.
						 * 
						 * @since SKT Admire 1.0						 
						 */
						do_action( 'woocommerce_shop_loop' );
			
						wc_get_template_part( 'content', 'product' );
								}
							}
				woocommerce_product_loop_end();
			
				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 *
				 * @since SKT Admire 1.0				 
				 */
				do_action( 'woocommerce_after_shop_loop' );
						} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 *
				 * @since SKT Admire 1.0				 
				 */
				do_action( 'woocommerce_no_products_found' );
						}
						?>
					</div>
				</div>
			</div>
			<?php if ('woo_shop_page_layout1' == $wooshoplayout || 'woo_shop_page_layout2' == $wooshoplayout) { ?>
				<?php get_sidebar('woocommerce'); ?>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!--layer_wrapper class END-->
<?php    
get_footer();
