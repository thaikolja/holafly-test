<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme = wp_get_theme();
if ( 'Admire' == $theme->name || 'admire' == $theme->template ) {
	

// Add second featured image
add_action( 'add_meta_boxes', 'listing_image_add_metabox' );
function listing_image_add_metabox () {
    add_meta_box( 'listingimagediv', __( 'Banner image', 'admire-extra' ), 'listing_image_metabox', 'post', 'side', 'low');
	add_meta_box( 'listingimagediv', __( 'Banner image', 'admire-extra' ), 'listing_image_metabox', 'product', 'side', 'low');
	add_meta_box( 'listingimagediv', __( 'Banner image', 'admire-extra' ), 'listing_image_metabox', 'ourservices', 'side', 'low');
	add_meta_box( 'listingimagediv', __( 'Banner image', 'admire-extra' ), 'listing_image_metabox', 'team', 'side', 'low');
}

function listing_image_metabox ( $post ) {
    global $content_width, $_wp_additional_image_sizes;

    $image_id = get_post_meta( $post->ID, '_listing_image_id', true );
    $old_content_width = $content_width;
    $content_width = 254;

    if ( $image_id && get_post( $image_id ) ) {

        if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
            $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
        } else {
            $thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
        }

        if ( ! empty( $thumbnail_html ) ) {
            $content = $thumbnail_html;
            $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button" >' . esc_html__( 'Remove banner image', 'admire-extra' ) . '</a></p>';
            $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="' . esc_attr( $image_id ) . '" />';
        }

        $content_width = $old_content_width;
    } else {

        $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
        $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set banner image', 'admire-extra' ) . '" href="javascript:;" id="upload_listing_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'admire-extra' ) . '" data-uploader_button_text="' . esc_attr__( 'Set banner image', 'admire-extra' ) . '">' . esc_html__( 'Set banner image', 'admire-extra' ) . '</a></p>';
        $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="" />';

    }

    echo $content;
}

add_action( 'save_post', 'listing_image_save', 10, 1 );
function listing_image_save ( $post_id ) {
    if( isset( $_POST['_listing_cover_image'] ) ) {
        $image_id = (int) $_POST['_listing_cover_image'];
        update_post_meta( $post_id, '_listing_image_id', $image_id );
    }
}	
	
	
// custom post type for Testimonials
function admire_custom_post_testimonials() {
	$labels = array(
		'name'               => __( 'Testimonials','admire-extra'),
		'singular_name'      => __( 'Testimonials','admire-extra'),
		'add_new'            => __( 'Add Testimonials','admire-extra'),
		'add_new_item'       => __( 'Add New Testimonial','admire-extra'),
		'edit_item'          => __( 'Edit Testimonial','admire-extra'),
		'new_item'           => __( 'New Testimonial','admire-extra'),
		'all_items'          => __( 'All Testimonials','admire-extra'),
		'view_item'          => __( 'View Testimonial','admire-extra'),
		'search_items'       => __( 'Search Testimonial','admire-extra'),
		'not_found'          => __( 'No Testimonial found','admire-extra'),
		'not_found_in_trash' => __( 'No Testimonial found in the Trash','admire-extra'), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonials'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Testimonials',
		'public'        => true,
		'menu_icon'		=> 'dashicons-format-quote',
		'menu_position' => null,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
		'exclude_from_search' => true,
	);
	register_post_type( 'testimonials', $args );	
}
add_action( 'init', 'admire_custom_post_testimonials' );


// add meta box to testimonials
add_action( 'admin_init', 'admire_testimonial_admin_function' );
function admire_testimonial_admin_function() {
    add_meta_box( 'testimonial_meta_box',
        'Testimonial Info',
        'admire_display_testimonial_meta_box',
        'testimonials', 'normal', 'high'
    );
}
// add meta box form to doctor
function admire_display_testimonial_meta_box( $testimonial ) {
	$companyname = esc_html( get_post_meta( $testimonial->ID, 'companyname', true ) );  
    $possition = esc_html( get_post_meta( $testimonial->ID, 'possition', true ) ); 
	
    ?>
    <table width="100%">
        <tr>
            <td width="20%"><?php echo esc_attr('Company Name','admire-extra');?> </td>
            <td width="80%"><input size="80" type="text" name="<?php echo esc_attr('companyname','admire-extra');?>" value="<?php echo $companyname; ?>" /></td>
        </tr> 
        <tr>
            <td width="20%"><?php echo esc_attr('Designation','admire-extra');?> </td>
            <td width="80%"><input size="80" type="text" name="<?php echo esc_attr('possition','admire-extra');?>" value="<?php echo $possition; ?>" /></td>
        </tr>       
    </table>
    <?php    
}
// save testimonial meta box form data
add_action( 'save_post', 'admire_add_testimonial_fields_function', 10, 2 );
function admire_add_testimonial_fields_function( $testimonial_id, $testimonial ) {
    // Check post type for testimonials
    if ( $testimonial->post_type == 'testimonials' ) {
        // Store data in post meta table if present in post data
		if ( isset($_POST['companyname']) ) {
            update_post_meta( $testimonial_id, 'companyname', wp_filter_kses($_POST['companyname']) );
        } 
        if ( isset($_POST['possition']) ) {
            update_post_meta( $testimonial_id, 'possition', wp_filter_kses($_POST['possition']) );
        }       
    }
}

