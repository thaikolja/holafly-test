<?php
/**
 * Install demos page
 *
 * @package Admire_Extra
 * @category Core
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Start Class
class AdmireXTRA_Install_Demos {

    /**
     * Start things up
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_page'), 999);
    }

    /**
     * Add sub menu page for the custom CSS input
     *
     * @since 1.0.0
     */
    public function add_page() {

        $title = esc_html__('Install Admire Demos', 'admire-extra');

        add_submenu_page(
                'themes.php',
                esc_html__('Install Admire Demos', 'admire-extra'),
                $title,
                'manage_options',
                'admire-panel-install-demos',
                array($this, 'create_admin_page')
        );
    }

    /**
     * Settings page output
     *
     * @since 1.0.0
     */
    public function create_admin_page() {

        // Theme branding
        $brand = 'Admire';
		?>

        <div class="fwp-demo-wrap wrap">
            <h2><?php echo esc_attr($brand); ?> - <?php esc_attr_e('Install Demos', 'admire-extra'); ?></h2>
            <div class="theme-browser rendered">

                <?php
                // Vars
                $demos = AdmireXTRA_Demos::get_demos_data();
                $categories = AdmireXTRA_Demos::get_demo_all_categories($demos);
                ?>

                <?php if (!empty($categories)) : ?>
                    <div class="fwp-header-bar">
                        <nav class="fwp-navigation">
                            <ul>
                                <li class="active"><a href="#all" class="fwp-navigation-link"><?php esc_html_e('All', 'admire-extra'); ?></a></li>
                                <?php foreach ($categories as $key => $name) : ?>
                                    <li><a href="#<?php echo esc_attr($key); ?>" class="fwp-navigation-link"><?php echo esc_html($name); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                        <div clas="fwp-search">
                            <input type="text" class="fwp-search-input" name="fwp-search" value="" placeholder="<?php esc_html_e('Search demos...', 'admire-extra'); ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="themes wp-clearfix">

                    <?php
                    // Loop through all demos
                    foreach ($demos as $demo => $key) {

                        // Vars
                        $item_categories = AdmireXTRA_Demos::get_demo_item_categories($key);
                        $title = str_replace('demo', '', $demo);
                        $title = str_replace('-', ' ', $title);
                        $pro = $key['required_plugins'];
                        ?>

                        <div class="theme-wrap dm-<?php echo esc_attr($item_categories); ?>" data-categories="<?php echo esc_attr($item_categories); ?>" data-name="<?php echo esc_attr(strtolower($demo)); ?>">
                            <div class="theme fwp-open-popup" data-demo-id="<?php echo esc_attr($demo); ?>">
                                <div class="theme-screenshot">
                                    <img src="<?php echo esc_url('https://admiretheme.com/demos/').esc_attr($demo); ?>.jpg" />
                                    <div class="demo-import-loader preview-all preview-all-<?php echo esc_attr($demo); ?>"></div>
                                    <div class="demo-import-loader preview-icon preview-<?php echo esc_attr($demo); ?>"><i class="custom-loader"></i></div>
                                </div>

                                <div class="theme-id-container">
                                    <h2 class="theme-name" id="<?php echo esc_attr($demo); ?>"><span><?php echo esc_attr(ucwords($title)); ?></span></h2>

                                    <div class="theme-actions">
                                        <a class="button button-primary" href="<?php echo esc_url('https://admiretheme.com/demos/').esc_attr($demo); ?>" target="_blank"><?php _e('Live Preview', 'admire-extra'); ?></a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

        <?php
    }

}

new AdmireXTRA_Install_Demos();
