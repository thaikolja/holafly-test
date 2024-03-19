<?php
$headerlayouts = esc_html(get_theme_mod('skt_admire_header_layouts', 'header_layout1'));
if ( 'header_layout1' == $headerlayouts ) {
		get_template_part('templates/header', 'layouts1');	
}  