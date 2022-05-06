<?php
/**
* GridShow functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

define( 'GRIDSHOW_PROURL', 'https://themesdna.com/gridshow-pro-wordpress-theme/' );
define( 'GRIDSHOW_CONTACTURL', 'https://themesdna.com/contact/' );
define( 'GRIDSHOW_THEMEOPTIONSDIR', trailingslashit( get_template_directory() ) . 'theme-setup' );

require_once( trailingslashit( GRIDSHOW_THEMEOPTIONSDIR ) . 'theme-options.php' );
require_once( trailingslashit( GRIDSHOW_THEMEOPTIONSDIR ) . 'theme-functions.php' );