//custom post type for Our Team
function admire_custom_post_team() {
	$labels = array(
		'name'               => __( 'Our Team', 'admire-extra' ),
		'singular_name'      => __( 'Our Team', 'admire-extra' ),
		'add_new'            => __( 'Add New', 'admire-extra' ),
		'add_new_item'       => __( 'Add New Team Member', 'admire-extra' ),
		'edit_item'          => __( 'Edit Team Member', 'admire-extra' ),
		'new_item'           => __( 'New Member', 'admire-extra' ),
		'all_items'          => __( 'All Members', 'admire-extra' ),
		'view_item'          => __( 'View Members', 'admire-extra' ),
		'search_items'       => __( 'Search Team Members', 'admire-extra' ),
		'not_found'          => __( 'No Team members found', 'admire-extra' ),
		'not_found_in_trash' => __( 'No Team members found in the Trash', 'admire-extra' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Our Team'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Team',
		'public'        => true,
		'menu_position' => null,
		'show_in_rest'       => true,
		'menu_icon'		=> 'dashicons-groups',
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'rewrite' => array('slug' => 'our-team'),
		'has_archive'   => true,
		'exclude_from_search' => true,
	);
	register_post_type( 'team', $args );
}
add_action( 'init', 'admire_custom_post_team' );

// add meta box to team
add_action( 'admin_init', 'admire_team_admin_function' );
function admire_team_admin_function() {
    add_meta_box( 'team_meta_box',
        'Member Info',
        'admire_display_team_meta_box',
        'team', 'normal', 'high'
    );
}
// add meta box form to team
function admire_display_team_meta_box( $team ) {
    $designation = esc_html( get_post_meta( $team->ID, 'designation', true ) );

    $facebook = get_post_meta( $team->ID, 'facebook', true );
	$facebooklink = esc_url( get_post_meta( $team->ID, 'facebooklink', true ) );

    $twitter = get_post_meta( $team->ID, 'twitter', true );
	$twitterlink = esc_url( get_post_meta( $team->ID, 'twitterlink', true ) );

	$instagram = get_post_meta( $team->ID, 'instagram', true );
	$instagramlink = esc_url( get_post_meta( $team->ID, 'instagramlink', true ) );	

    $linkedin = get_post_meta( $team->ID, 'linkedin', true );
	$linkedinlink = esc_url( get_post_meta( $team->ID, 'linkedinlink', true ) );

    $pinterest = get_post_meta( $team->ID, 'pinterest', true );
	$pinterestlink = get_post_meta( $team->ID, 'pinterestlink', true );
	
    ?>
    <table width="100%">
        <tr>
            <td width="20%"><?php echo esc_attr('Designation','admire-extra');?> </td>
            <td width="80%"><input type="text" name="designation" value="<?php echo $designation; ?>" /></td>
        </tr>
        <tr>
        	<td width="20%">&nbsp;</td>
            <td width="40%" style="padding:10px 0 5px 0;"><strong><?php echo esc_attr('Icon Name Eg: facebook','admire-extra');?></strong></td>
            <td width="40%" style="padding:10px 0 5px 0;"><strong><?php echo esc_attr('Social Link Eg: http://www.facebook.com/xyz','admire-extra');?></strong></td>
        </tr>        
        <tr>
            <td width="20%"><?php echo esc_attr('Social Link 1','admire-extra');?></td>
            <td width="40%"><input type="text" name="<?php echo esc_attr('facebook','admire-extra');?>" value="<?php echo $facebook; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="<?php echo esc_attr('facebooklink','admire-extra');?>" value="<?php echo $facebooklink; ?>" /></td>
        </tr>
        <tr>
            <td width="20%"><?php echo esc_attr('Social Link 2','admire-extra');?></td>
            <td width="40%"><input type="text" name="<?php echo esc_attr('twitter','admire-extra');?>" value="<?php echo $twitter; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="<?php echo esc_attr('twitterlink','admire-extra');?>" value="<?php echo $twitterlink; ?>" /></td>
        </tr>
        <tr>
            <td width="20%"><?php echo esc_attr('Social Link 3','admire-extra');?></td>
            <td width="40%"><input type="text" name="<?php echo esc_attr('instagram','admire-extra');?>" value="<?php echo $instagram; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="<?php echo esc_attr('instagramlink','admire-extra');?>" value="<?php echo $instagramlink; ?>" /></td>
        </tr>
        <tr>
            <td width="20%"><?php echo esc_attr('Social Link 4','admire-extra');?></td>
            <td width="40%"><input type="text" name="<?php echo esc_attr('linkedin','admire-extra');?>" value="<?php echo $linkedin; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="<?php echo esc_attr('linkedinlink','admire-extra');?>" value="<?php echo $linkedinlink; ?>" /></td>
        </tr>        
        <tr>
            <td width="20%"><?php echo esc_attr('Social Link 5','admire-extra');?></td>
            <td width="40%"><input type="text" name="<?php echo esc_attr('pinterest','admire-extra');?>" value="<?php echo $pinterest; ?>" /></td>
            <td width="40%"><input style="width:500px;" type="text" name="<?php echo esc_attr('pinterestlink','admire-extra');?>" value="<?php echo $pinterestlink; ?>" /></td>
        </tr>
        <tr>
        	<td width="100%" colspan="3"><label style="font-size:12px;"><strong><?php echo esc_attr('Note:','admire-extra');?></strong> <?php echo esc_attr('Icon name should be in lowercase without space. More social icons can be found at: http://fortawesome.github.io/Font-Awesome/icons/','admire-extra');?></label> </td>
        </tr>
    </table>
    <?php    
}
// save team meta box form data
add_action( 'save_post', 'admire_add_team_fields_function', 10, 2 );
function admire_add_team_fields_function( $team_id, $team ) {
    // Check post type for testimonials
    if ( $team->post_type == 'team' ) {
        // Store data in post meta table if present in post data
        if ( isset($_POST['designation']) ) {
            update_post_meta( $team_id, 'designation', wp_filter_kses($_POST['designation']) );
        }        
		if ( isset($_POST['facebook']) ) {
            update_post_meta( $team_id, 'facebook', wp_filter_kses($_POST['facebook']) );
        }
		if ( isset($_POST['facebooklink']) ) {
            update_post_meta( $team_id, 'facebooklink', wp_filter_kses($_POST['facebooklink']) );
        }
        if ( isset($_POST['twitter']) ) {
            update_post_meta( $team_id, 'twitter', wp_filter_kses($_POST['twitter']) );
        }
		if ( isset($_POST['twitterlink']) ) {
            update_post_meta( $team_id, 'twitterlink', wp_filter_kses($_POST['twitterlink']) );
        }
        if ( isset($_POST['instagram']) ) {
            update_post_meta( $team_id, 'instagram', wp_filter_kses($_POST['instagram']) );
        }
		if ( isset($_POST['instagramlink']) ) {
            update_post_meta( $team_id, 'instagramlink', wp_filter_kses($_POST['instagramlink']) );
        }		
        if ( isset($_POST['linkedin']) ) {
            update_post_meta( $team_id, 'linkedin', wp_filter_kses($_POST['linkedin']) );
        }
		if ( isset($_POST['linkedinlink']) ) {
            update_post_meta( $team_id, 'linkedinlink', wp_filter_kses($_POST['linkedinlink']) );
        }
		if ( isset($_POST['pinterest']) ) {
            update_post_meta( $team_id, 'pinterest', wp_filter_kses($_POST['pinterest']) );
        }
		if ( isset($_POST['pinterestlink']) ) {
            update_post_meta( $team_id, 'pinterestlink', wp_filter_kses($_POST['pinterestlink']) );
        }
    }
}

//custom post type for Our Services
function admire_my_custom_post_ourservices() {
	$labels = array(
		'name'               => __( 'Our Services', 'admire-extra' ),
		'singular_name'      => __( 'Our Services', 'admire-extra' ),
		'add_new'            => __( 'Add New', 'admire-extra' ),
		'add_new_item'       => __( 'Add New Services', 'admire-extra' ),
		'edit_item'          => __( 'Edit Services', 'admire-extra' ),
		'new_item'           => __( 'New Services', 'admire-extra' ),
		'all_items'          => __( 'All Services', 'admire-extra' ),
		'view_item'          => __( 'View Services', 'admire-extra' ),
		'search_items'       => __( 'Search Services', 'admire-extra' ),
		'not_found'          => __( 'No Services found', 'admire-extra' ),
		'not_found_in_trash' => __( 'No Services found in the Trash', 'admire-extra' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Our Services'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Our Services',
		'public'        => true,
		'menu_position' => null,
		'show_in_rest'       => true,
		'menu_icon'		=> 'dashicons-layout',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite' => array('slug' => 'ourservices'),
		'has_archive'   => true,
		'exclude_from_search' => true,
	);
	register_post_type( 'ourservices', $args );
}
add_action( 'init', 'admire_my_custom_post_ourservices' );

// Shortcodes

// Social Icon
/*[social_area]
    [social icon="facebook" link="#"]
    [social icon="twitter" link="#"]
    [social icon="linkedin" link="#"]
    [social icon="pinterest" link="#"]
[/social_area]*/

function admire_social_area($atts,$content = null){
  return '<div class="social-icons">'.do_shortcode($content).'</div>';
 }
add_shortcode('social_area','admire_social_area');

function admire_social($atts){
 extract(shortcode_atts(array(
  'icon' => '',
  'link' => ''
 ),$atts));
  return '<a href="'.$link.'" target="_blank" class="fa fa-'.$icon.' fa-1x" title="'.$icon.'"></a>';
 }
add_shortcode('social','admire_social');

}

// Footer Menu
/*[footermenu menu=""]*/
function admire_foot_menu($atts, $content = null) {
	extract(shortcode_atts(array(  
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => '', 
		'container_id'    => '', 
		'menu_class'      => 'footmenu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 1,
		'walker'          => '',
		'theme_location'  => 'footer'), 
		$atts));

	return wp_nav_menu( array( 
		'menu'            => $menu, 
		'container'       => $container, 
		'container_class' => $container_class, 
		'container_id'    => $container_id, 
		'menu_class'      => $menu_class, 
		'menu_id'         => $menu_id,
		'echo'            => false,
		'fallback_cb'     => $fallback_cb,
		'before'          => $before,
		'after'           => $after,
		'link_before'     => $link_before,
		'link_after'      => $link_after,
		'depth'           => $depth,
		'walker'          => $walker,
		'theme_location'  => $theme_location));
}
add_shortcode("footermenu", "admire_foot_menu");

//[clear]
function admire_clear_func() {
	$clr = '<div class="clear"></div>';
	return $clr;
}
add_shortcode( 'clear', 'admire_clear_func' );


//[space height="20"]
function admire_space_shortcode_func($atts ) {
 extract( shortcode_atts( array(
  'height' => '20',
 ), $atts ) );
 $sptr = '<div class="spacecode" style="height:'.$height.'px;"></div>';
 return $sptr;
}
add_shortcode( 'space', 'admire_space_shortcode_func' );

//[posts-style1 show='4' col='4' cat='1' excerptlength='24']
// Shortcode Post Block Style1
function admire_post_style1_func( $atts ) {
	global $authordata;
   extract( shortcode_atts( array(
		'show' => '',
		'col' => '',
		'cat' => '',
		'excerptlength' => '24',
	), $atts ) );

	$lbposts = '<div class="post_style1_area">';
	$args = array( 'posts_per_page' => $show, 'cat' => $cat, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	
	if ( have_posts() ) {
		while ( have_posts() ) { 
			the_post();
			if( $col == 1 ){
				$lbposts .= '<div class="cols1 post_block_style1';
			}elseif( $col == 2 ){
				$lbposts .= '<div class="cols2 post_block_style1';
			}elseif( $col == 3 ){
				$lbposts .= '<div class="cols3 post_block_style1';
			}elseif( $col == 4 ){
				$lbposts .= '<div class="cols4 post_block_style1';
			} 
				$lbposts .= '">';
			$lbposts .= '<div class="post_block_style1_box">'; 
			if ( has_post_thumbnail() ){ $lbposts .= '<div class="style1-post-thumb">'; }
			$lbposts .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), 'full') : '<img src="'.get_template_directory_uri().'/images/default-post-img.jpg" class="post-default-img">' ).'</a>';
			if ( has_post_thumbnail() ){
			$lbposts .= '</div>';
			}
				$lbposts .= '<div class="post-title">
				<div class="post_block_style1_meta"><span>'.get_the_date('M d, Y').'</span></div>
				<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
				<p>'.wp_trim_words( get_the_content(), $excerptlength ).'</p>
				</div></div></div>';
		}
	}else{
		$lbposts .= '<p>Sorry! There are no posts.</p>';
	}
	wp_reset_query();
	$lbposts .= '<div class="clear"></div></div>';
    return $lbposts;
}
add_shortcode( 'posts-style1', 'admire_post_style1_func' );

