<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Admire
 */
$footer_text = esc_html(get_theme_mod('footer_text'));
$footer_layout = esc_html(get_theme_mod('footer_layout_lists', 'footer_layout4'));
$scrollgotop = esc_html(get_theme_mod('scroll_to_top', 'on'));
$footcols1title = esc_html(get_theme_mod('foot_cols1_title'));
$footcols1content = esc_html(get_theme_mod('foot_cols1_content'));
$footcols2title = esc_html(get_theme_mod('foot_cols2_title'));
$footcols2content = esc_html(get_theme_mod('foot_cols2_content'));
$footcols3title = esc_html(get_theme_mod('foot_cols3_title'));
$footcols3content = esc_html(get_theme_mod('foot_cols3_content'));
$footcols4title = esc_html(get_theme_mod('foot_cols4_title'));
$footcols4content = esc_html(get_theme_mod('foot_cols4_content'));
$displayfooter = esc_html(get_theme_mod('show_footer', 'yes'));
$displaycopyrightfooter = esc_html(get_theme_mod('show_copyright', 'yes'));
?>
<?php if ('on' == $scrollgotop) { ?>
<a href="<?php echo esc_url('#');?>" id="scrollgotop" class="scrolnone"><span></span></a>
<?php } ?>
<div id="footer">
<div class="footer-all-area">

<?php if ( is_active_sidebar( 'footer-infobox' )) : ?> 
<div class="footer-info-box">
	<div class="container">
		<?php dynamic_sidebar( 'footer-infobox' ); ?>
	</div>
</div>
<?php endif; ?>

<?php if ('yes' == $displayfooter) { ?>
<div class="footerarea footer">
			<div class="container">
					<div class="ftr-widg">
								<div class="footer-row">    
								<?php if ('footer_layout4' == $footer_layout) { ?>
										<div class="footer-cols cols-4 widget-column-1">  
                                        	<?php if (!dynamic_sidebar('fc-1')) : if(!empty($footcols1title)){
                                            	$ftcols1 = html_entity_decode($footcols1title);
												$ftcols1 = stripslashes($ftcols1);											
											?>
                                            <h3><?php echo do_shortcode($ftcols1); ?></h3>
                                            <div class="clear"></div>
                                            <?php } ?>
                                            
                                            <?php if(!empty($footcols1content)){?>
                                            <div class="footcontent">
                                            <?php
                                            	$ftcols1cntnt = $footcols1content;
												echo do_shortcode($ftcols1cntnt);
											?>
                                            </div>
                                            <?php } endif; ?>                                             
										</div><!--end .widget-column-1-->                  
										<div class="footer-cols cols-4 widget-column-2">  
                                        	<?php if (!dynamic_sidebar('fc-2')) : if(!empty($footcols2title)){												
                                            	$ftcols2 = html_entity_decode($footcols2title);
												$ftcols2 = stripslashes($ftcols2);											
											?>
                                            <h3><?php echo do_shortcode($ftcols2); ?></h3>
                                            <div class="clear"></div>
                                            <?php } ?>
                                            
                                            <?php if(!empty($footcols2content)){?>
                                            <div class="footcontent">
                                            <?php
                                            	$ftcols2cntnt = $footcols2content;
												echo do_shortcode($ftcols2cntnt);
											?>
                                            </div>
                                            <?php } endif; ?>                                             
										</div><!--end .widget-column-2-->                  
										<div class="footer-cols cols-4 widget-column-3">  
                                        	<?php if (!dynamic_sidebar('fc-3')) : if(!empty($footcols3title)){?>
											<?php
                                            	$ftcols3 = html_entity_decode($footcols3title);
												$ftcols3 = stripslashes($ftcols3);											
											?>
                                            <h3><?php echo do_shortcode($ftcols3); ?></h3>
                                            <div class="clear"></div>
                                            <?php } ?>
                                            
                                            <?php if(!empty($footcols3content)){?>
                                            <div class="footcontent">
                                            <?php
                                            	$ftcols3cntnt = $footcols3content;
												echo do_shortcode($ftcols3cntnt);
											?>
                                            </div>
                                            <?php } endif; ?>                                             
										</div><!--end .widget-column-3-->                  
										<div class="footer-cols cols-4 widget-column-4">  
                                        	<?php if (!dynamic_sidebar('fc-4')) : if(!empty($footcols4title)){?>
											<?php
                                            	$ftcols4 = html_entity_decode($footcols4title);
												$ftcols4 = stripslashes($ftcols4);											
											?>
                                            <h3><?php echo do_shortcode($ftcols4); ?></h3>
                                            <div class="clear"></div>
                                            <?php } ?>
                                            
                                            <?php if(!empty($footcols4content)){?>
                                            <div class="footcontent">
                                            <?php
                                            	$ftcols4cntnt = $footcols4content;
												echo do_shortcode($ftcols4cntnt);
											?>
                                            </div>
                                            <?php } endif; ?>                                             
										</div><!--end .widget-column-4-->                  										
								<?php } ?>


								<div class="clear"></div>
								</div>
						</div>
				</div><!--end .container--> 
</div>
<?php } ?>

<?php if ('yes' == $displaycopyrightfooter) { ?>
<?php if (!empty($footer_text)) { ?>        
<div class="copyright-wrapper">
<div class="container">
		 <?php if (!dynamic_sidebar('footer-copyright')) : ?>
		 <div class="copyright-txt">
			<?php echo esc_html($footer_text); ?>
		 </div>
         <?php endif; ?> 
		 <div class="clear"></div>
</div>           
</div>
<?php } ?> 
<?php } ?>
</div><!--end #footer-all-area-->
</div>
<?php wp_footer(); ?>
</body>
</html>