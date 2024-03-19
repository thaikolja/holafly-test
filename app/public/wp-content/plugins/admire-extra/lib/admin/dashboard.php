<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admire_Extra_Dashboard {
    static $_instance;
    public $title;
    public $config;
    public $current_tab = '';
    public $url = ''; // current page url

    static function admire_extra_get_instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
            self::$_instance->url = admin_url( 'admin.php' );
	          self::$_instance->url = add_query_arg( array( 'page' => 'admire-extra' ), self::$_instance->url );

            self::$_instance->title = esc_html__( 'Admire Options', 'admire-extra' );
			
			$theme = wp_get_theme();
			if ( 'Admire' == $theme->name || 'admire' == $theme->template ) {
            	add_action( 'admin_menu', array( self::$_instance, 'admire_extra_add_menu' ), 5 );
			}
            add_action( 'admin_enqueue_scripts', array(  self::$_instance, 'admire_extra_scripts' ) );
            add_action( 'admire/dashboard/main', array(  self::$_instance, 'admire_extra_box_links' ), 10 );
            add_action( 'admire/dashboard/sidebar', array(  self::$_instance, 'admire_extra_box_plugins' ), 10 );
            add_action( 'admire/dashboard/sidebar', array(  self::$_instance, 'admire_extra_box_recommend_plugins' ), 20 );
            add_action( 'admire/dashboard/sidebar', array(  self::$_instance, 'admire_extra_box_community' ), 25 );
            add_action( 'admin_bar_menu', array(  self::$_instance, 'admire_extra_admin_bar_button' ), 100 );

        }
        return self::$_instance;
    }

    function admire_extra_add_url_args( $args = array() ){
	    return add_query_arg( $args, self::$_instance->url );
    }

    function admire_extra_add_menu(){
        add_theme_page(
            $this->title,
            $this->title,
            'manage_options',
            'admire',
            array( $this, 'admire_extra_page' )
        );
    }
    function admire_extra_admin_bar_button($wp_admin_bar){
      if (current_user_can('manage_options')) {  
        $args = array(
            'id' => $this->title,
            'title' => 'Admire Theme',
            'href' => admin_url( 'themes.php?page=admire' ),
            'meta' => array(
              'class' => 'admire-admin'
            )
        );
        $wp_admin_bar->add_node($args);
      }
    }

	/**
     * Register scripts
     *
	 * @param $id
	 */
    function admire_extra_scripts($id)
    {
        wp_enqueue_style( 'admire-extra-notice', plugin_dir_url( __FILE__ ) . 'css/notice.css' );
        if ( $id != 'appearance_page_admire' && $id != 'themes.php' ) {
            return;
        }
        wp_enqueue_style('admire-admin', plugin_dir_url( __FILE__ ) . '/css/dashboard.css', false, '');
        if ( $id != 'themes' ) {
            wp_enqueue_style('plugin-install');
            wp_enqueue_script('plugin-install');
            wp_enqueue_script('updates');
            add_thickbox();
        }
    }

    function admire_extra_setup(){
        $theme = wp_get_theme();
        $this->config = array(
            'name' => $theme->get('Name'),
            'theme_uri' => $theme->get('ThemeURI'),
            'desc' => $theme->get('Description'),
            'author' => $theme->get('Author'),
            'author_uri' => $theme->get('AuthorURI'),
            'version' => $theme->get('Version'),
        );

        $this->current_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : '';
    }

    function admire_extra_page(){
        $this->admire_extra_setup();
        $this->page_header();
        echo '<div class="wrap">';
        $cb = apply_filters( 'admire/dashboard/content_cb',  false );
        if ( ! is_callable( $cb ) ) {
            $cb = array( $this, 'page_inner' );
        }

        if ( is_callable( $cb ) ) {
            call_user_func_array( $cb, array( $this ) );
        }

        echo '</div>';
    }

    public function page_header(){
        ?>
        <div class="cd-header">
            <div class="cd-row">
                <div class="cd-header-inner cd-branding">
                        <img src="<?php echo esc_url( get_template_directory_uri() ) .'/images/admire-logo.png'; ?>" alt="<?php esc_attr_e( 'logo', 'admire-extra' ); ?>">
                </div>
            </div>
        </div>
        <?php
    }

    function admire_extra_box_links(){
        $url = admin_url( 'customize.php' );

        $links = array(
            array(
                'label' => __( 'Logo & Site Identity', 'admire-extra' ),
                'url' => add_query_arg( array( 'autofocus' => array( 'section' => 'title_tagline' ) ), $url ),
            ),
            array(
                'label' => __( 'Header & Header Layouts', 'admire-extra' ),
                'url' => add_query_arg( array( 'autofocus' => array( 'panel' => 'header_panel' ) ), $url ),
            ),
            array(
                'label' => __( 'Posts & Pages Options', 'admire-extra' ),
                'url' => add_query_arg( array( 'autofocus' => array( 'section' => 'post_page_panel' ) ), $url ),
            ),
            array(
                'label' => __( 'Footer', 'admire-extra' ),
                'url' => add_query_arg( array( 'autofocus' => array( 'panel' => 'footer_panel' ) ), $url ),
            ),
            array(
                'label' => __( 'Colors', 'admire-extra' ),
                'url' => add_query_arg( array( 'autofocus' => array( 'section' => 'colors' ) ), $url ),
            ),
            array(
                'label' => __( 'Menu Options', 'admire-extra' ),
                'url' => add_query_arg( array( 'autofocus' => array( 'panel' => 'nav_menus' ) ), $url ),
            ),
            array(
                'label' => __( 'Homepage Settings', 'admire-extra' ),
                'url' => add_query_arg( array( 'autofocus' => array( 'section' => 'static_front_page' ) ), $url ),
            )
        );

        $links = apply_filters( 'admire/dashboard/links', $links );
        ?>
        <div class="cd-box">
            <div class="cd-box-top"><?php _e( 'Links to Customizer Settings', 'admire-extra' ); ?></div>
            <div class="cd-box-content">
                <ul class="cd-list-flex">
                    <?php foreach( $links as $l ) { ?>
                        <li class="">
                            <a class="cd-quick-setting-link" href="<?php echo esc_url( $l['url'] ); ?>" target="_blank"><?php echo esc_html( $l['label'] ); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php
    }

	/**
	 * Display documentation info
	 */
    function admire_extra_box_community() {
        ?>
        <div class="cd-box">
            <div class="cd-box-top"><?php esc_html_e( 'Knowledge Base', 'admire-extra' ); ?></div>
            <div class="cd-box-content">
                <p><?php esc_html_e( 'Not sure how something works? Take a peek at the knowledge base and learn.', 'admire-extra' ) ?></p>
                <a target="_blank" href="<?php echo esc_url( 'https://admiretheme.com/documentation/' ); ?>"><?php esc_html_e( 'Visit Knowledge Base', 'admire-extra' ); ?></a>
            </div>
        </div>
        <?php
    }

	/**
	 * Display import sites
	 */
    function admire_extra_box_plugins(){

        ?>
        <div class="cd-box box-plugins">
            <div class="cd-box-top"><?php esc_html_e( 'Admire ready to import sites', 'admire-extra' ); ?></div>
            <div class="cd-sites-thumb">
                <img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ) . 'img/admire-sites.png'; ?>">
            </div>
            <div class="cd-box-content">
                <p><?php esc_html_e( 'Import your favorite site with one click and start your project in style!', 'admire-extra' ) ?></p>
                <p>
                  <a href="<?php echo esc_url( admin_url( 'themes.php?page=admire-panel-install-demos' ) ); ?>" class="button action-btn view-site-library">
                    <?php esc_html_e( 'See Library', 'admire-extra' ) ?>
                  </a>
                </p>

            </div>
        </div>
        <?php
    }

    function admire_extra_get_plugin_file( $plugin_slug ) {
        $installed_plugins = get_plugins();
        foreach ( ( array ) $installed_plugins as $plugin_file => $info ) {
            if ( strpos( $plugin_file, $plugin_slug.'/' ) === 0 ) {
                return $plugin_file;
            }
        }
        return false;
    }

    function admire_extra_box_recommend_plugins(){

        $list_plugins = array(
            'elementor',
        );

        $list_plugins = apply_filters( 'admire/recommend-plugins', $list_plugins );
        $key = 'admire_plugins_info_'. wp_hash( json_encode( $list_plugins ) );
        $plugins_info = get_transient( $key );
        if ( false === $plugins_info) {
            $plugins_info =array();
            if ( ! function_exists( 'plugins_api' ) ) {
                require_once  ABSPATH.'/wp-admin/includes/plugin-install.php';
            }
            foreach ( $list_plugins as $slug ) {
                $info = plugins_api( 'plugin_information', array( 'slug' => $slug ) );
                if ( ! is_wp_error( $info ) ){
                    $plugins_info[ $slug ] = $info;
                }
            }
            set_transient( $key, $plugins_info );
        }

        $html  = '';
        foreach ( $plugins_info as $plugin_slug => $info ) {
            $status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_slug );
            $plugin_file = $this->admire_extra_get_plugin_file( $plugin_slug );
            if ( ! is_plugin_active( $plugin_file )  ) {
                $html .= '<div class="cd-list-item">';
                $html .= '<p class="cd-list-name">'.esc_html( $info->name ).'</p>';
                if ($status) {
                    $button_class = 'activate-now'; //
                    $button_txt = esc_html__('Activate', 'admire-extra');
                    $url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . urlencode($plugin_file), 'activate-plugin_' . $plugin_file);
                } else {
                    $button_class = 'install-now'; //
                    $button_txt = esc_html__('Install Now', 'admire-extra');
                    $url = wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'install-plugin',
                                'plugin' => $plugin_slug
                            ),
                            network_admin_url('update.php')
                        ),
                        'install-plugin_' . $plugin_slug
                    );
                }

                $detail_link = add_query_arg(
                    array(
                        'tab'       => 'plugin-information',
                        'plugin'    => $plugin_slug,
                        'TB_iframe' => 'true',
                        'width'     => '772',
                        'height'    => '349',
                    ),
                    network_admin_url('plugin-install.php')
                );

                $class = 'action-btn plugin-card-' . $plugin_slug;

                $html .= '<div class="rcp">';
                $html .= '<p class="' . esc_attr($class) . '"><a href="' . esc_url($url) . '" data-slug="' . esc_attr($plugin_slug) . '" class="' . esc_attr($button_class) . '">' . $button_txt . '</a></p>';
                $html .= '<a class="plugin-detail thickbox open-plugin-details-modal" href="' . esc_url($detail_link) . '">' . esc_html__('Details', 'admire-extra') . '</a>';
                $html .= '</div>';

                $html .= '</div>';
            }
        } // end foreach

        if ( $html ) {
            ?>
            <div class="cd-box">
                <div class="cd-box-top"><?php _e('Recommend Plugins', 'admire-extra'); ?></div>
                <div class="cd-box-content cd-list-border">
                    <?php
                        echo wp_kses_post($html); // WPCS: XSS OK.
                    ?>
                </div>
            </div>
            <?php
        }
    }

    private function page_inner(){
        ?>
        <div id="plugin-filter" class="cd-row metabox-holder">
            <hr class="wp-header-end">
            <?php

            do_action( 'admire/dashboard/start', $this );

            if ( $this->current_tab && has_action( 'admire/dashboard/tab/'.$this->current_tab ) ){
                do_action( 'admire/dashboard/tab/'.$this->current_tab, $this );
            } else {
	            ?>
                <div class="cd-main">
		            <?php do_action( 'admire/dashboard/main', $this ); ?>
                </div>
                <div class="cd-sidebar">
		            <?php do_action( 'admire/dashboard/sidebar', $this ); ?>
                </div>
	            <?php
            }

            do_action( 'admire/dashboard/end', $this );

            ?>
        </div>
    <?php
    }

}

Admire_Extra_Dashboard::admire_extra_get_instance();