//[posts-style2 show='2' col='2' cat='1' excerptlength='24'] 
// Shortcode Post Block Style2

function admire_post_style2_func( $atts ) {
	global $authordata;
	global $lbposts;
   extract( shortcode_atts( array(
		'show' => '',
		'col' => '',
		'cat' => '',
		'excerptlength' => '24',
	), $atts ) );

	$lbposts = '<div class="post_style2_area">';
	$args = array( 'posts_per_page' => $show, 'cat' => $cat, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	
	if ( have_posts() ) {
		while ( have_posts() ) { 
			the_post();
			if( $col == 1 ){
				$lbposts .= '<div class="cols1 post_block_style2';
			}elseif( $col == 2 ){
				$lbposts .= '<div class="cols2 post_block_style2';
			}elseif( $col == 3 ){
				$lbposts .= '<div class="cols3 post_block_style2';
			}elseif( $col == 4 ){
				$lbposts .= '<div class="cols4 post_block_style2';
			} 
				$lbposts .= '">'; 
						if ( has_post_thumbnail() ){
			$lbposts .= '<div class="style2-post-thumb">';
			}$lbposts .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), 'full') : '' ).'</a>'; if ( has_post_thumbnail() ){ $lbposts .= '</div>'; } $lbposts .= '
				<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
				<div class="post_block_style2_meta">
                	<span><a href="'.get_author_posts_url( $authordata->ID, $authordata->user_nicename ).'"><i class="fa fa-user fa-lg"></i> '.get_the_author().'</a></span><span><i class="fa fa-calendar"></i>
'.get_the_date('F j, Y').'</span>
                </div>
				<p>'.wp_trim_words( get_the_content(), $excerptlength ).'</p>
				</div>';
		}
	}else{
		$lbposts .= '<p>Sorry! There are no post.</p>';
	}
	wp_reset_query();
	$lbposts .= '</div>';
    return $lbposts;
}
add_shortcode( 'posts-style2', 'admire_post_style2_func' );

