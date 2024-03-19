<?php
	$headersticky = esc_html(get_theme_mod('skt_admire_header_sticky_options', 'no'));
	$transheaderfront = esc_html(get_theme_mod('transparent_header_frontpage','on'));
	$transheaderinner = esc_html(get_theme_mod('transparent_header_inner','off'));
?>
<!-- Header Layout 1 -->
<?php if ( 'yes' == $headersticky ) { ?>
<script>
jQuery(window).scroll(function(){
  var sticky = jQuery('.header-holder'),
      scroll = jQuery(window).scrollTop();

  if (scroll >= 200) sticky.addClass('admirefixed');
  else sticky.removeClass('admirefixed');
});
</script>
<?php } ?>

<?php if ( ('on' == $transheaderfront && is_front_page() && !is_home()) || (('on' == $transheaderinner && is_page() && !is_front_page()) || ('on' == $transheaderinner && is_single()) || ('on' == $transheaderinner && is_category()) || ('on' == $transheaderinner && is_archive()) )) { ?>
<div class="trans-rel">
<?php } ?>
<div class="header header-lay-1 <?php if ( ('on' == $transheaderfront && is_front_page() && !is_home()) || (('on' == $transheaderinner && is_page() && !is_front_page()) || ('on' == $transheaderinner && is_single()) || ('on' == $transheaderinner && is_category()) || ('on' == $transheaderinner && is_archive()))) { ?>transheader<?php } ?>">

	<div class="header-holder">
	<div class="container">
		<div class="logo">
			<?php if (skt_admire_the_custom_logo()) { ?>
		<?php skt_admire_the_custom_logo(); ?>
				<div class="clear"></div>
				<?php } ?>
		<?php	
				$description = get_bloginfo( 'description', 'display' );
		?>
				<div id="logo-main">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<h2 class="site-title"><?php bloginfo('name'); ?></h2>
				<?php if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo esc_html($description); ?></p>                          
				<?php endif; ?>
				</a>
				</div>
		</div> 

		<div id="navigation">
        <nav id="site-navigation" class="main-navigation">		
        <button type="button" class="menu-toggle">
					<span></span>
					<span></span>
					<span></span>
				</button>		 
			<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => 'ul', 'menu_id' => 'primary', 'menu_class' => 'primary-menu menu' ) ); ?>
			</nav>
            </div>
  
	<div id="top-right-info">
		<div class="header-extras">
					<ul>
                                <li>
									<button class="header-search-toggle"><i class="fas fa-search"></i></button>
										<div class="header-search-form">
												<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
													<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'skt-admire' ); ?>" name="s">
													<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'skt-admire' ); ?>">
												</form>
										</div>
								</li>

								<?php if ( class_exists( 'WooCommerce' )) {
								$myaccount = get_option( 'woocommerce_myaccount_page_id' );	
								?>
								<li><a href="<?php echo esc_url(get_permalink( $myaccount )); ?>" title="<?php esc_attr_e( 'My Account', 'skt-admire' ); ?>"><i class="fas fa-user"></i></a></li>
								<?php } ?>
								<?php if ( class_exists( 'WooCommerce' ) ) { ?>	
								<li>
									<a class="cart-customlocation" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'skt-admire' ); ?>"><i class="fas fa-shopping-cart"></i><span class="custom-cart-count"><div id="mini-cart-count"></div></span></a>  
								</li>
								<li class="header-cart-total"><div id="mini-cart-total"></div></li>
								<?php } ?>
						</ul>
				</div>  
	</div>
      
		<div class="clear"></div>    
		</div> <!-- container --> 
        </div>
	</div>
    <div class="clear"></div>  

<?php if ( ('on' == $transheaderfront && is_front_page() && !is_home()) || (('on' == $transheaderinner && is_page() && !is_front_page()) || ('on' == $transheaderinner && is_single()) || ('on' == $transheaderinner && is_category()) || ('on' == $transheaderinner && is_archive()))) { ?>
</div> 
<?php } ?>  