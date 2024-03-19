<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Start Class
if (!class_exists('AdmireXTRA_Demos')) {

    class AdmireXTRA_Demos {

        /**
         * Start things up
         */
        public function __construct() {

            // Return if not in admin
            if (!is_admin() || is_customize_preview()) {
                return;
            }

            // Import demos page
            if (version_compare(PHP_VERSION, '5.4', '>=')) {
                require_once( ADMR_XTRA_PATH . '/classes/importers/class-helpers.php' );
                require_once( ADMR_XTRA_PATH . '/classes/class-install-demos.php' );
            }

            // Disable Woo Wizard
            add_filter('woocommerce_enable_setup_wizard', '__return_false');
            add_filter('woocommerce_show_admin_notice', '__return_false');
            add_filter('woocommerce_prevent_automatic_wizard_redirect', '__return_false');

            // Start things
            add_action('admin_init', array($this, 'init'));

            // Demos scripts
            add_action('admin_enqueue_scripts', array($this, 'scripts'));

            // Allows xml uploads
            add_filter('upload_mimes', array($this, 'allow_xml_uploads'));

            // Demos popup
            add_action('admin_footer', array($this, 'popup'));
        }

        /**
         * Register the AJAX methods
         *
         * @since 1.0.0
         */
        public function init() {

            // Demos popup ajax
            add_action('wp_ajax_admire_ajax_get_demo_data', array($this, 'ajax_demo_data'));
            add_action('wp_ajax_admire_ajax_required_plugins_activate', array($this, 'ajax_required_plugins_activate'));

            // Get data to import
            add_action('wp_ajax_admire_ajax_get_import_data', array($this, 'ajax_get_import_data'));

            // Import XML file
            add_action('wp_ajax_admire_ajax_import_xml', array($this, 'ajax_import_xml'));

            // Import customizer settings
            add_action('wp_ajax_admire_ajax_import_theme_settings', array($this, 'ajax_import_theme_settings'));

            // Import widgets
            add_action('wp_ajax_admire_ajax_import_widgets', array($this, 'ajax_import_widgets'));

            // Reset theme mods
            add_action('wp_ajax_admire_ajax_reset_mods', array($this, 'ajax_reset_mods'));

            // After import
            add_action('wp_ajax_admire_after_import', array($this, 'ajax_after_import'));
        }

        /**
         * Load scripts
         *
         * @since 1.4.5
         */
        public static function scripts($hook_suffix) {
            if ('appearance_page_admire-panel-install-demos' == $hook_suffix) {

                // CSS
                wp_enqueue_style('fwp-demos-style', plugins_url('/assets/css/demos.min.css', __FILE__));

                // JS
                wp_enqueue_script('fwp-demos-js', plugins_url('/assets/js/demos.min.js', __FILE__), array('jquery', 'wp-util', 'updates'), '1.0', true);

                wp_localize_script('fwp-demos-js', 'admireDemos', array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'demo_data_nonce' => wp_create_nonce('get-demo-data'),
                    'admire_import_data_nonce' => wp_create_nonce('admire_import_data_nonce'),
                    'content_importing_error' => esc_html__('There was a problem during the importing process resulting in the following error from your server:', 'admire-extra'),
                    'button_activating' => esc_html__('Activating', 'admire-extra') . '&hellip;',
                    'button_active' => esc_html__('Active', 'admire-extra'),
                ));
            }
        }

        /**
         * Allows xml uploads so we can import from github
         *
         * @since 1.0.0
         */
        public function allow_xml_uploads($mimes) {
            $mimes = array_merge($mimes, array(
                'xml' => 'application/xml'
            ));
            return $mimes;
        }

        /**
         * Get demos data to add them in the Demo Import plugins
         *
         * @since 1.4.5
         */
		 
        public static function get_demos_data() {
			include WP_PLUGIN_DIR . '/admire-extra/include/lib/controllers/module/module-check.php';
            // Return
            return apply_filters('admire_demos_data', $data);
        }

        /**
         * Get the category list of all categories used in the predefined demo imports array.
         *
         * @since 1.4.5
         */
        public static function get_demo_all_categories($demo_imports) {
            $categories = array();

            foreach ($demo_imports as $item) {
                if (!empty($item['categories']) && is_array($item['categories'])) {
                    foreach ($item['categories'] as $category) {
                        $categories[sanitize_key($category)] = $category;
                    }
                }
            }

            if (empty($categories)) {
                return false;
            }

            return $categories;
        }

        /**
         * Return the concatenated string of demo import item categories.
         * These should be separated by comma and sanitized properly.
         *
         * @since 1.4.5
         */
        public static function get_demo_item_categories($item) {
            $sanitized_categories = array();

            if (isset($item['categories'])) {
                foreach ($item['categories'] as $category) {
                    $sanitized_categories[] = sanitize_key($category);
                }
            }

            if (!empty($sanitized_categories)) {
                return implode(',', $sanitized_categories);
            }

            return false;
        }

        /**
         * Demos popup
         *
         * @since 1.4.5
         */
        public static function popup() {
            global $pagenow;

            // Display on the demos pages
            if (( 'themes.php' == $pagenow && isset($_GET['page']) && 'admire-panel-install-demos' == $_GET['page'])) {
                ?>

                <div id="fwp-demo-popup-wrap">
                    <div class="fwp-demo-popup-container">
                        <div class="fwp-demo-popup-content-wrap">
                            <div class="fwp-demo-popup-content-inner">
                                <a href="#" class="fwp-demo-popup-close">×</a>
                                <div id="fwp-demo-popup-content"></div>
                            </div>
                        </div>
                    </div>
                    <div class="fwp-demo-popup-overlay"></div>
                </div>

                <?php
            }
        }

        /**
         * Demos popup ajax.
         *
         * @since 1.4.5
         */
        public static function ajax_demo_data() {

            // Database reset url
            if (is_plugin_active('wordpress-database-reset/wp-reset.php')) {
                $plugin_link = admin_url('tools.php?page=database-reset');
            } else {
                $plugin_link = admin_url('plugin-install.php?s=Wordpress+Database+Reset&tab=search');
            }

            // Get all demos
            $demos = self::get_demos_data();

            // Get selected demo
            $demo = $_GET['demo_name'];

            // Get required plugins
            $plugins = $demos[$demo]['required_plugins'];
			
			$themeset = $demos[$demo]['theme_settings'];
			
			$widgset = $demos[$demo]['widgets_file']; 

            // Get free plugins
            $free = $plugins['free'];

            // Get recommended plugins
            $recommended = $plugins['recommended'];

            ?>

            <div id="fwp-demo-plugins">

                <h2 class="title"><?php echo sprintf(esc_html__('Import the %1$s', 'admire-extra'), esc_attr($demo)); ?></h2>

                <div class="fwp-popup-text">

                    <p><?php
                        echo
                        sprintf(
                                esc_html__('Importing demo data allow you to quickly edit everything instead of creating content from scratch. It is recommended uploading sample data on a fresh WordPress install to prevent conflicts with your current content. You can use this plugin to reset your site if needed: %1$sWordpress Database Reset%2$s.', 'admire-extra'),
                                '<a href="' . $plugin_link . '" target="_blank">',
                                '</a>'
                        );
                        ?></p>

                    <div class="fwp-required-plugins-wrap">
                        <h3><?php esc_html_e('Required Plugins', 'admire-extra'); ?></h3>
                        <p><?php esc_html_e('For your site to look exactly like this demo, the plugins below need to be activated.', 'admire-extra'); ?></p>
                        <div class="fwp-required-plugins oe-plugin-installer">
                            <?php
                            self::required_plugins($free, 'free');
                            ?>
                        </div>
                        <?php if (isset($recommended) && !empty($recommended)) { ?>
                            <h3><?php esc_html_e('Recommended Plugins', 'admire-extra'); ?></h3>
                            <p><?php esc_html_e('These plugins are not required for the demo import. However, if you do not install them, some demo features will not be included.', 'admire-extra'); ?></p>
                            <div class="fwp-required-plugins oe-plugin-installer">
                                <?php self::required_plugins($recommended, 'recommended'); ?>
                            </div>
                        <?php } ?>
                    </div>

                </div>

                <div class="fwp-button fwp-plugins-next">
                        <a href="#">
                            <?php esc_html_e('Go to the next step', 'admire-extra'); ?>
                        </a>
                    </div>


            </div>

            <form method="post" id="fwp-demo-import-form">

                <input id="admire_import_demo" type="hidden" name="admire_import_demo" value="<?php echo esc_attr($demo); ?>" />

                <div class="fwp-demo-import-form-types">

                    <h2 class="title"><?php esc_html_e('Select what you want to import:', 'admire-extra'); ?></h2>

                    <ul class="fwp-popup-text">
                    	
                        <li>
                            <label for="admire_reset_mods">
                                <input id="admire_reset_mods" type="checkbox" name="admire_reset_mods"  />
                                <strong><?php esc_html_e('Reset theme options', 'admire-extra'); ?></strong> (<?php esc_html_e('Customizer options', 'admire-extra'); ?>)
                            </label>
                        </li>
                        <li>
                            <label for="admire_import_xml">
                                <input id="admire_import_xml" type="checkbox" name="admire_import_xml" checked="checked" />
                                <strong><?php esc_html_e('Import XML Data', 'admire-extra'); ?></strong> (<?php esc_html_e('pages, posts, images, menus, etc...', 'admire-extra'); ?>)
                            </label>
                        </li>
                        
                        <li>
                            <label for="admire_theme_settings">
                                <input id="admire_theme_settings" type="checkbox" name="admire_theme_settings" checked="checked" />
                                <strong><?php esc_html_e('Import Customizer Settings', 'admire-extra'); ?></strong>
                            </label>
                        </li>
                        
                        <li>
                            <label for="admire_import_widgets">
                                <input id="admire_import_widgets" type="checkbox" name="admire_import_widgets" checked="checked" />
                                <strong><?php esc_html_e('Import Widgets', 'admire-extra'); ?></strong>
                            </label>
                        </li>
                    </ul>

                </div>

                <?php wp_nonce_field('admire_import_demo_data_nonce', 'admire_import_demo_data_nonce'); ?>
                <input type="submit" name="submit" class="fwp-button fwp-import" value="<?php esc_html_e('Install this demo', 'admire-extra'); ?>"  />

            </form>

            <div class="fwp-loader">
                <h2 class="title"><?php esc_html_e('The import process could take some time, please be patient', 'admire-extra'); ?></h2>
                <div class="fwp-import-status fwp-popup-text"></div>
            </div>

            <div class="fwp-last">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"></circle><path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path></svg>
                <h3><?php esc_html_e('Demo Imported!', 'admire-extra'); ?></h3>
                <a href="<?php echo esc_url(get_home_url()); ?>"" target="_blank"><?php esc_html_e('See the result', 'admire-extra'); ?></a>
            </div>

            <?php
            die();
        }

        /**
         * Required plugins.
         *
         * @since 1.4.5
         */
        public static function required_plugins($plugins, $return) {

            foreach ($plugins as $key => $plugin) {

                $api = array(
                    'slug' => isset($plugin['slug']) ? $plugin['slug'] : '',
                    'init' => isset($plugin['init']) ? $plugin['init'] : '',
                    'name' => isset($plugin['name']) ? $plugin['name'] : '',
                );

                if (!is_wp_error($api)) { // confirm error free
                    // Installed but Inactive.
                    if (file_exists(WP_PLUGIN_DIR . '/' . $plugin['init']) && is_plugin_inactive($plugin['init'])) {

                        $button_classes = 'button activate-now button-primary';
                        $button_text = esc_html__('Activate', 'admire-extra');

                        // Not Installed.
                    } elseif (!file_exists(WP_PLUGIN_DIR . '/' . $plugin['init'])) {

                        $button_classes = 'button install-now';
                        $button_text = esc_html__('Install Now', 'admire-extra');

                        // Active.
                    } else {
                        $button_classes = 'button disabled';
                        $button_text = esc_html__('Activated', 'admire-extra');
                    }
                    ?>

                    <div class="fwp-plugin fwp-clr fwp-plugin-<?php echo esc_attr($api['slug']); ?>" data-slug="<?php echo esc_attr($api['slug']); ?>" data-init="<?php echo esc_attr($api['init']); ?>">
                        <h2><?php echo esc_html($api['name']); ?></h2>

 
                            <button class="<?php echo esc_attr($button_classes); ?>" data-init="<?php echo esc_attr($api['init']); ?>" data-slug="<?php echo esc_attr($api['slug']); ?>" data-name="<?php echo esc_attr($api['name']); ?>"><?php echo esc_html($button_text); ?></button>
                    </div>

                    <?php
                }
            }
        }

        /**
         * Required plugins activate
         *
         * @since 1.4.5
         */
        public function ajax_required_plugins_activate() {

            if (!current_user_can('install_plugins') || !isset($_POST['init']) || !$_POST['init']) {
                wp_send_json_error(
                        array(
                            'success' => false,
                            'message' => __('No plugin specified', 'admire-extra'),
                        )
                );
            }

            $plugin_init = ( isset($_POST['init']) ) ? esc_attr($_POST['init']) : '';
            $activate = activate_plugin($plugin_init, '', false, true);

            if (is_wp_error($activate)) {
                wp_send_json_error(
                        array(
                            'success' => false,
                            'message' => $activate->get_error_message(),
                        )
                );
            }

            wp_send_json_success(
                    array(
                        'success' => true,
                        'message' => __('Plugin Successfully Activated', 'admire-extra'),
                    )
            );
        }

        /**
         * Returns an array containing all the importable content
         *
         * @since 1.4.5
         */
        public function ajax_get_import_data() {
            check_ajax_referer('admire_import_data_nonce', 'security');

            echo json_encode(
                    array(
                        array(
                            'input_name' => 'admire_reset_mods',
                            'action' => 'admire_ajax_reset_mods',
                            'method' => 'ajax_reset_mods',
                            'loader' => esc_html__('Reseting Theme Options', 'admire-extra')
                        ),
                        array(
                            'input_name' => 'admire_import_xml',
                            'action' => 'admire_ajax_import_xml',
                            'method' => 'ajax_import_xml',
                            'loader' => esc_html__('Importing XML Data', 'admire-extra')
                        ),
                        array(
                            'input_name' => 'admire_theme_settings',
                            'action' => 'admire_ajax_import_theme_settings',
                            'method' => 'ajax_import_theme_settings',
                            'loader' => esc_html__('Importing Customizer Settings', 'admire-extra')
                        ),
                        array(
                            'input_name' => 'admire_import_widgets',
                            'action' => 'admire_ajax_import_widgets',
                            'method' => 'ajax_import_widgets',
                            'loader' => esc_html__('Importing Widgets', 'admire-extra')
                        ),
                    )
            );

            die();
        }

        /**
         * Import XML file
         *
         * @since 1.4.5
         */
        public function ajax_reset_mods() {
            if (!wp_verify_nonce($_POST['admire_import_demo_data_nonce'], 'admire_import_demo_data_nonce')) {
                die('This action was stopped for security purposes.');
            }
            $save_result = 1;
            // Get the selected demo
            $demo_type = $_POST['admire_reset_mods'];
            //just in case have these files included
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/template.php');

            //we are checking if file system can operate without FTP creds
            $url = wp_nonce_url(admin_url(), '');
            if (false === ( $creds = request_filesystem_credentials($url, '', false, false, null) )) {
                $save_result = 0;
            } elseif (!WP_Filesystem($creds)) {
                request_filesystem_credentials($url, '', true, false, null);
                $save_result = 0;
            }
            // Save the theme mods before deleting
            if ($save_result === 1) {
                global $wp_filesystem;
                $upload_dir = wp_upload_dir();
                $directory = trailingslashit($upload_dir['basedir']) . 'admire-files';
                if (!is_dir($directory)) {
                    wp_mkdir_p($directory);
                }
                if (is_writable($directory)) {
                    $file = $directory . '/admire' . date('Y-m-d-h-i-s') . '.json';

                    //in case of FTP access we need to make sure we have proper path
                    $file = str_replace(ABSPATH, $wp_filesystem->abspath(), $file);

                    $theme_mods = get_theme_mods();
                    $mods = array();
                    foreach ($theme_mods as $theme_mod => $value) {
                        $mods[$theme_mod] = maybe_unserialize($value);
                    }
                    $json = json_encode($mods);
                    $wp_filesystem->put_contents(
                            $file,
                            $json,
                            FS_CHMOD_FILE
                    );
                }
            }
            $result = '';

            // Get the selected demo
            remove_theme_mods();
            if (is_wp_error($result)) {
                echo esc_attr(json_encode($result->errors));
            } else {
                echo esc_attr('successful import');
            }
            die();
        }

        /**
         * Import XML file
         *
         * @since 1.4.5
         */
        public function ajax_import_xml() {
            if (!wp_verify_nonce($_POST['admire_import_demo_data_nonce'], 'admire_import_demo_data_nonce')) {
                die('This action was stopped for security purposes.');
            }

            // Get the selected demo
            $demo_type = $_POST['admire_import_demo'];

            // Get demos data
            $demo = AdmireXTRA_Demos::get_demos_data()[$demo_type];

            // Content file
            $xml_file = isset($demo['xml_file']) ? $demo['xml_file'] : '';

            // Delete the default post and page
            $sample_page = get_page_by_path('sample-page', OBJECT, 'page');
            $hello_world_post = get_page_by_path('hello-world', OBJECT, 'post');

            if (!is_null($sample_page)) {
                wp_delete_post($sample_page->ID, true);
            }

            if (!is_null($hello_world_post)) {
                wp_delete_post($hello_world_post->ID, true);
            }

            // Import Posts, Pages, Images, Menus.
            $result = $this->process_xml($xml_file);

            if (is_wp_error($result)) {
                echo esc_attr(json_encode($result->errors));
            } else {
                echo esc_attr('successful import');
            }

            die();
        }

        /**
         * Import customizer settings
         *
         * @since 1.4.5
         */
        public function ajax_import_theme_settings() {
            if (!wp_verify_nonce($_POST['admire_import_demo_data_nonce'], 'admire_import_demo_data_nonce')) {
                die('This action was stopped for security purposes.');
            }

            // Include settings importer
            include ADMR_XTRA_PATH . 'classes/importers/class-settings-importer.php';

            // Get the selected demo
            $demo_type = $_POST['admire_import_demo'];

            // Get demos data
            $demo = AdmireXTRA_Demos::get_demos_data()[$demo_type];

            // Settings file
            $theme_settings = isset($demo['theme_settings']) ? $demo['theme_settings'] : '';

            // Import settings.
            $settings_importer = new FWP_Settings_Importer();
            $result = $settings_importer->process_import_file($theme_settings);

            if (is_wp_error($result)) {
                echo esc_attr(json_encode($result->errors));
            } else {
                echo esc_attr('successful import');
            }

            die();
        }

        /**
         * Import widgets
         *
         * @since 1.4.5
         */
        public function ajax_import_widgets() {
            if (!wp_verify_nonce($_POST['admire_import_demo_data_nonce'], 'admire_import_demo_data_nonce')) {
                die('This action was stopped for security purposes.');
            }

            // Include widget importer
            include ADMR_XTRA_PATH . 'classes/importers/class-widget-importer.php';

            // Get the selected demo
            $demo_type = $_POST['admire_import_demo'];

            // Get demos data
            $demo = AdmireXTRA_Demos::get_demos_data()[$demo_type];

            // Widgets file
            $widgets_file = isset($demo['widgets_file']) ? $demo['widgets_file'] : '';

            // Import settings.
            $widgets_importer = new FWP_Widget_Importer();
            $result = $widgets_importer->process_import_file($widgets_file);

            if (is_wp_error($result)) {
                echo esc_attr(json_encode($result->errors));
            } else {
                echo esc_attr('successful import');
            }

            die();
        }

        /**
         * After import
         *
         * @since 1.4.5
         */
        public static function ajax_after_import() {
            if (!wp_verify_nonce($_POST['admire_import_demo_data_nonce'], 'admire_import_demo_data_nonce')) {
                die('This action was stopped for security purposes.');
            }

            // If XML file is imported
            if ($_POST['admire_import_is_xml'] === 'true') {

                // Get the selected demo
                $demo_type = $_POST['admire_import_demo'];

                // Get demos data
                $demo = AdmireXTRA_Demos::get_demos_data()[$demo_type];

                // Elementor width setting
                $elementor_width = isset($demo['elementor_width']) ? $demo['elementor_width'] : '';

                // Reading settings
				$homepage_title = isset( $demo['home_title'] ) ? $demo['home_title'] : 'Home';
				
                $blog_title = isset($demo['blog_title']) ? $demo['blog_title'] : '';

                // Posts to show on the blog page
                $posts_to_show = isset($demo['posts_to_show']) ? $demo['posts_to_show'] : '';

                // If shop demo
                $shop_demo = isset($demo['is_shop']) ? $demo['is_shop'] : false;

                // Product image size
                $image_size = isset($demo['woo_image_size']) ? $demo['woo_image_size'] : '';
                $thumbnail_size = isset($demo['woo_thumb_size']) ? $demo['woo_thumb_size'] : '';
                $crop_width = isset($demo['woo_crop_width']) ? $demo['woo_crop_width'] : '';
                $crop_height = isset($demo['woo_crop_height']) ? $demo['woo_crop_height'] : '';

                // Assign WooCommerce pages if WooCommerce Exists
                if (class_exists('WooCommerce') && true == $shop_demo) {

                    $woopages = array(
                        'woocommerce_shop_page_id' => 'Shop',
                        'woocommerce_cart_page_id' => 'Cart',
                        'woocommerce_checkout_page_id' => 'Checkout',
                        'woocommerce_pay_page_id' => 'Checkout &#8594; Pay',
                        'woocommerce_thanks_page_id' => 'Order Received',
                        'woocommerce_myaccount_page_id' => 'My Account',
                        'woocommerce_edit_address_page_id' => 'Edit My Address',
                        'woocommerce_view_order_page_id' => 'View Order',
                        'woocommerce_change_password_page_id' => 'Change Password',
                        'woocommerce_logout_page_id' => 'Logout',
                        'woocommerce_lost_password_page_id' => 'Lost Password'
                    );

                    foreach ($woopages as $woo_page_name => $woo_page_title) {

                        $woopage = get_page_by_title($woo_page_title);
                        if (isset($woopage) && $woopage->ID) {
                            update_option($woo_page_name, $woopage->ID);
                        }
                    }

                    // We no longer need to install pages
                    delete_option('_wc_needs_pages');
                    delete_transient('_wc_activation_redirect');

                    // Get products image size
                    update_option('woocommerce_single_image_width', $image_size);
                    update_option('woocommerce_thumbnail_image_width', $thumbnail_size);
                    update_option('woocommerce_thumbnail_cropping', 'custom');
                    update_option('woocommerce_thumbnail_cropping_custom_width', $crop_width);
                    update_option('woocommerce_thumbnail_cropping_custom_height', $crop_height);
                }

                // Set imported menus to registered theme locations
                $locations = get_theme_mod('nav_menu_locations');
                $menus = wp_get_nav_menus();

                if ($menus) {

                    foreach ($menus as $menu) {

                        if ($menu->name == 'Default Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Solarenergy Header') {
                            $locations['primary'] = $menu->term_id;
                        } 
						elseif ($menu->name == 'Golf Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Defaultgb Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Holi Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Electrician Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Nature Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Architect Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Webdesigner Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Interior Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Tshirt Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Salon Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Ayurveda Header') {
                            $locations['primary'] = $menu->term_id;
                        }						
						elseif ($menu->name == 'Podcast Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Senator Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Shoes Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Skincare Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Insurance Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Sandwich Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Plants Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Christmas Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Doctor Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Coachpress Header') {
                            $locations['primary'] = $menu->term_id;
                        }	
						elseif ($menu->name == 'Shopping Header') {
                            $locations['primary'] = $menu->term_id;
                        }	
						elseif ($menu->name == 'Infotech Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Itcompany Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Renovation Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Construction Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Hotel Header') {
                            $locations['primary'] = $menu->term_id;
                        }	
						elseif ($menu->name == 'Fitness Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Charity Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Naturegb Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Extremegb Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Taoism Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Immigration Header') {
                            $locations['primary'] = $menu->term_id;
                        }	
						elseif ($menu->name == 'Accounting Header') {
                            $locations['primary'] = $menu->term_id;
                        }	
						elseif ($menu->name == 'Specialistadm Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Womanadm Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Taxiadm Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Waterpurifier Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Sushi Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Sportshoes Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Spa Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Solarenergy Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Skincare Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Resort Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Palmhealing Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Geyser Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Fruits Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Ecology Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'Eauto Header') {
                            $locations['primary'] = $menu->term_id;
                        }
						elseif ($menu->name == 'SKT Default Header') {
                            $locations['primary'] = $menu->term_id;
                        }	
						elseif ($menu->name == 'SKT Defaultgb Header') {
                            $locations['primary'] = $menu->term_id;
                        }											

                    }
                }

                // Set menus to locations
                set_theme_mod('nav_menu_locations', $locations);

                // Disable Elementor default settings
                update_option('elementor_disable_color_schemes', 'yes');
                update_option('elementor_disable_typography_schemes', 'yes');
                if (!empty($elementor_width)) {
                    update_option('elementor_container_width', $elementor_width);
                }

                // Assign front page and posts page (blog page).
                $home_page = get_page_by_title('Home');
                $blog_page = get_page_by_title($blog_title);
				
				update_option('show_on_front', 'page');

			    if ($home_page) {
					update_option( 'page_on_front', $home_page->ID );
				}

                if (is_object($blog_page)) {
                    update_option('page_for_posts', $blog_page->ID);
                }

                // Posts to show on the blog page
                if (!empty($posts_to_show)) {
                    update_option('posts_per_page', $posts_to_show);
                }
				
				
            }

            die();
        }

        /**
         * Import XML data
         *
         * @since 1.0.0
         */
        public function process_xml($file) {

            $response = FWP_Demos_Helpers::get_remote($file);

            // No sample data found
            if ($response === false) {
                return new WP_Error('xml_import_error', __('Can not retrieve sample data xml file. Website may be down at the momment please try again later. If you still have issues contact the developer for assistance.', 'admire-extra'));
            }

            // Write sample data content to temp xml file
            $temp_xml = ADMR_XTRA_PATH . 'classes/importers/temp.xml';
            file_put_contents($temp_xml, $response);

            // Set temp xml to attachment url for use
            $attachment_url = $temp_xml;

            // If file exists lets import it
            if (file_exists($attachment_url)) {
                $this->import_xml($attachment_url);
            } else {
                // Import file can't be imported - we should die here since this is core for most people.
                return new WP_Error('xml_import_error', __('The xml import file could not be accessed. Please try again or contact the theme developer.', 'admire-extra'));
            }
        }

        /**
         * Import XML file
         *
         * @since 1.0.0
         */
        private function import_xml($file) {

            // Make sure importers constant is defined
            if (!defined('WP_LOAD_IMPORTERS')) {
                define('WP_LOAD_IMPORTERS', true);
            }

            // Import file location
            $import_file = ABSPATH . 'wp-admin/includes/import.php';

            // Include import file
            if (!file_exists($import_file)) {
                return;
            }

            // Include import file
            require_once( $import_file );

            // Define error var
            $importer_error = false;

            if (!class_exists('WP_Importer')) {
                $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

                if (file_exists($class_wp_importer)) {
                    require_once $class_wp_importer;
                } else {
                    $importer_error = __('Can not retrieve class-wp-importer.php', 'admire-extra');
                }
            }

            if (!class_exists('WP_Import')) {
                $class_wp_import = ADMR_XTRA_PATH . 'classes/importers/class-wordpress-importer.php';

                if (file_exists($class_wp_import)) {
                    require_once $class_wp_import;
                } else {
                    $importer_error = __('Can not retrieve wordpress-importer.php', 'admire-extra');
                }
            }

            // Display error
            if ($importer_error) {
                return new WP_Error('xml_import_error', $importer_error);
            } else {

                // No error, lets import things...
                if (!is_file($file)) {
                    $importer_error = __('Sample data file appears corrupt or can not be accessed.', 'admire-extra');
                    return new WP_Error('xml_import_error', $importer_error);
                } else {
                    $importer = new WP_Import();
                    $importer->fetch_attachments = true;
                    $importer->import($file);

                    // Clear sample data content from temp xml file
                    $temp_xml = ADMR_XTRA_PATH . 'classes/importers/temp.xml';
                    file_put_contents($temp_xml, '');
                }
            }
        }

    }

}
new AdmireXTRA_Demos();