// Post Style 3
//[posts-style3 show='12' col='4' cat='1' excerptlength='24'] 
// Shortcode Post Block Style3
function admire_post_style3_func( $atts ) {
	global $authordata;
	global $lbposts;
   extract( shortcode_atts( array(
		'show' => '',
		'col' => '',
		'cat' => '',
		'excerptlength' => '24',
	), $atts ) );

	$lbposts = '<div class="post_style3_area">';
	$args = array( 'posts_per_page' => $show, 'cat' => $cat, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	
	if ( have_posts() ) {
		while ( have_posts() ) { 
			the_post();
						if( $col == 1 ){
				$lbposts .= '<div class="cols1 post_block_style3';
			}elseif( $col == 2 ){
				$lbposts .= '<div class="cols2 post_block_style3';
			}elseif( $col == 3 ){
				$lbposts .= '<div class="cols3 post_block_style3';
			}elseif( $col == 4 ){
				$lbposts .= '<div class="cols4 post_block_style3';
			} 
				$lbposts .= '">';
				
			$lbposts .= '<div class="post_block_style3_area_border">';	
			
			if(has_post_thumbnail() ){
			$lbposts .= '<div class="style3thumb"><a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), 'full') : '' ).'</a></div>'; 
			}
					if(has_post_thumbnail() ){
					$lbposts .= '<div class="style3info">'; 
					}
					else{
					$lbposts .= '<div class="style3infonothumb">'; 	
					}
					$lbposts .= '<h3>'.get_the_title().'</h3>'; 
					$lbposts .= '<div class="shortdesc">'.wp_trim_words( get_the_content(), $excerptlength ).'</div>';
					$lbposts .= '<div class="shortmore"><a href="'.get_permalink().'">'.'Read More'.'</a></div>';
					$lbposts .= '</div></div></div>';
		}
	}else{
		$lbposts .= '<p>Sorry! There are no post.</p>';
	}
	wp_reset_query();
	$lbposts .= '<div class="clear"></div></div>';
    return $lbposts;
}
add_shortcode( 'posts-style3', 'admire_post_style3_func' ); 

// Post Style 4
//[posts-style4 show='3' col='3' excerptlength='14' cat='' buttontext='Read More']
function posts_style4_func( $atts ) {
  global $authordata;
  global $lbposts;
   extract( shortcode_atts( array(
    'show' => '',
	'col' => '',
    'cat' => '',
	'excerptlength' => '',
	'buttontext' => '',
  ), $atts ) );
 
 $lbposts = '<div class="skt-posts-style5-row">';
	$args = array( 'posts_per_page' => $show, 'cat' => $cat, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	
	if ( have_posts() ) {
		while ( have_posts() ) { 
			the_post();
			if( $col == 1 ){
				$lbposts .= '<div class="cols1 skt-posts-style5-column';
			}elseif( $col == 2 ){
				$lbposts .= '<div class="cols2 skt-posts-style5-column';
			}elseif( $col == 3 ){
				$lbposts .= '<div class="cols3 skt-posts-style5-column';
			}elseif( $col == 4 ){
				$lbposts .= '<div class="cols4 skt-posts-style5-column';
			} 
				$lbposts .= '">';
				
			$lbposts .= '<div class="skt-posts-style5-inner">'; 
			if ( has_post_thumbnail() ){ $lbposts .= '<div class="skt-posts-style5-thumb">'; }
			$lbposts .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), 'full') : '<img src="'.get_template_directory_uri().'/images/default-post-img.jpg" class="post-default-img">' ).'</a>';
			if ( has_post_thumbnail() ){
			$lbposts .= '</div>';
			}
				$lbposts .= '
				
				<div class="skt-posts-style5-content">  
        <div class="post-date"><span>'.get_the_date('M d, Y').'</span></div>
		<h3 class="skt-posts-style5-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
		<div class="short-desc">'.wp_trim_words( get_the_content(), $excerptlength ).'</div>	
		<div class="postread-more">
          <a class="skt-posts-style5-more" href="'.get_permalink().'">'.$buttontext.'</a>
          </div>
              <div class="clear"></div>
		</div></div></div>';
		}
	}else{
		$lbposts .= '<p>Sorry! There are no posts.</p>';
	}
	wp_reset_query();
	$lbposts .= '<div class="clear"></div></div>';
    return $lbposts;
  
}
add_shortcode( 'posts-style4', 'posts_style4_func' );

