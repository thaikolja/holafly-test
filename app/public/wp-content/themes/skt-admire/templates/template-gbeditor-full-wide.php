<?php
/**
Template Name: Gutenberg Editor Full Wide
* 
* @package SKT Admire
*/
get_header('fullwide'); ?>
<div id="content_navigator">		
	  <div class="page_content">
			 <section id="sitefull">               
					<?php
					if ( have_posts() ) :
						// Start the Loop.
						while ( have_posts() ) :
						 the_post();
							?>
								<div class="entry-content">
<?php
										the_content();
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'skt-admire' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
											'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'skt-admire' ) . ' </span>%',
											'separator'   => '<span class="screen-reader-text">, </span>',
										) );
												//If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || '0' != get_comments_number() ) {
													comments_template();
}
?>
								</div><!-- entry-content -->
							<?php
							 endwhile;
							 endif;
					?>
			</section><!-- section-->
	<div class="clear"></div>
	</div><!-- .page_content --> 
	</div> 
<?php get_footer(); ?>
