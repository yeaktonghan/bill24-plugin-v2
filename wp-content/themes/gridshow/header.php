<?php
/**
* The header for GridShow theme.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="gridshow-site-body" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#gridshow-posts-wrapper"><?php esc_html_e( 'Skip to content', 'gridshow' ); ?></a>

<?php gridshow_header_image(); ?>

<?php if ( 'before-header' === gridshow_secondary_menu_location() ) { ?><?php gridshow_secondary_menu_area(); ?><?php } ?>

<?php gridshow_before_header(); ?>

<div class="gridshow-site-header gridshow-container" id="gridshow-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
<div class="gridshow-head-content gridshow-clearfix" id="gridshow-head-content">

<?php if ( gridshow_is_header_content_active() ) { ?>
<div class="gridshow-header-inside gridshow-clearfix">
<div class="gridshow-header-inside-content gridshow-clearfix">
<div class="gridshow-outer-wrapper">
<div class="gridshow-header-inside-container">

<div class="gridshow-logo">
<?php if ( has_custom_logo() ) : ?>
    <div class="site-branding site-branding-full">
    <div class="gridshow-custom-logo-image">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="gridshow-logo-img-link">
        <img src="<?php echo esc_url( gridshow_custom_logo() ); ?>" alt="" class="gridshow-logo-img"/>
    </a>
    </div>
    <div class="gridshow-custom-logo-info"><?php gridshow_site_title(); ?></div>
    </div>
<?php else: ?>
    <div class="site-branding">
      <?php gridshow_site_title(); ?>
    </div>
<?php endif; ?>
</div>

<?php if ( gridshow_is_headnavi_menu_active() ) { ?>
<div class="gridshow-header-menu">
<div class="gridshow-container gridshow-headnavi-menu-container gridshow-clearfix">
<div class="gridshow-headnavi-menu-container-inside gridshow-clearfix">
<nav class="gridshow-nav-headnavi" id="gridshow-headnavi-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e( 'Header Menu', 'gridshow' ); ?>">
<button class="gridshow-headnavi-responsive-menu-icon" aria-controls="gridshow-menu-headnavi-navigation" aria-expanded="false"><?php echo esc_html( gridshow_headnavi_menu_text() ); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'gridshow-menu-headnavi-navigation', 'menu_class' => 'gridshow-headnavi-nav-menu gridshow-menu-headnavi gridshow-clearfix', 'fallback_cb' => 'gridshow_headnavi_fallback_menu', 'container' => '', ) ); ?>
</nav>
</div>
</div>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
<?php } else { ?>
<div class="gridshow-no-header-content">
  <?php gridshow_site_title(); ?>
</div>
<?php } ?>

</div><!--/#gridshow-head-content -->
</div><!--/#gridshow-header -->

<?php if ( 'after-header' === gridshow_secondary_menu_location() ) { ?><?php gridshow_secondary_menu_area(); ?><?php } ?>

<?php gridshow_after_header(); ?>

<?php gridshow_primary_menu_area(); ?>

<?php gridshow_top_wide_widgets(); ?>

<div class="gridshow-outer-wrapper" id="gridshow-wrapper-outside">

<div class="gridshow-container gridshow-clearfix" id="gridshow-wrapper">
<div class="gridshow-content-wrapper gridshow-clearfix" id="gridshow-content-wrapper">