//[posts-timeline show="4" cat="1" excerptlength="24"] 
// Shortcode Post Time Line
function admire_post_timeline_func( $atts ) {
	global $authordata;
   extract( shortcode_atts( array(
   		'show' => '4',
		'cat' => '1',
		'excerptlength' => '24',
	), $atts ) );

	$tmlposts = '<div class="timeline-container">
  <div class="timeline-row">
    <ul class="timeline-both-side">';
	$args = array( 'posts_per_page' => $show, 'cat' => $cat, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	
	if ( have_posts() ) {
		$n = 1;
		while ( have_posts() ) { 
			the_post();
			$marg_cls = ($n % 2) ? '' : 'opposite-side';
			$tmlposts .= '<li class="'.$marg_cls.'">'; 
			$tmlposts .= '<div class="border-line"></div><div class="timeline-description">
			<div class="timeleft"><a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), 'full') : '' ).'</a></div>'; 
			if ( has_post_thumbnail() ){$tmlposts .= '<div class="timeright">'; }else {$tmlposts .= '<div class="timerightfull">';}
			$tmlposts .= '<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3><div class="metaline">
                	<span><a href="'.get_author_posts_url( $authordata->ID, $authordata->user_nicename ).'"><i class="fa fa-user fa-lg"></i> '.get_the_author().'</a></span><span><i class="fa fa-calendar"></i>
'.get_the_date('F j, Y').'</span>
                </div><p>'.wp_trim_words( get_the_content(), $excerptlength ).'</p></div>
			</div></li> ';
				$n++;
		}
	}else{
		$tmlposts .= '<p>Sorry! There are no posts.</p>';
	}
	wp_reset_query();
	$tmlposts .= '</ul>
  </div><div class="clear"></div>
