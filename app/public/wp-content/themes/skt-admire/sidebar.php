<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SKT Admire
 */
?>
<div id="sidebar">    
	<?php if ( ! dynamic_sidebar( 'sidebar-pages' ) ) : ?>
		<aside id="categories" class="widget"> 
			<h3 class="widget-title titleborder"><span><?php esc_html_e( 'Pages', 'skt-admire' ); ?></span></h3>
			<ul>
				<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
			</ul>
		</aside>          
	<?php endif; // end sidebar widget area ?>	
</div><!-- sidebar -->