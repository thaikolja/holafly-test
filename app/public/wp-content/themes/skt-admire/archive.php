<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SKT Admire
 */
get_header(); ?>
<div class="container">
	<div id="content_navigator">
	 <div class="page_content">
		<section class="site-main">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
				   <?php
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				<div class="blog-post">
					<?php  
					/* Start the Loop */ 

					while ( have_posts() ) :
							the_post(); 

						get_template_part( 'content', get_post_format() ); 

					endwhile;
					?>
				</div>
				<?php  
				// Previous/next post navigation.
				the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'skt-admire' ),
							'next_text' => esc_html__( 'Next', 'skt-admire' ),
							'screen_reader_text' => esc_html__( 'Posts navigation', 'skt-admire' )
				) );
				else : 
				get_template_part( 'no-results'); 
				endif; 
				?>
		</section>
	   <?php get_sidebar('blog'); ?>       
		<div class="clear"></div>
	</div><!-- .page_content -->
	</div><!-- #content_navigator -->
</div><!-- .container -->

<?php 
get_footer();