</div>';
    return $tmlposts;
}
add_shortcode( 'posts-timeline', 'admire_post_timeline_func' );

//[posts-grid show="4" cat="1" excerptlength="24"] 
// Shortcode Post Grid

function admire_post_grid_func( $atts ) {
	global $authordata;
   extract( shortcode_atts( array(
   		'show' => '4',
		'cat' => '1',   
		'excerptlength' => '24',
	), $atts ) );
	
	$gridposts = '<div class="gridwrapper">
<div class="masonry">';
	$args = array( 'posts_per_page' => $show, 'cat' => $cat, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	
	if ( have_posts() ) {
		$n = 1;
		while ( have_posts() ) { 
			the_post();
			$gridposts .= '<div class="griditem"><a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), 'full') : '' ).'</a>
<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
<div class="metaline">
                	<span><a href="'.get_author_posts_url( $authordata->ID, $authordata->user_nicename ).'"><i class="fa fa-user fa-lg"></i> '.get_the_author().'</a></span><span><i class="fa fa-calendar"></i>
'.get_the_date('F j, Y').'</span>
                </div><p>'.wp_trim_words( get_the_content(), $excerptlength ).'</p></div>'; 
				$n++;
		}
	}else{
		$gridposts .= '<p>Sorry! There are no posts.</p>';
	}
	wp_reset_query();
	$gridposts .= '</div></div>';
    return $gridposts;
}
add_shortcode( 'posts-grid', 'admire_post_grid_func' );

// Services Sidebar Menu
/*[sidebar-menu menu='Services Sidebar']*/
function admire_sidebar_menu($atts, $content = null) {
	extract(shortcode_atts(array(  
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => '', 
		'container_id'    => '', 
		'menu_class'      => 'sidebar-menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 1,
		'walker'          => ''), 
		$atts)); 
 
	return wp_nav_menu( array( 
		'menu'            => $menu, 
		'container'       => $container, 
		'container_class' => $container_class, 
		'container_id'    => $container_id, 
		'menu_class'      => $menu_class, 
		'menu_id'         => $menu_id,
		'echo'            => false,
		'fallback_cb'     => $fallback_cb,
		'before'          => $before,
		'after'           => $after,
		'link_before'     => $link_before,
		'link_after'      => $link_after,
		'depth'           => $depth,
		'walker'          => $walker));
}
//Create the shortcode
add_shortcode("sidebar-menu", "admire_sidebar_menu");

// Shortcode Services
//[services_box show='8']
function admire_services_box_func( $atts ) {
   extract( shortcode_atts( array(
		'show' => '3',
	), $atts ) );
	  extract( shortcode_atts( array( 'show' => $show,), $atts ) ); $ourtm = ''; wp_reset_query(); 

	$ourtm = '<div class="services-box-outer">';
	$args = array( 'post_type' => 'ourservices', 'posts_per_page' => $show, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	$n = 0;
	if ( have_posts() ) {
		while ( have_posts() ) { 
			$n++;
			the_post();
			$servicesiconimg = get_the_post_thumbnail_url( get_the_ID(), 'full');
			$ourtm .= '<div class="services-box-content-area"> <div class="services-box-content">
			
	<div class="skt-services-image"><a href="'.get_permalink().'" title="'.get_the_title().'"><img src="'.$servicesiconimg.'" alt="'.get_the_title().'"></a>';
			$ourtm .= '</div>';
			
                $ourtm .= '<div class="services-infobox">
							<h3 class="skt-services-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
							<p>'.get_the_excerpt().'</p>';
                $ourtm .= '</div>';
                $ourtm .= '</div></div>';
				
		}
	}else{
		$ourtm .= 'Sorry, Services is empty.';
	}
	wp_reset_query();
	$ourtm .= '</div>';
    return $ourtm;
}
add_shortcode( 'services_box', 'admire_services_box_func' );

// [ourteam col='2' show='2']
function admire_ourteam_func( $atts ) {
   extract( shortcode_atts( array(
		'col' => '',
		'show' => '',
		'excerptlength' => '25',
	), $atts ) );
	  extract( shortcode_atts( array( 'show' => $show,), $atts ) ); $ourtm = ''; wp_reset_query();
	$ourtm = '<div class="sectionrow skt-ourteam"><div class="team-outer">';
	$args = array( 'post_type' => 'team', 'posts_per_page' => $show, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	$n = 0;
	if ( have_posts() ) {
		while ( have_posts() ) { 
			$n++;
			the_post();
			$designation = esc_html( get_post_meta( get_the_ID(), 'designation', true ) );
			
			$facebook = get_post_meta( get_the_ID(), 'facebook', true );
			$facebooklink = get_post_meta( get_the_ID(), 'facebooklink', true );
			
			$twitter = get_post_meta( get_the_ID(), 'twitter', true );
			$twitterlink = get_post_meta( get_the_ID(), 'twitterlink', true );
			
			$instagram = get_post_meta( get_the_ID(), 'instagram', true );
			$instagramlink = get_post_meta( get_the_ID(), 'instagramlink', true );
						
			$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
			$linkedinlink = get_post_meta( get_the_ID(), 'linkedinlink', true );
			
			$pinterest = get_post_meta( get_the_ID(), 'pinterest', true );
			$pinterestlink = get_post_meta( get_the_ID(), 'pinterestlink', true );			

			if( $col == 1 ){
				$ourtm .= '<div class="cols1 skt-team-box';
			}elseif( $col == 2 ){
				$ourtm .= '<div class="cols2 skt-team-box';
			}elseif( $col == 3 ){
				$ourtm .= '<div class="cols3 skt-team-box';
			}elseif( $col == 4 ){
				$ourtm .= '<div class="cols4 skt-team-box';
			} 
				$ourtm .= '"><div class="team-inner">';
 
			$ourtm .= ' 
			<div class="team-thumb">
			<a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), 'full') : '<img src="'.get_template_directory_uri().'/images/team_thumb.jpg" alt="teamimage" />' ).'</a></div>';
                $ourtm .= '<div class="team-infobox">
				<div class="info">
                	<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
					if( $designation != '' ){
                    $ourtm .= '<div class="team-desig">'.$designation.'</div>';
					}
 						$ourtm .= '<div class="social-icons">';
						if( $facebook != '' ){
                    	$ourtm .= '<a href="'.$facebooklink.'" title="'.$facebook.'" target="_blank"><i class="fa fa-'.$facebook.' fa-lg"></i></a>';
						}
						if( $twitter != '' ){
                    	$ourtm .= '<a href="'.$twitterlink.'" title="'.$twitter.'" target="_blank"><i class="fa fa-'.$twitter.' fa-lg"></i></a>';
						}
						if( $instagram != '' ){
                    	$ourtm .= '<a href="'.$instagramlink.'" title="'.$instagram.'" target="_blank"><i class="fa fa-'.$instagram.' fa-lg"></i></a>';
						}												
						if( $linkedin != '' ){
                    	$ourtm .= '<a href="'.$linkedinlink.'" title="'.$linkedin.'" target="_blank"><i class="fa fa-'.$linkedin.' fa-lg"></i></a>';
						}
						if( $pinterest != '' ){
                    	$ourtm .= '<a href="'.$pinterestlink.'" title="'.$pinterest.'" target="_blank"><i class="fa fa-'.$pinterest.' fa-lg"></i></a>';
						}
						
                $ourtm .= '</div></div></div></div>
				
				</div>';
		}
	}
	wp_reset_query();
	$ourtm .= '<div class="clear"></div></div></div>';

    return $ourtm;
}
add_shortcode( 'ourteam', 'admire_ourteam_func' );

