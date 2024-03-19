<?php
function sw_menu_name($menu_slug) {
	if(function_exists('pll_current_language')) {
		$menu_name = $menu_slug . '-' . pll_current_language('slug');
		return $menu_name;
	} else {
		return false;
	}
}