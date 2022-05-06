<?php
/**
* The file for displaying the search form
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<form role="search" method="get" class="gridshow-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<label>
    <span class="gridshow-sr-only"><?php echo esc_html_x( 'Search for:', 'label', 'gridshow' ); ?></span>
    <input type="search" class="gridshow-search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'gridshow' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
</label>
<input type="submit" class="gridshow-search-submit" value="<?php echo esc_attr_x( '&#xf002;', 'submit button', 'gridshow' ); ?>" />
</form>