// Testimonial Box
// [testimonials-box col="3" show="3"]
function admire_testimonials_box_func( $atts ) {
   extract( shortcode_atts( array(
		'col' => '3',
		'show' => '3',
	), $atts ) );
	  extract( shortcode_atts( array( 'show' => $show,), $atts ) ); $tstmnl = ''; wp_reset_query(); 

	$tstmnl = '<div class="testimonialrow">';
	$args = array( 'post_type' => 'testimonials', 'posts_per_page' => $show, 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	$n = 0;
	if ( have_posts() ) {
		while ( have_posts() ) { 
			$n++;
			the_post();
				$companyname = esc_html( get_post_meta( get_the_ID(), 'companyname', true ) );
				$possition = esc_html( get_post_meta( get_the_ID(), 'possition', true ) );
 			
			if( $col == 1 ){
				$tstmnl .= '<div class="tstcols1';
			}elseif( $col == 2 ){
				$tstmnl .= '<div class="tstcols2';
			}elseif( $col == 3 ){
				$tstmnl .= '<div class="tstcols3';
			}elseif( $col == 4 ){
				$tstmnl .= '<div class="tstcols4';
			}
				$tstmnl .= '">';
				
                $tstmnl .= '<div class="testimonial-box"> 
					 <em>'.get_the_content().'</em>
                     </div>
                     <div class="testimonial-inforarea">
                     	<i class="fa fa-user"></i>
<h3>'.get_the_title().' </h3><div class="clear"></div>';



$tstmnl .= '<span>';

if(!empty($companyname)){
	$tstmnl .= $companyname;
} 
$tstmnl .= '<br/>';
if(!empty($possition)){
	$tstmnl .= $possition;
} 

$tstmnl .= '</span>
                     </div>
				';
                $tstmnl .= '</div>
				';
		}
	}else{
		$tstmnl .= '
				<div class="tstcols3"> 
					 <div class="testimonial-box">
						<em>Sed suscipit mauris nec mauris vulputate, a posuere libero ongue. Nam laoreet elit eu erat pulvinar, et efficitur nibh imod. Proin venenatis orci sit amet nisl finibus vehicula. Nam metus lorem, hendrerit quis ante eget lobortis eleneque. Aliquam in ullamcorper quam. Integer euismod ligula in mauris vehicula imperdiet.</em>
					 </div>
					 <div class="testimonial-inforarea">
						<i class="fa fa-user"></i><h3>John,</h3>(Company Name, CEO)
					 </div>
				</div>
				<div class="tstcols3"> 
					 <div class="testimonial-box">
						<em>Sed suscipit mauris nec mauris vulputate, a posuere libero ongue. Nam laoreet elit eu erat pulvinar, et efficitur nibh imod. Proin venenatis orci sit amet nisl finibus vehicula. Nam metus lorem, hendrerit quis ante eget lobortis eleneque. Aliquam in ullamcorper quam. Integer euismod ligula in mauris vehicula imperdiet.</em>
					 </div>
					 <div class="testimonial-inforarea">
						<i class="fa fa-user"></i><h3>Stefen,</h3>(Company Name, Sr.Manager)
					 </div>
				</div>
				<div class="tstcols3"> 
					 <div class="testimonial-box">
						<em>Sed suscipit mauris nec mauris vulputate, a posuere libero ongue. Nam laoreet elit eu erat pulvinar, et efficitur nibh imod. Proin venenatis orci sit amet nisl finibus vehicula. Nam metus lorem, hendrerit quis ante eget lobortis eleneque. Aliquam in ullamcorper quam. Integer euismod ligula in mauris vehicula imperdiet.</em>
					 </div>
					 <div class="testimonial-inforarea">
						<i class="fa fa-user"></i><h3>Sara,</h3>(Company Name, Developer)
					 </div>
				</div>								
				
		';
	}
	wp_reset_query();
	$tstmnl .= '</div>';
    return $tstmnl;
}
add_shortcode( 'testimonials-box', 'admire_testimonials_box_func' );

//[testimonial-slider limit='-1']
function admire_testimonial_slider_func( $atts ) {
   extract( shortcode_atts( array(
    'limit' => '-1'
  ), $atts ) );  
  ob_start();  
  ?> 
  <div class="owl-carousel skt-testimonials">
	<?php $args = array( 'post_type' => 'testimonials', 'posts_per_page' => $limit );
	query_posts( $args );
	
	if ( have_posts() ) {
	while ( have_posts() ) { the_post();
	$position = esc_html( get_post_meta( get_the_ID(), 'possition', true ) );
	$companyname = esc_html( get_post_meta( get_the_ID(), 'companyname', true ) );
	?>
	<div class="item">
	  <div class="skt-testimonial-box"> 
        
        <div class="skt-testimonial-content"><?php the_content(); ?></div> 
        <?php if(has_post_thumbnail() ) { ?>  
          <div class="skt-testimonial-image"><?php the_post_thumbnail(); ?></div>
        <?php } ?>  
        <div class="skt-testimonial-dtl">
            <h3 class="skt-testimonial-title"><?php the_title(); ?></h3> 
            <div class="skt-testimonial-designation"><?php echo $companyname; ?> <?php if (!empty($companyname)) { echo '<br/>'; } ?> <?php echo esc_html($position);?></div>
        </div>
	  </div>       	
	</div>
    <?php } } else { ?><p><?php esc_html_e('Sorry! There are no posts.', 'admire-extra');?></p> <?php  } ?>  
  <?php wp_reset_query(); ?>  
  </div>
  <?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;  
}
add_shortcode( 'testimonial-slider', 'admire_testimonial_slider_func' );

//[testimonial-slider-style2 limit='-1']
function admire_testimonial_slider_style2_func( $atts ) {
   extract( shortcode_atts( array(
    'limit' => '-1'
  ), $atts ) );  
  ob_start();  
  ?> 
  <div class="owl-carousel skt-testimonials skt-testimonials-style2">
	<?php $args = array( 'post_type' => 'testimonials', 'posts_per_page' => $limit );
	query_posts( $args );
	
	if ( have_posts() ) {
	while ( have_posts() ) { the_post();
	$position = esc_html( get_post_meta( get_the_ID(), 'possition', true ) );
	$companyname = esc_html( get_post_meta( get_the_ID(), 'companyname', true ) );
	?>
	<div class="item">
	  <div class="skt-testimonial-box"> 

        <?php if(has_post_thumbnail() ) { ?>  
          <div class="skt-testimonial-image"><?php the_post_thumbnail(); ?></div>
        <?php } ?>  
        <div class="skt-testimonial-dtl">
            <h3 class="skt-testimonial-title"><?php the_title(); ?></h3> 
            <div class="skt-testimonial-designation"><?php echo $companyname; ?> <?php if (!empty($companyname)) { echo '<br/>'; } ?> <?php echo esc_html($position);?></div>
        </div>
        <div class="skt-testimonial-content"><?php the_content(); ?></div> 
	  </div>       	
	</div>
    <?php } } else { ?><p><?php esc_html_e('Sorry! There are no posts.', 'admire-extra');?></p> <?php  } ?>  
  <?php wp_reset_query(); ?>  
  </div>
  <?php
  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;  
}
add_shortcode( 'testimonial-slider-style2', 'admire_testimonial_slider_style2_func' );