<?php
/**
* Theme Functions
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

/**
 * This function return a value of given theme option name from database.
 *
 * @since 1.0.0
 *
 * @param string $option Theme option to return.
 * @return mixed The value of theme option.
 */
function gridshow_get_option($option) {
    $gridshow_options = get_option('gridshow_options');
    if ((is_array($gridshow_options)) && (array_key_exists($option, $gridshow_options))) {
        return $gridshow_options[$option];
    }
    else {
        return '';
    }
}

function gridshow_is_option_set($option) {
    $gridshow_options = get_option('gridshow_options');
    if ((is_array($gridshow_options)) && (array_key_exists($option, $gridshow_options))) {
        return true;
    } else {
        return false;
    }
}

if ( ! function_exists( 'gridshow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gridshow_setup() {
    
    global $wp_version;

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on GridShow, use a find and replace
     * to change 'gridshow' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'gridshow', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'gridshow-1222w-autoh-image', 1222, 9999, false );
        add_image_size( 'gridshow-897w-autoh-image', 897, 9999, false );
        add_image_size( 'gridshow-360w-autoh-image', 360, 9999, false );
        add_image_size( 'gridshow-360w-270h-image', 360, 270, true );
    }

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
    'header' => esc_html__('Header Menu', 'gridshow'),
    'primary' => esc_html__('Primary Menu', 'gridshow'),
    'secondary' => esc_html__('Secondary Menu', 'gridshow')
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    $markup = array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' );
    add_theme_support( 'html5', $markup );

    add_theme_support( 'custom-logo', array(
        'height'      => 37,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Support for Custom Header
    add_theme_support( 'custom-header', apply_filters( 'gridshow_custom_header_args', array(
    'default-image'          => '',
    'default-text-color'     => 'ffffff',
    'width'                  => 1920,
    'height'                 => 400,
    'flex-width'            => true,
    'flex-height'            => true,
    'wp-head-callback'       => 'gridshow_header_style',
    'uploads'                => true,
    ) ) );

    // Set up the WordPress core custom background feature.
    $background_args = array(
            'default-color'          => 'efefef',
            'default-image'          => get_template_directory_uri() .'/assets/images/background.png',
            'default-repeat'         => 'repeat',
            'default-position-x'     => 'left',
            'default-position-y'     => 'top',
            'default-size'     => 'auto',
            'default-attachment'     => 'fixed',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => 'admin_head_callback_func',
            'admin-preview-callback' => 'admin_preview_callback_func',
    );
    add_theme_support( 'custom-background', apply_filters( 'gridshow_custom_background_args', $background_args) );

    // Support for Custom Editor Style
    add_editor_style( 'assets/css/editor-style.css' );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    if ( !(gridshow_get_option('enable_widgets_block_editor')) ) {
        remove_theme_support( 'widgets-block-editor' );
    }

}
endif;
add_action( 'after_setup_theme', 'gridshow_setup' );

/**
* Layout Functions
*/

function gridshow_hide_footer_widgets() {
    $hide_footer_widgets = FALSE;

    if ( gridshow_get_option('hide_footer_widgets') ) {
        $hide_footer_widgets = TRUE;
    }

    return apply_filters( 'gridshow_hide_footer_widgets', $hide_footer_widgets );
}

function gridshow_is_header_content_active() {
    $header_content_active = TRUE;

    if ( gridshow_get_option('hide_header_content') ) {
        $header_content_active = FALSE;
    }

    return apply_filters( 'gridshow_is_header_content_active', $header_content_active );
}

function gridshow_is_headnavi_menu_active() {
    $headnavi_menu_active = TRUE;

    if ( gridshow_get_option('disable_headnavi_menu') ) {
        $headnavi_menu_active = FALSE;
    }

    return apply_filters( 'gridshow_is_headnavi_menu_active', $headnavi_menu_active );
}

function gridshow_is_primary_menu_active() {
    $primary_menu_active = TRUE;

    if ( gridshow_get_option('disable_primary_menu') ) {
        $primary_menu_active = FALSE;
    }

    return apply_filters( 'gridshow_is_primary_menu_active', $primary_menu_active );
}

function gridshow_is_secondary_menu_active() {
    $secondary_menu_active = TRUE;

    if ( gridshow_get_option('disable_secondary_menu') ) {
        $secondary_menu_active = FALSE;
    }

    return apply_filters( 'gridshow_is_secondary_menu_active', $secondary_menu_active );
}

function gridshow_social_buttons_location() {
    $social_buttons_location = 'primary-menu';

    if ( gridshow_get_option('social_buttons_location') ) {
        $social_buttons_location = gridshow_get_option('social_buttons_location');
    }

   return apply_filters( 'gridshow_social_buttons_location', $social_buttons_location );
}

function gridshow_is_social_buttons_active() {
    $social_buttons_active = TRUE;

    if ( gridshow_get_option('hide_social_buttons') ) {
        $social_buttons_active = FALSE;
    }

    return apply_filters( 'gridshow_is_social_buttons_active', $social_buttons_active );
}

function gridshow_is_fitvids_active() {
    $fitvids_active = TRUE;

    if ( gridshow_get_option('disable_fitvids') ) {
        $fitvids_active = FALSE;
    }

    return apply_filters( 'gridshow_is_fitvids_active', $fitvids_active );
}

function gridshow_is_backtotop_active() {
    $backtotop_active = TRUE;

    if ( gridshow_get_option('disable_backtotop') ) {
        $backtotop_active = FALSE;
    }

    return apply_filters( 'gridshow_is_backtotop_active', $backtotop_active );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gridshow_content_width() {
    $content_width = 897;

    if ( is_singular() ) {
        if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
           $content_width = 1222;
        } else {
            $content_width = 897;
        }
    } else {
        $content_width = 1222;
    }

    $GLOBALS['content_width'] = apply_filters( 'gridshow_content_width', $content_width ); /* phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound */
}
add_action( 'template_redirect', 'gridshow_content_width', 0 );

function gridshow_post_summaries_style() {
   $summaries_style = 'grid';
    if ( gridshow_get_option('post_summaries_style') ) {
        $summaries_style = gridshow_get_option('post_summaries_style');
    }
   return apply_filters( 'gridshow_post_summaries_style', $summaries_style );
}

function gridshow_grid_thumb_style() {
   $thumb_style = 'gridshow-360w-270h-image';
    if ( gridshow_get_option('grid_thumb_style') ) {
        $thumb_style = gridshow_get_option('grid_thumb_style');
    }
   return apply_filters( 'gridshow_grid_thumb_style', $thumb_style );
}

function gridshow_grid_no_thumb_url() {
    if ( 'gridshow-360w-270h-image' === gridshow_grid_thumb_style() ) {
        $no_thumb_url = get_template_directory_uri() . '/assets/images/no-image-360-270.jpg';
    } elseif ( 'gridshow-360w-autoh-image' === gridshow_grid_thumb_style() ) {
        $no_thumb_url = get_template_directory_uri() . '/assets/images/no-image-360-270.jpg';
    } else {
        $no_thumb_url = get_template_directory_uri() . '/assets/images/no-image-360-270.jpg';
    }
    return apply_filters( 'gridshow_grid_no_thumb_url', $no_thumb_url );
}

/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/

function gridshow_widgets_init() {

register_sidebar(array(
    'id' => 'gridshow-sidebar-one',
    'name' => esc_html__( 'Sidebar 1 Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located on the left-hand side of your web page.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-side-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-home-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Default HomePage)', 'gridshow' ),
    'description' => esc_html__( 'This full-width widget area is located after the header of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Everywhere)', 'gridshow' ),
    'description' => esc_html__( 'This full-width widget area is located after the header of your website. Widgets of this widget area are displayed on every page of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-home-top-widgets',
    'name' => esc_html__( 'Above Content Widgets (Default HomePage)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the top of the main content (above posts) of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-top-widgets',
    'name' => esc_html__( 'Above Content Widgets (Everywhere)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the top of the main content (above posts) of your website. Widgets of this widget area are displayed on every page of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-home-left-top-widgets',
    'name' => esc_html__( 'Top Left Widgets (Default HomePage)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the left top of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-left-top-widgets',
    'name' => esc_html__( 'Top Left Widgets (Everywhere)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the left top of your website. Widgets of this widget area are displayed on every page of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-home-right-top-widgets',
    'name' => esc_html__( 'Top Right Widgets (Default HomePage)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the right top of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-right-top-widgets',
    'name' => esc_html__( 'Top Right Widgets (Everywhere)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the right top of your website. Widgets of this widget area are displayed on every page of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-home-bottom-widgets',
    'name' => esc_html__( 'Below Content Widgets (Default HomePage)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the bottom of the main content (below posts) of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-bottom-widgets',
    'name' => esc_html__( 'Below Content Widgets (Everywhere)', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the bottom of the main content (below posts) of your website. Widgets of this widget area are displayed on every page of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-home-fullwidth-bottom-widgets',
    'name' => esc_html__( 'Bottom Full Width Widgets (Default HomePage)', 'gridshow' ),
    'description' => esc_html__( 'This full-width widget area is located before the footer of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-fullwidth-bottom-widgets',
    'name' => esc_html__( 'Bottom Full Width Widgets (Everywhere)', 'gridshow' ),
    'description' => esc_html__( 'This full-width widget area is located before the footer of your website. Widgets of this widget area are displayed on every page of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-single-post-bottom-widgets',
    'name' => esc_html__( 'Single Post Bottom Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located at the bottom of single post of any post type (except attachments and pages).', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

register_sidebar(array(
    'id' => 'gridshow-top-footer',
    'name' => esc_html__( 'Footer Top Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located on the top of the footer of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridshow-footer-1',
    'name' => esc_html__( 'Footer 1 Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is the column 1 of the footer of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridshow-footer-2',
    'name' => esc_html__( 'Footer 2 Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is the column 2 of the footer of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridshow-footer-3',
    'name' => esc_html__( 'Footer 3 Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is the column 3 of the footer of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridshow-footer-4',
    'name' => esc_html__( 'Footer 4 Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is the column 4 of the footer of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridshow-bottom-footer',
    'name' => esc_html__( 'Footer Bottom Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located on the bottom of the footer of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'gridshow-404-widgets',
    'name' => esc_html__( '404 Page Widgets', 'gridshow' ),
    'description' => esc_html__( 'This widget area is located on the 404(not found) page of your website.', 'gridshow' ),
    'before_widget' => '<div id="%1$s" class="gridshow-main-widget widget gridshow-widget-box %2$s"><div class="gridshow-widget-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="gridshow-widget-header"><div class="gridshow-widget-header-inside"><h2 class="gridshow-widget-title"><span class="gridshow-widget-title-inside">',
    'after_title' => '</span></h2></div></div>'));

}
add_action( 'widgets_init', 'gridshow_widgets_init' );

function gridshow_sidebar_one_widgets() {
    dynamic_sidebar( 'gridshow-sidebar-one' );
}

function gridshow_top_wide_widgets() { ?>
<?php if ( is_active_sidebar( 'gridshow-home-fullwidth-widgets' ) || is_active_sidebar( 'gridshow-fullwidth-widgets' ) ) : ?>
<div class="gridshow-outer-wrapper">
<div class="gridshow-top-wrapper-outer gridshow-clearfix">
<div class="gridshow-featured-posts-area gridshow-top-wrapper gridshow-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridshow-home-fullwidth-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridshow-fullwidth-widgets' ); ?>
</div>
</div>
</div>
<?php endif; ?>
<?php }

function gridshow_top_widgets() { ?>
<?php if ( is_active_sidebar( 'gridshow-home-top-widgets' ) || is_active_sidebar( 'gridshow-top-widgets' ) ) : ?>
<div class="gridshow-featured-posts-area gridshow-featured-posts-area-top gridshow-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridshow-home-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridshow-top-widgets' ); ?>
</div>
<?php endif; ?>
<?php }

function gridshow_top_left_right_widgets() { ?>
<div class="gridshow-left-right-wrapper gridshow-clearfix">

<?php if ( is_active_sidebar( 'gridshow-home-left-top-widgets' ) || is_active_sidebar( 'gridshow-left-top-widgets' ) ) : ?>
<div class="gridshow-left-top-wrapper">
<div class="gridshow-featured-posts-area gridshow-featured-posts-area-top gridshow-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridshow-home-left-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridshow-left-top-widgets' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'gridshow-home-right-top-widgets' ) || is_active_sidebar( 'gridshow-right-top-widgets' ) ) : ?>
<div class="gridshow-right-top-wrapper">
<div class="gridshow-featured-posts-area gridshow-featured-posts-area-top gridshow-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridshow-home-right-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridshow-right-top-widgets' ); ?>
</div>
</div>
<?php endif; ?>

</div>
<?php }

function gridshow_bottom_widgets() { ?>
<?php if ( is_active_sidebar( 'gridshow-home-bottom-widgets' ) || is_active_sidebar( 'gridshow-bottom-widgets' ) ) : ?>
<div class='gridshow-featured-posts-area gridshow-featured-posts-area-bottom gridshow-clearfix'>
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridshow-home-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridshow-bottom-widgets' ); ?>
</div>
<?php endif; ?>
<?php }

function gridshow_bottom_wide_widgets() { ?>
<?php if ( is_active_sidebar( 'gridshow-home-fullwidth-bottom-widgets' ) || is_active_sidebar( 'gridshow-fullwidth-bottom-widgets' ) ) : ?>
<div class="gridshow-outer-wrapper">
<div class="gridshow-bottom-wrapper-outer gridshow-clearfix">
<div class="gridshow-featured-posts-area gridshow-bottom-wrapper gridshow-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'gridshow-home-fullwidth-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'gridshow-fullwidth-bottom-widgets' ); ?>
</div>
</div>
</div>
<?php endif; ?>
<?php }

function gridshow_404_widgets() { ?>
<?php if ( is_active_sidebar( 'gridshow-404-widgets' ) ) : ?>
<div class="gridshow-featured-posts-area gridshow-featured-posts-area-top gridshow-clearfix">
<?php dynamic_sidebar( 'gridshow-404-widgets' ); ?>
</div>
<?php endif; ?>
<?php }

function gridshow_post_bottom_widgets() {
    if ( is_singular() ) {
        global $post;
        if ( is_active_sidebar( 'gridshow-single-post-bottom-widgets' ) ) : ?>
            <div class="gridshow-featured-posts-area gridshow-clearfix">
            <?php dynamic_sidebar( 'gridshow-single-post-bottom-widgets' ); ?>
            </div>
        <?php endif;
    }
}

/**
* Social buttons
*/

function gridshow_social_buttons() { ?>

<div class='gridshow-social-icons'>
    <?php if ( gridshow_get_option('twitterlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('twitterlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-twitter" aria-label="<?php esc_attr_e('Twitter Button','gridshow'); ?>"><i class="fab fa-twitter" aria-hidden="true" title="<?php esc_attr_e('Twitter','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('facebooklink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('facebooklink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-facebook" aria-label="<?php esc_attr_e('Facebook Button','gridshow'); ?>"><i class="fab fa-facebook-f" aria-hidden="true" title="<?php esc_attr_e('Facebook','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('googlelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('googlelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-google-plus" aria-label="<?php esc_attr_e('Google Plus Button','gridshow'); ?>"><i class="fab fa-google-plus-g" aria-hidden="true" title="<?php esc_attr_e('Google Plus','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('pinterestlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('pinterestlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-pinterest" aria-label="<?php esc_attr_e('Pinterest Button','gridshow'); ?>"><i class="fab fa-pinterest" aria-hidden="true" title="<?php esc_attr_e('Pinterest','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('linkedinlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('linkedinlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-linkedin" aria-label="<?php esc_attr_e('Linkedin Button','gridshow'); ?>"><i class="fab fa-linkedin-in" aria-hidden="true" title="<?php esc_attr_e('Linkedin','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('instagramlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('instagramlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-instagram" aria-label="<?php esc_attr_e('Instagram Button','gridshow'); ?>"><i class="fab fa-instagram" aria-hidden="true" title="<?php esc_attr_e('Instagram','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('flickrlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('flickrlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-flickr" aria-label="<?php esc_attr_e('Flickr Button','gridshow'); ?>"><i class="fab fa-flickr" aria-hidden="true" title="<?php esc_attr_e('Flickr','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('youtubelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('youtubelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-youtube" aria-label="<?php esc_attr_e('Youtube Button','gridshow'); ?>"><i class="fab fa-youtube" aria-hidden="true" title="<?php esc_attr_e('Youtube','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('vimeolink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('vimeolink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-vimeo" aria-label="<?php esc_attr_e('Vimeo Button','gridshow'); ?>"><i class="fab fa-vimeo-v" aria-hidden="true" title="<?php esc_attr_e('Vimeo','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('soundcloudlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('soundcloudlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-soundcloud" aria-label="<?php esc_attr_e('SoundCloud Button','gridshow'); ?>"><i class="fab fa-soundcloud" aria-hidden="true" title="<?php esc_attr_e('SoundCloud','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('messengerlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('messengerlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-messenger" aria-label="<?php esc_attr_e('Messenger Button','gridshow'); ?>"><i class="fab fa-facebook-messenger" aria-hidden="true" title="<?php esc_attr_e('Messenger','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('whatsapplink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('whatsapplink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-whatsapp" aria-label="<?php esc_attr_e('WhatsApp Button','gridshow'); ?>"><i class="fab fa-whatsapp" aria-hidden="true" title="<?php esc_attr_e('WhatsApp','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('lastfmlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('lastfmlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-lastfm" aria-label="<?php esc_attr_e('Lastfm Button','gridshow'); ?>"><i class="fab fa-lastfm" aria-hidden="true" title="<?php esc_attr_e('Lastfm','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('mediumlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('mediumlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-medium" aria-label="<?php esc_attr_e('Medium Button','gridshow'); ?>"><i class="fab fa-medium-m" aria-hidden="true" title="<?php esc_attr_e('Medium','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('githublink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('githublink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-github" aria-label="<?php esc_attr_e('Github Button','gridshow'); ?>"><i class="fab fa-github" aria-hidden="true" title="<?php esc_attr_e('Github','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('bitbucketlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('bitbucketlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-bitbucket" aria-label="<?php esc_attr_e('Bitbucket Button','gridshow'); ?>"><i class="fab fa-bitbucket" aria-hidden="true" title="<?php esc_attr_e('Bitbucket','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('tumblrlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('tumblrlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-tumblr" aria-label="<?php esc_attr_e('Tumblr Button','gridshow'); ?>"><i class="fab fa-tumblr" aria-hidden="true" title="<?php esc_attr_e('Tumblr','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('digglink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('digglink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-digg" aria-label="<?php esc_attr_e('Digg Button','gridshow'); ?>"><i class="fab fa-digg" aria-hidden="true" title="<?php esc_attr_e('Digg','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('deliciouslink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('deliciouslink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-delicious" aria-label="<?php esc_attr_e('Delicious Button','gridshow'); ?>"><i class="fab fa-delicious" aria-hidden="true" title="<?php esc_attr_e('Delicious','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('stumblelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('stumblelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-stumbleupon" aria-label="<?php esc_attr_e('Stumbleupon Button','gridshow'); ?>"><i class="fab fa-stumbleupon" aria-hidden="true" title="<?php esc_attr_e('Stumbleupon','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('mixlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('mixlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-mix" aria-label="<?php esc_attr_e('Mix Button','gridshow'); ?>"><i class="fab fa-mix" aria-hidden="true" title="<?php esc_attr_e('Mix','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('redditlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('redditlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-reddit" aria-label="<?php esc_attr_e('Reddit Button','gridshow'); ?>"><i class="fab fa-reddit" aria-hidden="true" title="<?php esc_attr_e('Reddit','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('dribbblelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('dribbblelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-dribbble" aria-label="<?php esc_attr_e('Dribbble Button','gridshow'); ?>"><i class="fab fa-dribbble" aria-hidden="true" title="<?php esc_attr_e('Dribbble','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('flipboardlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('flipboardlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-flipboard" aria-label="<?php esc_attr_e('Flipboard Button','gridshow'); ?>"><i class="fab fa-flipboard" aria-hidden="true" title="<?php esc_attr_e('Flipboard','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('bloggerlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('bloggerlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-blogger" aria-label="<?php esc_attr_e('Blogger Button','gridshow'); ?>"><i class="fab fa-blogger" aria-hidden="true" title="<?php esc_attr_e('Blogger','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('etsylink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('etsylink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-etsy" aria-label="<?php esc_attr_e('Etsy Button','gridshow'); ?>"><i class="fab fa-etsy" aria-hidden="true" title="<?php esc_attr_e('Etsy','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('behancelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('behancelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-behance" aria-label="<?php esc_attr_e('Behance Button','gridshow'); ?>"><i class="fab fa-behance" aria-hidden="true" title="<?php esc_attr_e('Behance','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('amazonlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('amazonlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-amazon" aria-label="<?php esc_attr_e('Amazon Button','gridshow'); ?>"><i class="fab fa-amazon" aria-hidden="true" title="<?php esc_attr_e('Amazon','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('meetuplink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('meetuplink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-meetup" aria-label="<?php esc_attr_e('Meetup Button','gridshow'); ?>"><i class="fab fa-meetup" aria-hidden="true" title="<?php esc_attr_e('Meetup','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('mixcloudlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('mixcloudlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-mixcloud" aria-label="<?php esc_attr_e('Mixcloud Button','gridshow'); ?>"><i class="fab fa-mixcloud" aria-hidden="true" title="<?php esc_attr_e('Mixcloud','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('slacklink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('slacklink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-slack" aria-label="<?php esc_attr_e('Slack Button','gridshow'); ?>"><i class="fab fa-slack" aria-hidden="true" title="<?php esc_attr_e('Slack','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('snapchatlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('snapchatlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-snapchat" aria-label="<?php esc_attr_e('Snapchat Button','gridshow'); ?>"><i class="fab fa-snapchat" aria-hidden="true" title="<?php esc_attr_e('Snapchat','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('spotifylink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('spotifylink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-spotify" aria-label="<?php esc_attr_e('Spotify Button','gridshow'); ?>"><i class="fab fa-spotify" aria-hidden="true" title="<?php esc_attr_e('Spotify','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('yelplink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('yelplink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-yelp" aria-label="<?php esc_attr_e('Yelp Button','gridshow'); ?>"><i class="fab fa-yelp" aria-hidden="true" title="<?php esc_attr_e('Yelp','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('wordpresslink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('wordpresslink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-wordpress" aria-label="<?php esc_attr_e('WordPress Button','gridshow'); ?>"><i class="fab fa-wordpress" aria-hidden="true" title="<?php esc_attr_e('WordPress','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('twitchlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('twitchlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-twitch" aria-label="<?php esc_attr_e('Twitch Button','gridshow'); ?>"><i class="fab fa-twitch" aria-hidden="true" title="<?php esc_attr_e('Twitch','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('telegramlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('telegramlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-telegram" aria-label="<?php esc_attr_e('Telegram Button','gridshow'); ?>"><i class="fab fa-telegram" aria-hidden="true" title="<?php esc_attr_e('Telegram','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('bandcamplink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('bandcamplink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-bandcamp" aria-label="<?php esc_attr_e('Bandcamp Button','gridshow'); ?>"><i class="fab fa-bandcamp" aria-hidden="true" title="<?php esc_attr_e('Bandcamp','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('quoralink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('quoralink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-quora" aria-label="<?php esc_attr_e('Quora Button','gridshow'); ?>"><i class="fab fa-quora" aria-hidden="true" title="<?php esc_attr_e('Quora','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('foursquarelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('foursquarelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-foursquare" aria-label="<?php esc_attr_e('Foursquare Button','gridshow'); ?>"><i class="fab fa-foursquare" aria-hidden="true" title="<?php esc_attr_e('Foursquare','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('deviantartlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('deviantartlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-deviantart" aria-label="<?php esc_attr_e('DeviantArt Button','gridshow'); ?>"><i class="fab fa-deviantart" aria-hidden="true" title="<?php esc_attr_e('DeviantArt','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('imdblink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('imdblink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-imdb" aria-label="<?php esc_attr_e('IMDB Button','gridshow'); ?>"><i class="fab fa-imdb" aria-hidden="true" title="<?php esc_attr_e('IMDB','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('vklink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('vklink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-vk" aria-label="<?php esc_attr_e('VK Button','gridshow'); ?>"><i class="fab fa-vk" aria-hidden="true" title="<?php esc_attr_e('VK','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('codepenlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('codepenlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-codepen" aria-label="<?php esc_attr_e('Codepen Button','gridshow'); ?>"><i class="fab fa-codepen" aria-hidden="true" title="<?php esc_attr_e('Codepen','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('jsfiddlelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('jsfiddlelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-jsfiddle" aria-label="<?php esc_attr_e('JSFiddle Button','gridshow'); ?>"><i class="fab fa-jsfiddle" aria-hidden="true" title="<?php esc_attr_e('JSFiddle','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('stackoverflowlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('stackoverflowlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-stackoverflow" aria-label="<?php esc_attr_e('Stack Overflow Button','gridshow'); ?>"><i class="fab fa-stack-overflow" aria-hidden="true" title="<?php esc_attr_e('Stack Overflow','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('stackexchangelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('stackexchangelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-stackexchange" aria-label="<?php esc_attr_e('Stack Exchange Button','gridshow'); ?>"><i class="fab fa-stack-exchange" aria-hidden="true" title="<?php esc_attr_e('Stack Exchange','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('bsalink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('bsalink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-buysellads" aria-label="<?php esc_attr_e('BuySellAds Button','gridshow'); ?>"><i class="fab fa-buysellads" aria-hidden="true" title="<?php esc_attr_e('BuySellAds','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('web500pxlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('web500pxlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-web500px" aria-label="<?php esc_attr_e('500px Button','gridshow'); ?>"><i class="fab fa-500px" aria-hidden="true" title="<?php esc_attr_e('500px','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('ellolink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('ellolink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-ello" aria-label="<?php esc_attr_e('Ello Button','gridshow'); ?>"><i class="fab fa-ello" aria-hidden="true" title="<?php esc_attr_e('Ello','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('discordlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('discordlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-discord" aria-label="<?php esc_attr_e('Discord Button','gridshow'); ?>"><i class="fab fa-discord" aria-hidden="true" title="<?php esc_attr_e('Discord','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('goodreadslink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('goodreadslink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-goodreads" aria-label="<?php esc_attr_e('Goodreads Button','gridshow'); ?>"><i class="fab fa-goodreads" aria-hidden="true" title="<?php esc_attr_e('Goodreads','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('odnoklassnikilink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('odnoklassnikilink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-odnoklassniki" aria-label="<?php esc_attr_e('Odnoklassniki Button','gridshow'); ?>"><i class="fab fa-odnoklassniki" aria-hidden="true" title="<?php esc_attr_e('Odnoklassniki','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('houzzlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('houzzlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-houzz" aria-label="<?php esc_attr_e('Houzz Button','gridshow'); ?>"><i class="fab fa-houzz" aria-hidden="true" title="<?php esc_attr_e('Houzz','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('pocketlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('pocketlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-pocket" aria-label="<?php esc_attr_e('Pocket Button','gridshow'); ?>"><i class="fab fa-get-pocket" aria-hidden="true" title="<?php esc_attr_e('Pocket','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('xinglink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('xinglink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-xing" aria-label="<?php esc_attr_e('XING Button','gridshow'); ?>"><i class="fab fa-xing" aria-hidden="true" title="<?php esc_attr_e('XING','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('googleplaylink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('googleplaylink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-googleplay" aria-label="<?php esc_attr_e('Google Play Button','gridshow'); ?>"><i class="fab fa-google-play" aria-hidden="true" title="<?php esc_attr_e('Google Play','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('slidesharelink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('slidesharelink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-slideshare" aria-label="<?php esc_attr_e('SlideShare Button','gridshow'); ?>"><i class="fab fa-slideshare" aria-hidden="true" title="<?php esc_attr_e('SlideShare','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('dropboxlink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('dropboxlink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-dropbox" aria-label="<?php esc_attr_e('Dropbox Button','gridshow'); ?>"><i class="fab fa-dropbox" aria-hidden="true" title="<?php esc_attr_e('Dropbox','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('paypallink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('paypallink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-paypal" aria-label="<?php esc_attr_e('PayPal Button','gridshow'); ?>"><i class="fab fa-paypal" aria-hidden="true" title="<?php esc_attr_e('PayPal','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('viadeolink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('viadeolink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-viadeo" aria-label="<?php esc_attr_e('Viadeo Button','gridshow'); ?>"><i class="fab fa-viadeo" aria-hidden="true" title="<?php esc_attr_e('Viadeo','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('wikipedialink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('wikipedialink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-wikipedia" aria-label="<?php esc_attr_e('Wikipedia Button','gridshow'); ?>"><i class="fab fa-wikipedia-w" aria-hidden="true" title="<?php esc_attr_e('Wikipedia','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('skypeusername') ) : ?>
            <a href="skype:<?php echo esc_html( gridshow_get_option('skypeusername') ); ?>?chat" class="gridshow-header-social-icon-skype" aria-label="<?php esc_attr_e('Skype Button','gridshow'); ?>"><i class="fab fa-skype" aria-hidden="true" title="<?php esc_attr_e('Skype','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('emailaddress') ) : ?>
            <a href="mailto:<?php echo esc_html( gridshow_get_option('emailaddress') ); ?>" class="gridshow-header-social-icon-email" aria-label="<?php esc_attr_e('Email Us Button','gridshow'); ?>"><i class="far fa-envelope" aria-hidden="true" title="<?php esc_attr_e('Email Us','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('rsslink') ) : ?>
            <a href="<?php echo esc_url( gridshow_get_option('rsslink') ); ?>" target="_blank" rel="nofollow" class="gridshow-header-social-icon-rss" aria-label="<?php esc_attr_e('RSS Button','gridshow'); ?>"><i class="fas fa-rss" aria-hidden="true" title="<?php esc_attr_e('RSS','gridshow'); ?>"></i></a><?php endif; ?>
    <?php if ( gridshow_get_option('show_rp_button') ) { ?><a href="<?php echo esc_url( home_url( '/?gridshowrandpost=1' ) ); ?>" aria-label="<?php esc_attr_e('Random Post Button','gridshow'); ?>" class="gridshow-header-social-icon-random"><i class="fas fa-random" aria-hidden="true" title="<?php esc_attr_e('Random Post','gridshow'); ?>"></i></a><?php } ?>
    <?php if ( gridshow_get_option('show_login_button') ) { ?><?php if (is_user_logged_in()) : ?><a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" aria-label="<?php esc_attr_e( 'Logout Button', 'gridshow' ); ?>" class="gridshow-header-social-icon-login"><i class="fas fa-sign-out-alt" aria-hidden="true" title="<?php esc_attr_e('Logout','gridshow'); ?>"></i></a><?php else : ?><a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" aria-label="<?php esc_attr_e( 'Login / Register Button', 'gridshow' ); ?>" class="gridshow-header-social-icon-login"><i class="fas fa-sign-in-alt" aria-hidden="true" title="<?php esc_attr_e('Login / Register','gridshow'); ?>"></i></a><?php endif;?><?php } ?>
    <?php if ( !(gridshow_get_option('hide_search_button')) ) { ?><a href="<?php echo esc_url( '#' ); ?>" class="gridshow-header-social-icon-search" aria-label="<?php esc_attr_e('Search Button','gridshow'); ?>"><i class="fas fa-search" aria-hidden="true" title="<?php esc_attr_e('Search','gridshow'); ?>"></i></a><?php } ?>
</div>

<?php }

/**
* Author bio box
*/

function gridshow_add_author_bio_box() {
    $content='';
    if (is_single()) {
        $content .= '
            <div class="gridshow-author-bio">
            <div class="gridshow-author-bio-inside">
            <div class="gridshow-author-bio-top">
            <span class="gridshow-author-bio-gravatar">
                '. get_avatar( get_the_author_meta('email') , 80 ) .'
            </span>
            <div class="gridshow-author-bio-text">
                <div class="gridshow-author-bio-name">'.esc_html__( 'Author: ', 'gridshow' ).'<span>'. get_the_author_link() .'</span></div><div class="gridshow-author-bio-text-description">'. wp_kses_post( get_the_author_meta('description',get_query_var('author') ) ) .'</div>
            </div>
            </div>
            </div>
            </div>
        ';
    }
    return apply_filters( 'gridshow_add_author_bio_box', $content );
}

/**
* Post meta functions
*/

function gridshow_post_cat_links_text() {
    if ( gridshow_is_option_set('cat_links_text') ) {
        $cat_links_text = gridshow_get_option('cat_links_text');
    } else {
        $cat_links_text = esc_html__( 'Posted in', 'gridshow' );
    }
    return apply_filters( 'gridshow_post_cat_links_text', $cat_links_text );
}

function gridshow_post_tag_links_text() {
    if ( gridshow_is_option_set('tag_links_text') ) {
        $tag_links_text = gridshow_get_option('tag_links_text');
    } else {
        $tag_links_text = esc_html__( 'Tagged', 'gridshow' );
    }
    return apply_filters( 'gridshow_post_tag_links_text', $tag_links_text );
}

if ( ! function_exists( 'gridshow_post_tags' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function gridshow_post_tags() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'gridshow' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<span class="gridshow-tags-links"><i class="fas fa-tags" aria-hidden="true"></i> ' . esc_html__( 'Tagged %1$s', 'gridshow' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'gridshow_grid_cats' ) ) :
function gridshow_grid_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( '&nbsp;', 'gridshow' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="gridshow-grid-post-categories">' . __( '<span class="gridshow-sr-only">Posted in </span>%1$s', 'gridshow' ) . '</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'gridshow_nongrid_postmeta' ) ) :
function gridshow_nongrid_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(gridshow_get_option('hide_post_author_home')) || !(gridshow_get_option('hide_posted_date_home')) || !(gridshow_get_option('hide_comments_link_home')) || !(gridshow_get_option('hide_post_categories_home')) ) { ?>
    <div class="gridshow-entry-meta-single">
    <?php if ( !(gridshow_get_option('hide_post_author_home')) ) { ?><span class="gridshow-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(gridshow_get_option('hide_posted_date_home')) ) { ?><span class="gridshow-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( !(gridshow_get_option('hide_comments_link_home')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="gridshow-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="gridshow-sr-only"> on %s</span>', 'gridshow' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(gridshow_get_option('hide_post_categories_home')) ) { ?><?php gridshow_single_cats(); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'gridshow_single_cats' ) ) :
function gridshow_single_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( ', ', 'gridshow' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<span class="gridshow-entry-meta-single-cats"><i class="far fa-folder-open" aria-hidden="true"></i>&nbsp;' . __( '<span class="gridshow-sr-only">Posted in </span>%1$s', 'gridshow' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'gridshow_single_postmeta' ) ) :
function gridshow_single_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(gridshow_get_option('hide_post_author')) || !(gridshow_get_option('hide_posted_date')) || !(gridshow_get_option('hide_comments_link')) || !(gridshow_get_option('hide_post_categories')) || !(gridshow_get_option('hide_post_edit')) ) { ?>
    <div class="gridshow-entry-meta-single">
    <?php if ( !(gridshow_get_option('hide_post_author')) ) { ?><span class="gridshow-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(gridshow_get_option('hide_posted_date')) ) { ?><span class="gridshow-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( !(gridshow_get_option('hide_comments_link')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="gridshow-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="gridshow-sr-only"> on %s</span>', 'gridshow' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(gridshow_get_option('hide_post_categories')) ) { ?><?php gridshow_single_cats(); ?><?php } ?>
    <?php if ( !(gridshow_get_option('hide_post_edit')) ) { ?><?php edit_post_link( sprintf( wp_kses( /* translators: %s: Name of current post. Only visible to screen readers */ __( 'Edit<span class="gridshow-sr-only"> %s</span>', 'gridshow' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ), '<span class="edit-link">&nbsp;&nbsp;<i class="far fa-edit" aria-hidden="true"></i> ', '</span>' ); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'gridshow_page_postmeta' ) ) :
function gridshow_page_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(gridshow_get_option('hide_page_author')) || !(gridshow_get_option('hide_page_date')) || !(gridshow_get_option('hide_page_comments')) ) { ?>
    <div class="gridshow-entry-meta-single">
    <?php if ( !(gridshow_get_option('hide_page_author')) ) { ?><span class="gridshow-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(gridshow_get_option('hide_page_date')) ) { ?><span class="gridshow-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( !(gridshow_get_option('hide_page_comments')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="gridshow-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="gridshow-sr-only"> on %s</span>', 'gridshow' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

/**
* Posts navigation functions
*/

if ( ! function_exists( 'gridshow_wp_pagenavi' ) ) :
function gridshow_wp_pagenavi() {
    ?>
    <nav class="navigation posts-navigation gridshow-clearfix" role="navigation">
        <?php wp_pagenavi(); ?>
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'gridshow_posts_navigation' ) ) :
function gridshow_posts_navigation() {
    if ( !(gridshow_get_option('hide_posts_navigation')) ) {
        if ( function_exists( 'wp_pagenavi' ) ) {
            gridshow_wp_pagenavi();
        } else {
            if ( gridshow_get_option('posts_navigation_type') === 'normalnavi' ) {
                the_posts_navigation(array('prev_text' => esc_html__( 'Older posts', 'gridshow' ), 'next_text' => esc_html__( 'Newer posts', 'gridshow' )));
            } else {
                the_posts_pagination(array('mid_size' => 2, 'prev_text' => esc_html__( '&larr; Newer posts', 'gridshow' ), 'next_text' => esc_html__( 'Older posts &rarr;', 'gridshow' )));
            }
        }
    }
}
endif;

if ( ! function_exists( 'gridshow_post_navigation' ) ) :
function gridshow_post_navigation() {
    global $post;
    if ( !(gridshow_get_option('hide_post_navigation')) ) {
            the_post_navigation(array('prev_text' => esc_html__( '%title &rarr;', 'gridshow' ), 'next_text' => esc_html__( '&larr; %title', 'gridshow' )));
    }
}
endif;

/**
* Menu Functions
*/

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a "Home" link as the first item
function gridshow_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'gridshow_page_menu_args' );

function gridshow_headnavi_menu_text() {
   $menu_text = esc_html__( 'Menu', 'gridshow' );
    if ( gridshow_get_option('headnavi_menu_text') ) {
        $menu_text = gridshow_get_option('headnavi_menu_text');
    }
   return apply_filters( 'gridshow_headnavi_menu_text', $menu_text );
}

function gridshow_primary_menu_text() {
   $menu_text = esc_html__( 'Menu', 'gridshow' );
    if ( gridshow_get_option('primary_menu_text') ) {
        $menu_text = gridshow_get_option('primary_menu_text');
    }
   return apply_filters( 'gridshow_primary_menu_text', $menu_text );
}

function gridshow_secondary_menu_text() {
   $menu_text = esc_html__( 'Menu', 'gridshow' );
    if ( gridshow_get_option('secondary_menu_text') ) {
        $menu_text = gridshow_get_option('secondary_menu_text');
    }
   return apply_filters( 'gridshow_secondary_menu_text', $menu_text );
}

function gridshow_secondary_menu_location() {
    $secondary_menu_location = 'before-footer';
    if ( gridshow_get_option('secondary_menu_location') ) {
        $secondary_menu_location = gridshow_get_option('secondary_menu_location');
    }
    return apply_filters( 'gridshow_secondary_menu_location', $secondary_menu_location );
}

function gridshow_headnavi_fallback_menu() {
   wp_page_menu( array(
        'sort_column'  => 'menu_order, post_title',
        'menu_id'      => 'gridshow-menu-headnavi-navigation',
        'menu_class'   => 'gridshow-headnavi-nav-menu gridshow-menu-headnavi',
        'container'    => 'ul',
        'echo'         => true,
        'link_before'  => '',
        'link_after'   => '',
        'before'       => '',
        'after'        => '',
        'item_spacing' => 'discard',
        'walker'       => '',
    ) );
}

function gridshow_primary_fallback_menu() {
   wp_page_menu( array(
        'sort_column'  => 'menu_order, post_title',
        'menu_id'      => 'gridshow-menu-primary-navigation',
        'menu_class'   => 'gridshow-primary-nav-menu gridshow-menu-primary',
        'container'    => 'ul',
        'echo'         => true,
        'link_before'  => '',
        'link_after'   => '',
        'before'       => '',
        'after'        => '',
        'item_spacing' => 'discard',
        'walker'       => '',
    ) );
}

function gridshow_secondary_fallback_menu() {
   wp_page_menu( array(
        'sort_column'  => 'menu_order, post_title',
        'menu_id'      => 'gridshow-menu-secondary-navigation',
        'menu_class'   => 'gridshow-secondary-nav-menu gridshow-menu-secondary',
        'container'    => 'ul',
        'echo'         => true,
        'link_before'  => '',
        'link_after'   => '',
        'before'       => '',
        'after'        => '',
        'item_spacing' => 'discard',
        'walker'       => '',
    ) );
}

function gridshow_primary_menu_area() {
if ( gridshow_is_primary_menu_active() ) { ?>
<div class="gridshow-container gridshow-primary-menu-container gridshow-clearfix">
<div class="gridshow-primary-menu-container-inside gridshow-clearfix">
<nav class="gridshow-nav-primary" id="gridshow-primary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e( 'Primary Menu', 'gridshow' ); ?>">
<div class="gridshow-outer-wrapper">
<button class="gridshow-primary-responsive-menu-icon" aria-controls="gridshow-menu-primary-navigation" aria-expanded="false"><?php esc_html_e( 'Menu', 'gridshow' ); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'gridshow-menu-primary-navigation', 'menu_class' => 'gridshow-primary-nav-menu gridshow-menu-primary gridshow-clearfix', 'fallback_cb' => 'gridshow_primary_fallback_menu', 'container' => '', ) ); ?>

<?php if ( 'primary-menu' === gridshow_social_buttons_location() ) { ?>
    <?php if ( gridshow_is_social_buttons_active() ) { ?>
        <?php gridshow_social_buttons(); ?>
        <?php if ( !(gridshow_get_option('hide_search_button')) ) { ?>
        <div id="gridshow-search-overlay-wrap" class="gridshow-search-overlay">
          <div class="gridshow-search-overlay-content">
            <?php get_search_form(); ?>
          </div>
          <button class="gridshow-search-closebtn" aria-label="<?php esc_attr_e( 'Close Search', 'gridshow' ); ?>" title="<?php esc_attr_e('Close Search','gridshow'); ?>">&#xD7;</button>
        </div>
        <?php } ?>
    <?php } ?>
<?php } ?>

</div>
</nav>
</div>
</div>
<?php }
}

function gridshow_secondary_menu_area() {
if ( gridshow_is_secondary_menu_active() ) { ?>
<div class="gridshow-container gridshow-secondary-menu-container gridshow-clearfix">
<div class="gridshow-secondary-menu-container-inside gridshow-clearfix">
<nav class="gridshow-nav-secondary" id="gridshow-secondary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e( 'Secondary Menu', 'gridshow' ); ?>">
<div class="gridshow-outer-wrapper">

<button class="gridshow-secondary-responsive-menu-icon" aria-controls="gridshow-menu-secondary-navigation" aria-expanded="false"><?php echo esc_html( gridshow_secondary_menu_text() ); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'gridshow-menu-secondary-navigation', 'menu_class' => 'gridshow-secondary-nav-menu gridshow-menu-secondary gridshow-clearfix', 'fallback_cb' => 'gridshow_secondary_fallback_menu', 'container' => '', ) ); ?>

<?php if ( 'secondary-menu' === gridshow_social_buttons_location() ) { ?>
    <?php if ( gridshow_is_social_buttons_active() ) { ?>
        <?php gridshow_social_buttons(); ?>
        <?php if ( !(gridshow_get_option('hide_search_button')) ) { ?>
        <div id="gridshow-search-overlay-wrap" class="gridshow-search-overlay">
          <div class="gridshow-search-overlay-content">
            <?php get_search_form(); ?>
          </div>
          <button class="gridshow-search-closebtn" aria-label="<?php esc_attr_e( 'Close Search', 'gridshow' ); ?>" title="<?php esc_attr_e('Close Search','gridshow'); ?>">&#xD7;</button>
        </div>
        <?php } ?>
    <?php } ?>
<?php } ?>

</div>
</nav>
</div>
</div>
<?php }
}

/**
* Header Functions
*/

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gridshow_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'gridshow_pingback_header' );

// Get custom-logo URL
function gridshow_custom_logo() {
    if ( ! has_custom_logo() ) {return;}
    $gridshow_custom_logo_id = get_theme_mod( 'custom_logo' );
    $gridshow_logo = wp_get_attachment_image_src( $gridshow_custom_logo_id , 'full' );
    $gridshow_logo_src = $gridshow_logo[0];
    return apply_filters( 'gridshow_custom_logo', $gridshow_logo_src );
}

// Site Title
function gridshow_site_title() {
    if ( is_front_page() && is_home() ) { ?>
            <h1 class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_home() ) { ?>
            <h1 class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_singular() ) { ?>
            <p class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_category() ) { ?>
            <p class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_tag() ) { ?>
            <p class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_author() ) { ?>
            <p class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_archive() && !is_category() && !is_tag() && !is_author() ) { ?>
            <p class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_search() ) { ?>
            <p class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_404() ) { ?>
            <p class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } else { ?>
            <h1 class="gridshow-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(gridshow_get_option('hide_tagline')) ) { ?><p class="gridshow-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php }
}

function gridshow_header_image_destination() {
    $url = home_url( '/' );
    if ( gridshow_get_option('header_image_destination') ) {
        $url = gridshow_get_option('header_image_destination');
    }
    return apply_filters( 'gridshow_header_image_destination', $url );
}

function gridshow_header_image_markup() {
    if ( get_header_image() ) {
        if ( gridshow_get_option('remove_header_image_link') ) {
            the_header_image_tag( array( 'class' => 'gridshow-header-img' ) );
        } else { ?>
            <a href="<?php echo esc_url( gridshow_header_image_destination() ); ?>" rel="home" class="gridshow-header-img-link"><?php the_header_image_tag( array( 'class' => 'gridshow-header-img' ) ); ?></a>
        <?php }
    }
}

function gridshow_header_image_details() {
    $header_image_custom_title = '';
    if ( gridshow_get_option('header_image_custom_title') ) {
        $header_image_custom_title = gridshow_get_option('header_image_custom_title');
    }

    $header_image_custom_description = '';
    if ( gridshow_get_option('header_image_custom_description') ) {
        $header_image_custom_description = gridshow_get_option('header_image_custom_description');
    }

    if ( !(gridshow_get_option('hide_header_image_details')) ) {
    if ( gridshow_get_option('header_image_custom_text') ) {
        if ( $header_image_custom_title || $header_image_custom_description ) { ?>
            <div class="gridshow-header-image-info">
            <div class="gridshow-header-image-info-inside">
                <?php if ( !(gridshow_get_option('hide_header_image_title')) ) { ?><?php if ( $header_image_custom_title ) { ?><p class="gridshow-header-image-site-title gridshow-header-image-block"><?php echo wp_kses_post( force_balance_tags( do_shortcode($header_image_custom_title) ) ); ?></p><?php } ?><?php } ?>
                <?php if ( !(gridshow_get_option('hide_header_image_description')) ) { ?><?php if ( $header_image_custom_description ) { ?><p class="gridshow-header-image-site-description gridshow-header-image-block"><?php echo wp_kses_post( force_balance_tags( do_shortcode($header_image_custom_description) ) ); ?></p><?php } ?><?php } ?>
            </div>
            </div>
        <?php }
    } else { ?>
        <div class="gridshow-header-image-info">
        <div class="gridshow-header-image-info-inside">
            <?php if ( !(gridshow_get_option('hide_header_image_title')) ) { ?><p class="gridshow-header-image-site-title gridshow-header-image-block"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p><?php } ?>
            <?php if ( !(gridshow_get_option('hide_header_image_description')) ) { ?><p class="gridshow-header-image-site-description gridshow-header-image-block"><?php bloginfo( 'description' ); ?></p><?php } ?>
        </div>
        </div>
    <?php }
    }
}

function gridshow_header_image_wrapper() { ?>
    <div class="gridshow-header-image gridshow-clearfix">
    <?php gridshow_header_image_markup(); ?>
    <?php gridshow_header_image_details(); ?>
    </div><?php
}

function gridshow_header_image() {
    if ( gridshow_get_option('hide_header_image') ) { return; }
    if ( get_header_image() ) {
        gridshow_header_image_wrapper();
    }
}

/**
* CSS Classes Functions
*/

// Category ids in post class
function gridshow_category_id_class($classes) {
    global $post;
    foreach((get_the_category($post->ID)) as $category) {
        $classes[] = 'wpcat-' . $category->cat_ID . '-id';
    }
    return apply_filters( 'gridshow_category_id_class', $classes );
}
add_filter('post_class', 'gridshow_category_id_class');


// Adds custom classes to the array of body classes.
function gridshow_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'gridshow-group-blog';
    }

    if ( !(gridshow_get_option('disable_loading_animation')) ) {
        $classes[] = 'gridshow-animated gridshow-fadein';
    }

    $classes[] = 'gridshow-theme-is-active';

    if ( get_header_image() ) {
        $classes[] = 'gridshow-header-image-active';
    }

    if ( gridshow_get_option('header_image_cover') ) {
        $classes[] = 'gridshow-header-image-cover';
    }

    if ( has_custom_logo() ) {
        $classes[] = 'gridshow-custom-logo-active';
    }

    $classes[] = 'gridshow-layout-type-full';

    $classes[] = 'gridshow-masonry-inactive';

    $classes[] = 'gridshow-flexbox-grid';

    if ( !(is_singular()) ) {
        if ( gridshow_get_option('featured_media_under_summary_post_title') ) {
            $classes[] = 'gridshow-summary-media-under-title';
        }
    }

    if ( is_singular() ) {
        if( is_single() ) {
            if ( gridshow_get_option('featured_media_under_post_title') ) {
                $classes[] = 'gridshow-single-media-under-title';
            }
        }
        if( is_page() ) {
            if ( gridshow_get_option('featured_media_under_page_title') ) {
                $classes[] = 'gridshow-single-media-under-title';
            }
        }

        if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
           $classes[] = 'gridshow-layout-full-width';
        } else {
            $classes[] = 'gridshow-layout-c-s1';
        }
    } else {
        $classes[] = 'gridshow-layout-full-width';
    }

    if ( !(gridshow_is_headnavi_menu_active()) ) {
        $classes[] = 'gridshow-header-full-active';
    } else {
        $classes[] = 'gridshow-header-menu-active';
    }

    if ( gridshow_get_option('hide_tagline') ) {
        $classes[] = 'gridshow-tagline-inactive';
    }

    if ( 'beside-title' === gridshow_get_option('logo_location') ) {
        $classes[] = 'gridshow-logo-beside-title';
    } elseif ( 'above-title' === gridshow_get_option('logo_location') ) {
        $classes[] = 'gridshow-logo-above-title';
    } else {
        $classes[] = 'gridshow-logo-above-title';
    }

    if ( gridshow_is_headnavi_menu_active() ) {
        $classes[] = 'gridshow-headnavi-menu-active';
    } else {
        $classes[] = 'gridshow-headnavi-menu-inactive';
    }
    $classes[] = 'gridshow-headnavi-mobile-menu-active';

    if ( gridshow_is_primary_menu_active() ) {
        $classes[] = 'gridshow-primary-menu-active';
    }
    $classes[] = 'gridshow-primary-mobile-menu-active';
    if ( gridshow_get_option('center_primary_menu') ) {
        $classes[] = 'gridshow-primary-menu-centered';
    }

    if ( gridshow_is_secondary_menu_active() ) {
        $classes[] = 'gridshow-secondary-menu-active';
    } else {
        $classes[] = 'gridshow-secondary-menu-inactive';
    }
    $classes[] = 'gridshow-secondary-mobile-menu-active';
    if ( gridshow_get_option('center_secondary_menu') ) {
        $classes[] = 'gridshow-secondary-menu-centered';
    }

    if ( 'before-header' === gridshow_secondary_menu_location() ) {
        $classes[] = 'gridshow-secondary-menu-before-header';
    } elseif ( 'after-header' === gridshow_secondary_menu_location() ) {
        $classes[] = 'gridshow-secondary-menu-after-header';
    } elseif ( 'before-footer' === gridshow_secondary_menu_location() ) {
        $classes[] = 'gridshow-secondary-menu-before-footer';
    } elseif ( 'after-footer' === gridshow_secondary_menu_location() ) {
        $classes[] = 'gridshow-secondary-menu-after-footer';
    } else {
        $classes[] = 'gridshow-secondary-menu-before-footer';
    }

    if ( 'primary-menu' === gridshow_social_buttons_location() ) {
        $classes[] = 'gridshow-primary-social-icons';
    } else {
        $classes[] = 'gridshow-secondary-social-icons';
    }

    if ( gridshow_is_social_buttons_active() ) {
        $classes[] = 'gridshow-social-buttons-active';
    } else {
        $classes[] = 'gridshow-social-buttons-inactive';
    }

    if ( gridshow_get_option('auto_width_thumbnail') ) {
        $classes[] = 'gridshow-auto-width-thumbnail';
    } else {
        $classes[] = 'gridshow-full-width-thumbnail';
    }

    return apply_filters( 'gridshow_body_classes', $classes );
}
add_filter( 'body_class', 'gridshow_body_classes' );

/**
* More Custom Functions
*/

// Change excerpt length
function gridshow_excerpt_length($length) {
    if ( is_admin() ) {
        return $length;
    }
    $read_more_length = 17;
    return apply_filters( 'gridshow_excerpt_length', $read_more_length );
}
add_filter('excerpt_length', 'gridshow_excerpt_length');

// Change excerpt more word
function gridshow_excerpt_more($more) {
    if ( is_admin() ) {
        return $more;
    }
    return '...';
}
add_filter('excerpt_more', 'gridshow_excerpt_more');

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     */
    function wp_body_open() { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
        /**
         * Triggered after the opening <body> tag.
         */
        do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
    }
endif;

/**
* Custom Hooks
*/

function gridshow_before_header() {
    do_action('gridshow_before_header');
}

function gridshow_after_header() {
    do_action('gridshow_after_header');
}

function gridshow_before_main_content() {
    do_action('gridshow_before_main_content');
}
add_action('gridshow_before_main_content', 'gridshow_top_widgets', 20 );
add_action('gridshow_before_main_content', 'gridshow_top_left_right_widgets', 40 );

function gridshow_after_main_content() {
    do_action('gridshow_after_main_content');
}
add_action('gridshow_after_main_content', 'gridshow_bottom_widgets', 10 );

function gridshow_sidebar_one() {
    do_action('gridshow_sidebar_one');
}
add_action('gridshow_sidebar_one', 'gridshow_sidebar_one_widgets', 10 );

function gridshow_before_single_post() {
    do_action('gridshow_before_single_post');
}

function gridshow_before_single_post_title() {
    do_action('gridshow_before_single_post_title');
}

function gridshow_after_single_post_title() {
    do_action('gridshow_after_single_post_title');
}

function gridshow_top_single_post_content() {
    do_action('gridshow_top_single_post_content');
}

function gridshow_bottom_single_post_content() {
    do_action('gridshow_bottom_single_post_content');
}

function gridshow_after_single_post_content() {
    do_action('gridshow_after_single_post_content');
}

function gridshow_after_single_post() {
    do_action('gridshow_after_single_post');
}

function gridshow_before_single_page() {
    do_action('gridshow_before_single_page');
}

function gridshow_before_single_page_title() {
    do_action('gridshow_before_single_page_title');
}

function gridshow_after_single_page_title() {
    do_action('gridshow_after_single_page_title');
}

function gridshow_after_single_page_content() {
    do_action('gridshow_after_single_page_content');
}

function gridshow_after_single_page() {
    do_action('gridshow_after_single_page');
}

function gridshow_before_comments() {
    do_action('gridshow_before_comments');
}

function gridshow_after_comments() {
    do_action('gridshow_after_comments');
}

function gridshow_before_footer() {
    do_action('gridshow_before_footer');
}

function gridshow_after_footer() {
    do_action('gridshow_after_footer');
}

function gridshow_before_grid_post_title() {
    do_action('gridshow_before_grid_post_title');
}

function gridshow_after_grid_post_title() {
    do_action('gridshow_after_grid_post_title');
}

function gridshow_before_nongrid_post_title() {
    do_action('gridshow_before_nongrid_post_title');
}

function gridshow_after_nongrid_post_title() {
    do_action('gridshow_after_nongrid_post_title');
}

if ( ! function_exists( 'gridshow_remove_theme_support' ) ) :
function gridshow_remove_theme_support() {

    if ( gridshow_is_fitvids_active() ) {
        // Remove responsive embedded content support.
        remove_theme_support( 'responsive-embeds' );
    }

}
endif;
add_action( 'after_setup_theme', 'gridshow_remove_theme_support', 1000 );

/**
* Media functions
*/

function gridshow_media_content_grid() {
    global $post; ?>
    <?php if ( !(gridshow_get_option('hide_thumbnail_home')) ) { ?>
    <?php if ( has_post_thumbnail($post->ID) ) { ?>
    <div class="gridshow-grid-post-thumbnail gridshow-grid-post-block">
        <?php if ( gridshow_get_option('thumbnail_link_home') == 'no' ) { ?>
            <?php the_post_thumbnail(gridshow_grid_thumb_style(), array('class' => 'gridshow-grid-post-thumbnail-img', 'title' => the_title_attribute('echo=0'))); ?>
        <?php } else { ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="gridshow-grid-post-thumbnail-link" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail(gridshow_grid_thumb_style(), array('class' => 'gridshow-grid-post-thumbnail-img', 'title' => the_title_attribute('echo=0'))); ?></a>
        <?php } ?>
    </div>
    <?php } else { ?>
    <?php if ( !(gridshow_get_option('hide_default_thumbnail')) ) { ?>
    <div class="gridshow-grid-post-thumbnail gridshow-grid-post-thumbnail-default gridshow-grid-post-block">
        <?php if ( gridshow_get_option('thumbnail_link_home') == 'no' ) { ?>
            <img src="<?php echo esc_url( gridshow_grid_no_thumb_url() ); ?>" class="gridshow-grid-post-thumbnail-img"/>
        <?php } else { ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="gridshow-grid-post-thumbnail-link" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( gridshow_grid_no_thumb_url() ); ?>" class="gridshow-grid-post-thumbnail-img"/></a>
        <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
    <?php } ?>
<?php }

function gridshow_media_content_single() {
    global $post;
    if ( has_post_thumbnail() ) {
        if ( !(gridshow_get_option('hide_thumbnail')) ) {
            if ( gridshow_get_option('thumbnail_link') == 'no' ) { ?>
                <div class="gridshow-post-thumbnail-single">
                <?php
                if ( is_page_template( array( 'template-full-width-post.php' ) ) ) {
                    the_post_thumbnail('gridshow-1222w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                } else {
                    the_post_thumbnail('gridshow-897w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                }
                ?>
                </div>
            <?php } else { ?>
                <div class="gridshow-post-thumbnail-single">
                <?php if ( is_page_template( array( 'template-full-width-post.php' ) ) ) { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridshow-post-thumbnail-single-link"><?php the_post_thumbnail('gridshow-1222w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridshow-post-thumbnail-single-link"><?php the_post_thumbnail('gridshow-897w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } ?>
                </div>
    <?php   }
        }
    }
}

function gridshow_media_content_page() {
    global $post; ?>
    <?php
    if ( has_post_thumbnail() ) {
        if ( !(gridshow_get_option('hide_page_thumbnail')) ) {
            if ( gridshow_get_option('thumbnail_link_page') == 'no' ) { ?>
                <div class="gridshow-post-thumbnail-single">
                <?php
                if ( is_page_template( array( 'template-full-width-page.php' ) ) ) {
                    the_post_thumbnail('gridshow-1222w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                } else {
                    the_post_thumbnail('gridshow-897w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                }
                ?>
                </div>
            <?php } else { ?>
                <div class="gridshow-post-thumbnail-single">
                <?php if ( is_page_template( array( 'template-full-width-page.php' ) ) ) { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridshow-post-thumbnail-single-link"><?php the_post_thumbnail('gridshow-1222w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridshow-post-thumbnail-single-link"><?php the_post_thumbnail('gridshow-897w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } ?>
                </div>
    <?php   }
        }
    }
    ?>
<?php }

function gridshow_media_content_nongrid() {
    global $post;
    if ( has_post_thumbnail() ) {
        if ( !(gridshow_get_option('hide_thumbnail_home')) ) {
            if ( gridshow_get_option('thumbnail_link_home') == 'no' ) { ?>
                <div class="gridshow-post-thumbnail-single">
                <?php
                if ( is_page_template( array( 'template-full-width-post.php' ) ) ) {
                    the_post_thumbnail('gridshow-1222w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                } else {
                    the_post_thumbnail('gridshow-897w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                }
                ?>
                </div>
            <?php } else { ?>
                <div class="gridshow-post-thumbnail-single">
                <?php if ( is_page_template( array( 'template-full-width-post.php' ) ) ) { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridshow-post-thumbnail-single-link"><?php the_post_thumbnail('gridshow-1222w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gridshow' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="gridshow-post-thumbnail-single-link"><?php the_post_thumbnail('gridshow-897w-autoh-image', array('class' => 'gridshow-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                <?php } ?>
                </div>
    <?php   }
        }
    }
}

/**
* Enqueue scripts and styles
*/

function gridshow_scripts() {
    wp_enqueue_style('gridshow-maincss', get_stylesheet_uri(), array(), NULL);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), NULL );
    wp_enqueue_style('gridshow-webfont', '//fonts.googleapis.com/css?family=Oswald:400,700|Frank+Ruhl+Libre:400,700|Pridi:400,700&amp;display=swap', array(), NULL);

    $gridshow_fitvids_active = FALSE;
    if ( gridshow_is_fitvids_active() ) {
        $gridshow_fitvids_active = TRUE;
    }
    if ( $gridshow_fitvids_active ) {
        wp_enqueue_script('fitvids', get_template_directory_uri() .'/assets/js/jquery.fitvids.min.js', array( 'jquery' ), NULL, true);
    }

    $gridshow_backtotop_active = FALSE;
    if ( gridshow_is_backtotop_active() ) {
        $gridshow_backtotop_active = TRUE;
    }

    $gridshow_headnavi_menu_active = FALSE;
    if ( gridshow_is_headnavi_menu_active() ) {
        $gridshow_headnavi_menu_active = TRUE;
    }
    $gridshow_primary_menu_active = FALSE;
    if ( gridshow_is_primary_menu_active() ) {
        $gridshow_primary_menu_active = TRUE;
    }
    $gridshow_secondary_menu_active = FALSE;
    if ( gridshow_is_secondary_menu_active() ) {
        $gridshow_secondary_menu_active = TRUE;
    }

    $gridshow_sticky_sidebar_active = TRUE;
    if ( is_singular() ) {
        if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
           $gridshow_sticky_sidebar_active = FALSE;
        }
    } else {
        $gridshow_sticky_sidebar_active = FALSE;
    }
    if ( $gridshow_sticky_sidebar_active ) {
        wp_enqueue_script('ResizeSensor', get_template_directory_uri() .'/assets/js/ResizeSensor.min.js', array( 'jquery' ), NULL, true);
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() .'/assets/js/theia-sticky-sidebar.min.js', array( 'jquery' ), NULL, true);
    }

    wp_enqueue_script('gridshow-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NULL, true );
    wp_enqueue_script('gridshow-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), NULL, true );
    wp_enqueue_script('gridshow-customjs', get_template_directory_uri() .'/assets/js/custom.js', array( 'jquery', 'imagesloaded' ), NULL, true);

    wp_localize_script( 'gridshow-customjs', 'gridshow_ajax_object',
        array(
            'ajaxurl' => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
            'headnavi_menu_active' => $gridshow_headnavi_menu_active,
            'primary_menu_active' => $gridshow_primary_menu_active,
            'secondary_menu_active' => $gridshow_secondary_menu_active,
            'sticky_sidebar_active' => $gridshow_sticky_sidebar_active,
            'fitvids_active' => $gridshow_fitvids_active,
            'backtotop_active' => $gridshow_backtotop_active,
        )
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script('gridshow-html5shiv-js', get_template_directory_uri() .'/assets/js/html5shiv.js', array('jquery'), NULL, true);

    wp_localize_script('gridshow-html5shiv-js','gridshow_custom_script_vars',array(
        'elements_name' => esc_html__('abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video', 'gridshow'),
    ));
}
add_action( 'wp_enqueue_scripts', 'gridshow_scripts' );

/**
 * Enqueue IE compatible scripts and styles.
 */
function gridshow_ie_scripts() {
    wp_enqueue_script( 'respond', get_template_directory_uri(). '/assets/js/respond.min.js', array(), NULL, false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'gridshow_ie_scripts' );

/**
 * Enqueue styles for the block-based editor.
 */
function gridshow_block_editor_styles() {
    wp_enqueue_style( 'gridshow-block-editor-style', get_template_directory_uri() . '/assets/css/editor-blocks.css', array(), NULL );
}
add_action( 'enqueue_block_editor_assets', 'gridshow_block_editor_styles' );

/**
 * Enqueue customizer styles.
 */
function gridshow_enqueue_customizer_styles() {
    wp_enqueue_style( 'gridshow-customizer-styles', get_template_directory_uri() . '/assets/css/customizer-style.css', array(), NULL );
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), NULL );
}
add_action( 'customize_controls_enqueue_scripts', 'gridshow_enqueue_customizer_styles' );

/**
* Block Styles
*/

/**
 * Register Custom Block Styles
 */
if ( function_exists( 'register_block_style' ) ) :
    function gridshow_register_block_styles() {

        /**
         * Register block style
         */
        register_block_style( 'core/button', array( 'name' => 'gridshow-button', 'label' => __( 'GridShow Button', 'gridshow' ), 'is_default' => true, 'style_handle' => 'gridshow-maincss', ) ); // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style

    }
    add_action( 'init', 'gridshow_register_block_styles' );
endif;


// Header styles
if ( ! function_exists( 'gridshow_header_style' ) ) :
function gridshow_header_style() {
    $header_text_color = get_header_textcolor();
    //if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) { return; }
    ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>
        .gridshow-site-title, .gridshow-site-description {position: absolute;clip: rect(1px, 1px, 1px, 1px);}
    <?php else : ?>
        .gridshow-site-title, .gridshow-site-title a, .gridshow-site-description {color: #<?php echo esc_attr( $header_text_color ); ?>;}
    <?php endif; ?>
    </style>
    <?php
}
endif;