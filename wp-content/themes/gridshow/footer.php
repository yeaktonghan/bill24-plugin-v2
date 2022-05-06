<?php
/**
* The template for displaying the footer
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

</div>

</div><!--/#gridshow-content-wrapper -->
</div><!--/#gridshow-wrapper -->

<?php gridshow_bottom_wide_widgets(); ?>

<?php if ( 'before-footer' === gridshow_secondary_menu_location() ) { ?><?php gridshow_secondary_menu_area(); ?><?php } ?>

<?php gridshow_before_footer(); ?>

<?php if ( !(gridshow_hide_footer_widgets()) ) { ?>
<?php if ( is_active_sidebar( 'gridshow-footer-1' ) || is_active_sidebar( 'gridshow-footer-2' ) || is_active_sidebar( 'gridshow-footer-3' ) || is_active_sidebar( 'gridshow-footer-4' ) || is_active_sidebar( 'gridshow-top-footer' ) || is_active_sidebar( 'gridshow-bottom-footer' ) ) : ?>
<div class='gridshow-clearfix' id='gridshow-footer-blocks' itemscope='itemscope' itemtype='http://schema.org/WPFooter' role='contentinfo'>
<div class='gridshow-container gridshow-clearfix'>
<div class="gridshow-outer-wrapper">

<?php if ( is_active_sidebar( 'gridshow-top-footer' ) ) : ?>
<div class='gridshow-clearfix'>
<div class='gridshow-top-footer-block'>
<?php dynamic_sidebar( 'gridshow-top-footer' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'gridshow-footer-1' ) || is_active_sidebar( 'gridshow-footer-2' ) || is_active_sidebar( 'gridshow-footer-3' ) || is_active_sidebar( 'gridshow-footer-4' ) ) : ?>
<div class='gridshow-footer-block-cols gridshow-clearfix'>

<div class="gridshow-footer-block-col gridshow-footer-4-col" id="gridshow-footer-block-1">
<?php dynamic_sidebar( 'gridshow-footer-1' ); ?>
</div>

<div class="gridshow-footer-block-col gridshow-footer-4-col" id="gridshow-footer-block-2">
<?php dynamic_sidebar( 'gridshow-footer-2' ); ?>
</div>

<div class="gridshow-footer-block-col gridshow-footer-4-col" id="gridshow-footer-block-3">
<?php dynamic_sidebar( 'gridshow-footer-3' ); ?>
</div>

<div class="gridshow-footer-block-col gridshow-footer-4-col" id="gridshow-footer-block-4">
<?php dynamic_sidebar( 'gridshow-footer-4' ); ?>
</div>

</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'gridshow-bottom-footer' ) ) : ?>
<div class='gridshow-clearfix'>
<div class='gridshow-bottom-footer-block'>
<?php dynamic_sidebar( 'gridshow-bottom-footer' ); ?>
</div>
</div>
<?php endif; ?>

</div>
</div>
</div><!--/#gridshow-footer-blocks-->
<?php endif; ?>
<?php } ?>

<?php if ( 'after-footer' === gridshow_secondary_menu_location() ) { ?><?php gridshow_secondary_menu_area(); ?><?php } ?>

<?php gridshow_after_footer(); ?>

<div class='gridshow-clearfix' id='gridshow-copyright-area'>
<div class='gridshow-copyright-area-inside gridshow-container'>
<div class="gridshow-outer-wrapper">

<div class='gridshow-copyright-area-inside-content gridshow-clearfix'>

<?php if ( gridshow_get_option('footer_text') ) : ?>
  <p class='gridshow-copyright'><?php echo esc_html(gridshow_get_option('footer_text')); ?></p>
<?php else : ?>
  <p class='gridshow-copyright'><?php /* translators: %s: Year and site name. */ printf( esc_html__( 'Copyright &copy; %s', 'gridshow' ), esc_html(date_i18n(__('Y','gridshow'))) . ' ' . esc_html(get_bloginfo( 'name' ))  ); ?></p>
<?php endif; ?>
<p class='gridshow-credit'><a href="<?php echo esc_url( 'https://themesdna.com/' ); ?>"><?php /* translators: %s: Theme author. */ printf( esc_html__( 'Design by %s', 'gridshow' ), 'ThemesDNA.com' ); ?></a></p>

</div>

</div>
</div>
</div><!--/#gridshow-copyright-area -->

<?php if ( gridshow_is_backtotop_active() ) { ?><button class="gridshow-scroll-top" title="<?php esc_attr_e('Scroll to Top','gridshow'); ?>"><i class="fas fa-arrow-up" aria-hidden="true"></i><span class="gridshow-sr-only"><?php esc_html_e('Scroll to Top', 'gridshow'); ?></span></button><?php } ?>

<?php wp_footer(); ?>
</body>
</html>