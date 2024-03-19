<?php
/*
Plugin Name: Translatable Menu for Polylang
Description: Easily create language-dynamic menus and use them in content or templates, without coding.
Version: 1.1
Author: Smooth Websites
Author URI: https://smoothwebsites.net/
*/

// Functions
require_once dirname( __FILE__ ) .'/function-menu-name.php'; // Return dynamic menu name for use with OxyExtras slide menu
require_once dirname( __FILE__ ) .'/shortcode-menu.php'; // Output a basic menu