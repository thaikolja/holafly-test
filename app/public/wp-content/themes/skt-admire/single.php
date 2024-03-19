<?php
/**
 * The Template for displaying all single posts.
 *
 * @package SKT Admire
 */
get_header(); 
$singlepostlayouts = esc_html(get_theme_mod('single_post_layout_lists', 'single_post_layout1'));
?>
<div class="container">
	 <div id="content_navigator" class="<?php echo esc_html($singlepostlayouts); ?>">		
	 <div class="page_content">     
		<section class="site-main">            
				<?php 	
				while ( have_posts() ) :
					the_post();
					get_template_part( 'content', 'single' );
					skt_admire_content_nav( 'nav-below' );
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template();
					}
					endwhile; // end of the loop. 
				?>

		 </section>   
		<?php if ('single_post_layout1' == $singlepostlayouts) { ?>     
			<?php get_sidebar('blog'); ?>
		<?php } ?>
		<div class="clear"></div>
	</div><!-- page_content -->
	</div>
</div><!-- container -->	
<?php get_footer(); ?>