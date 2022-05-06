<?php
/**
* The template for displaying 404 pages (not found).
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class='gridshow-main-wrapper gridshow-clearfix' id='gridshow-main-wrapper' itemscope='itemscope' itemtype='http://schema.org/Blog' role='main'>
<div class='theiaStickySidebar'>
<div class="gridshow-main-wrapper-inside gridshow-clearfix">

<div class='gridshow-posts-wrapper' id='gridshow-posts-wrapper'>

<div class='gridshow-posts gridshow-box'>
<div class="gridshow-box-inside">

<div class="gridshow-page-header-outside">
<header class="gridshow-page-header">
<div class="gridshow-page-header-inside">
    <?php if ( gridshow_get_option('error_404_heading') ) : ?>
    <h1 class="page-title"><?php echo esc_html( gridshow_get_option('error_404_heading') ); ?></h1>
    <?php else : ?>
    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'gridshow' ); ?></h1>
    <?php endif; ?>
</div>
</header><!-- .gridshow-page-header -->
</div>

<div class='gridshow-posts-content'>

    <?php if ( gridshow_get_option('error_404_message') ) : ?>
    <p><?php echo wp_kses_post( force_balance_tags( gridshow_get_option('error_404_message') ) ); ?></p>
    <?php else : ?>
    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gridshow' ); ?></p>
    <?php endif; ?>

    <?php if ( !(gridshow_get_option('hide_404_search')) ) { ?><?php get_search_form(); ?><?php } ?>

</div>

</div>
</div>

</div><!--/#gridshow-posts-wrapper -->

<?php gridshow_404_widgets(); ?>

</div>
</div>
</div><!-- /#gridshow-main-wrapper -->

<?php get_footer(); ?>