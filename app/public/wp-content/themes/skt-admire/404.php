<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package SKT Admire
 */
 
get_header(); ?>

<div class="container">
	  <div id="content_navigator">		
	  <div class="page_content">
			 <section class="site-main notfoundcontent" id="sitefull">
				<header class="page-header">
                	<div class="notfoundtitle">
						<?php esc_html_e('404', 'skt-admire'); ?>
					</div>
                    <div class="clear"></div>
					<h1 class="entry-title">
						<?php esc_html_e('Page not found', 'skt-admire'); ?>
					</h1>
				</header>
				<!-- .page-header -->
				<div class="page-content">
					<p>
						<?php esc_html_e('Sorry this page does not exist.', 'skt-admire'); ?>
					</p> 
				</div>
				<!-- .page-content --> 
			</section><!-- section-->
	<div class="clear"></div>
	</div><!-- .page_content --> 
	</div>
 </div><!-- .container -->

<?php
get_footer();