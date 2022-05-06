<?php
/**
* GridShow Theme Customizer.
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! class_exists( 'WP_Customize_Control' ) ) {return NULL;}

/**
* GridShow_Customize_Static_Text_Control class
*/

class GridShow_Customize_Static_Text_Control extends WP_Customize_Control {
    public $type = 'gridshow-static-text';

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    protected function render_content() {
        if ( ! empty( $this->label ) ) :
            ?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
        endif;

        if ( ! empty( $this->description ) ) :
            ?><div class="description customize-control-description"><?php

        echo wp_kses_post( $this->description );

            ?></div><?php
        endif;

    }
}

/**
* GridShow_Customize_Button_Control class
*/

class GridShow_Customize_Button_Control extends WP_Customize_Control {
        public $type = 'gridshow-button';
        protected $button_tag = 'button';
        protected $button_class = 'button button-primary';
        protected $button_href = 'javascript:void(0)';
        protected $button_target = '';
        protected $button_onclick = '';
        protected $button_tag_id = '';

        public function render_content() {
        ?>
        <span class="center">
        <?php
        echo '<' . esc_html($this->button_tag);
        if (!empty($this->button_class)) {
            echo ' class="' . esc_attr($this->button_class) . '"';
        }
        if ('button' == $this->button_tag) {
            echo ' type="button"';
        }
        else {
            echo ' href="' . esc_url($this->button_href) . '"' . (empty($this->button_tag) ? '' : ' target="' . esc_attr($this->button_target) . '"');
        }
        if (!empty($this->button_onclick)) {
            echo ' onclick="' . esc_js($this->button_onclick) . '"';
        }
        if (!empty($this->button_tag_id)) {
            echo ' id="' . esc_attr($this->button_tag_id) . '"';
        }
        echo '>';
        echo esc_html($this->label);
        echo '</' . esc_html($this->button_tag) . '>';
        ?>
        </span>
        <?php
        }
}

/**
* GridShow_Customize_Submit_Control class
*/

class GridShow_Customize_Submit_Control extends WP_Customize_Control {
        public $type = 'gridshow-submit-button';
        protected $button_class = '';
        protected $button_id = '';
        protected $button_value = '';
        protected $button_onclick = '';

        public function render_content() {
        ?>
        <form action="customize.php" method="get">
        <label>
        <span style="font-weight:normal;margin-bottom:10px;" class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php
        echo '<input type="submit"';
        if (!empty($this->button_class)) {
            echo ' class="' . esc_attr($this->button_class) . '"';
        }
        if (!empty($this->button_id)) {
            echo ' name="' . esc_attr($this->button_id) . '"';
        }
        if (!empty($this->button_id)) {
            echo ' id="' . esc_attr($this->button_id) . '"';
        }
        if (!empty($this->button_value)) {
            echo ' value="' . esc_attr($this->button_value) . '"';
        }
        if (!empty($this->button_onclick)) {
            echo ' onclick="return confirm(\'' . esc_js($this->button_onclick) . '\');"';
        }
        echo '/>';
        ?>
        </label>
        </form>
        <?php
        }
}

/**
* Getting started options
*/

function gridshow_getting_started($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_getting_started', array( 'title' => esc_html__( 'Getting Started', 'gridshow' ), 'description' => esc_html__( 'Thanks for your interest in GridShow! If you have any questions or run into any trouble, please visit us the following links. We will get you fixed up!', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 5, ) );

    $wp_customize->add_setting( 'gridshow_options[documentation]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new GridShow_Customize_Button_Control( $wp_customize, 'gridshow_documentation_control', array( 'label' => esc_html__( 'Documentation', 'gridshow' ), 'section' => 'gridshow_section_getting_started', 'settings' => 'gridshow_options[documentation]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => esc_url( 'https://themesdna.com/gridshow-wordpress-theme/' ), 'button_target' => '_blank', ) ) );

    $wp_customize->add_setting( 'gridshow_options[contact]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new GridShow_Customize_Button_Control( $wp_customize, 'gridshow_contact_control', array( 'label' => esc_html__( 'Contact Us', 'gridshow' ), 'section' => 'gridshow_section_getting_started', 'settings' => 'gridshow_options[contact]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => esc_url( 'https://themesdna.com/contact/' ), 'button_target' => '_blank', ) ) );

}

/**
* Menu options
*/

function gridshow_menu_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_menu_options', array( 'title' => esc_html__( 'Menu Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 100 ) );


    $wp_customize->add_setting( 'gridshow_options[headnavi_menu_text]', array( 'default' => esc_html__( 'Menu', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridshow_headnavi_menu_text_control', array( 'label' => esc_html__( 'Header Menu Mobile Text', 'gridshow' ), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[headnavi_menu_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridshow_options[disable_headnavi_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_disable_headnavi_menu_control', array( 'label' => esc_html__( 'Disable Header Menu', 'gridshow' ), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[disable_headnavi_menu]', 'type' => 'checkbox', ) );


    $wp_customize->add_setting( 'gridshow_options[primary_menu_text]', array( 'default' => esc_html__( 'Menu', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridshow_primary_menu_text_control', array( 'label' => esc_html__( 'Primary Menu Mobile Text', 'gridshow' ), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[primary_menu_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridshow_options[disable_primary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_disable_primary_menu_control', array( 'label' => esc_html__( 'Disable Primary Menu', 'gridshow' ), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[disable_primary_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[center_primary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_center_primary_menu_control', array( 'label' => esc_html__( 'Center Primary Menu', 'gridshow' ), 'description' => '<br/><hr/>', 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[center_primary_menu]', 'type' => 'checkbox', ) );


    $wp_customize->add_setting( 'gridshow_options[secondary_menu_text]', array( 'default' => esc_html__( 'Menu', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridshow_secondary_menu_text_control', array( 'label' => esc_html__( 'Secondary Menu Mobile Text', 'gridshow' ), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[secondary_menu_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridshow_options[disable_secondary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_disable_secondary_menu_control', array( 'label' => esc_html__( 'Disable Secondary Menu', 'gridshow' ), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[disable_secondary_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[center_secondary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_center_secondary_menu_control', array( 'label' => esc_html__( 'Center Secondary Menu', 'gridshow' ), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[center_secondary_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[secondary_menu_location]', array( 'default' => 'before-footer', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_secondary_menu_location' ) );

    $wp_customize->add_control( 'gridshow_secondary_menu_location_control', array( 'label' => esc_html__( 'Select Secondary Menu Location', 'gridshow' ), 'description' => esc_html__('Select where you want to display secondary menu.', 'gridshow'), 'section' => 'gridshow_section_menu_options', 'settings' => 'gridshow_options[secondary_menu_location]', 'type' => 'select', 'choices' => array( 'before-header' => esc_html__('Before Header', 'gridshow'), 'after-header' => esc_html__('After Header', 'gridshow'), 'before-footer' => esc_html__('Before Footer', 'gridshow'), 'after-footer' => esc_html__('After Footer', 'gridshow') ) ) );

}

/**
* Header options
*/

function gridshow_header_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_header', array( 'title' => esc_html__( 'Header Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 120 ) );

    $wp_customize->add_setting( 'gridshow_options[hide_tagline]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_tagline_control', array( 'label' => esc_html__( 'Hide Tagline', 'gridshow' ), 'section' => 'gridshow_section_header', 'settings' => 'gridshow_options[hide_tagline]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_header_content]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_header_content_control', array( 'label' => esc_html__( 'Hide Header Content', 'gridshow' ), 'section' => 'gridshow_section_header', 'settings' => 'gridshow_options[hide_header_content]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[logo_location]', array( 'default' => 'above-title', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_logo_location' ) );

    $wp_customize->add_control( 'gridshow_logo_location_control', array( 'label' => esc_html__( 'Logo Location', 'gridshow' ), 'description' => esc_html__('Select how you want to display the site logo with site title and tagline.', 'gridshow'), 'section' => 'title_tagline', 'settings' => 'gridshow_options[logo_location]', 'type' => 'select', 'choices' => array( 'beside-title' => esc_html__( 'Before Site Title and Tagline', 'gridshow' ), 'above-title' => esc_html__( 'Above Site Title and Tagline', 'gridshow' ) ), 'priority'   => 8 ) );

    $wp_customize->add_setting( 'gridshow_options[hide_header_image]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_header_image_control', array( 'label' => esc_html__( 'Hide Header Image from Everywhere', 'gridshow' ), 'section' => 'header_image', 'settings' => 'gridshow_options[hide_header_image]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[remove_header_image_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_remove_header_image_link_control', array( 'label' => esc_html__( 'Remove Link from Header Image', 'gridshow' ), 'section' => 'header_image', 'settings' => 'gridshow_options[remove_header_image_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_header_image_details]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_header_image_details_control', array( 'label' => esc_html__( 'Hide both Title and Description from Header Image', 'gridshow' ), 'description' => esc_html__('If you checked this option, header image title and description will be hidden from all screen sizes.', 'gridshow'), 'section' => 'header_image', 'settings' => 'gridshow_options[hide_header_image_details]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_header_image_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_header_image_title_control', array( 'label' => esc_html__( 'Hide Title from Header Image', 'gridshow' ), 'description' => esc_html__('If you checked this option, header image title will be hidden from all screen sizes. This option has no effect if you have checked the option: "Hide both Title and Description from Header Image"', 'gridshow'), 'section' => 'header_image', 'settings' => 'gridshow_options[hide_header_image_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_header_image_description]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_header_image_description_control', array( 'label' => esc_html__( 'Hide Description from Header Image', 'gridshow' ), 'description' => esc_html__('If you checked this option, header image description will be hidden from all screen sizes. This option has no effect if you have checked the option: "Hide both Title and Description from Header Image"', 'gridshow'), 'section' => 'header_image', 'settings' => 'gridshow_options[hide_header_image_description]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[header_image_custom_text]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_header_image_custom_text_control', array( 'label' => esc_html__( 'Add Custom Title/Custom Description to Header Image', 'gridshow' ), 'section' => 'header_image', 'settings' => 'gridshow_options[header_image_custom_text]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[header_image_custom_title]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_html', ) );

    $wp_customize->add_control( 'gridshow_header_image_custom_title_control', array( 'label' => esc_html__( 'Header Image Custom Title', 'gridshow' ), 'section' => 'header_image', 'settings' => 'gridshow_options[header_image_custom_title]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridshow_options[header_image_custom_description]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_html', ) );

    $wp_customize->add_control( 'gridshow_header_image_custom_description_control', array( 'label' => esc_html__( 'Header Image Custom Description', 'gridshow' ), 'section' => 'header_image', 'settings' => 'gridshow_options[header_image_custom_description]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridshow_options[header_image_destination]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_header_image_destination_control', array( 'label' => esc_html__( 'Header Image Destination URL', 'gridshow' ), 'description' => esc_html__( 'Enter the URL a visitor should go when he/she click on the header image. If you did not enter a URL below, header image will be linked to the homepage of your website.', 'gridshow' ), 'section' => 'header_image', 'settings' => 'gridshow_options[header_image_destination]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[header_image_cover]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_header_image_cover_control', array( 'label' => esc_html__( 'Add a Minimum Height to Header Image on Smaller Screens', 'gridshow' ), 'section' => 'header_image', 'settings' => 'gridshow_options[header_image_cover]', 'type' => 'checkbox', ) );

}

/**
* Posts Grid options
*/

function gridshow_posts_grid_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_posts_grid', array( 'title' => esc_html__( 'Posts Summaries Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 160 ) );

    $wp_customize->add_setting( 'gridshow_options[hide_posts_heading]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_posts_heading_control', array( 'label' => esc_html__( 'Hide HomePage Posts Heading', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_posts_heading]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[posts_heading]', array( 'default' => esc_html__( 'Recent Posts', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'gridshow_posts_heading_control', array( 'label' => esc_html__( 'HomePage Posts Heading', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[posts_heading]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridshow_options[post_summaries_style]', array( 'default' => 'grid', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_post_summaries_style' ) );

    $wp_customize->add_control( 'gridshow_post_summaries_style_control', array( 'label' => esc_html__( 'Post Summaries Style', 'gridshow' ), 'description' => esc_html__('Select the post summaries style for non-singular pages.', 'gridshow'), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[post_summaries_style]', 'type' => 'select', 'choices' => array( 'grid' => esc_html__('Grid Posts', 'gridshow'), 'non-grid' => esc_html__('Non-Grid Posts', 'gridshow') ) ) );

    $wp_customize->add_setting( 'gridshow_options[hide_thumbnail_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_thumbnail_home_control', array( 'label' => esc_html__( 'Hide Featured Images from Grid | Non-Grid Posts Summaries', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_thumbnail_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_default_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_default_thumbnail_control', array( 'label' => esc_html__( 'Hide Default Featured Image from Grid Posts', 'gridshow' ), 'description' => esc_html__( 'The default thumbnail image is shown when there is no featured image is set.', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_default_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[featured_media_under_summary_post_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_featured_media_under_summary_post_title_control', array( 'label' => esc_html__( 'Move Featured Images to Bottom of Grid | Non-Grid Post Titles', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[featured_media_under_summary_post_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[grid_thumb_style]', array( 'default' => 'gridshow-360w-270h-image', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_grid_thumb_style' ) );

    $wp_customize->add_control( 'gridshow_grid_thumb_style_control', array( 'label' => esc_html__( 'Featured Images Size of Grid Posts', 'gridshow' ), 'description' => esc_html__('Select the thumbnail size you need for the post grid.', 'gridshow'), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[grid_thumb_style]', 'type' => 'select', 'choices' => array( 'gridshow-360w-270h-image' => esc_html__('360:270 Thumbnails', 'gridshow'), 'gridshow-360w-autoh-image' => esc_html__('360:Auto Thumbnails', 'gridshow') ) ) );

    $wp_customize->add_setting( 'gridshow_options[thumbnail_link_home]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_yes_no' ) );

    $wp_customize->add_control( 'gridshow_thumbnail_link_home_control', array( 'label' => esc_html__( 'Thumbnails Links', 'gridshow' ), 'description' => esc_html__('Do you want thumbnails in posts summaries to be linked to their posts?', 'gridshow'), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[thumbnail_link_home]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gridshow'), 'no' => esc_html__('No', 'gridshow') ) ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_header_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_header_home_control', array( 'label' => esc_html__( 'Hide Post Headers from Non-Grid Posts', 'gridshow' ), 'description' => esc_html__('If you check this option, it will hide both post titles and post header meta data from non-grid posts.', 'gridshow'), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_post_header_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_title_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_title_home_control', array( 'label' => esc_html__( 'Hide Post Titles from Grid | Non-Grid Posts Summaries', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_post_title_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[post_title_link_home]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_yes_no' ) );

    $wp_customize->add_control( 'gridshow_post_title_link_home_control', array( 'label' => esc_html__( 'Posts Titles Links', 'gridshow' ), 'description' => esc_html__('Do you want post titles in posts summaries to be linked to their posts?', 'gridshow'), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[post_title_link_home]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gridshow'), 'no' => esc_html__('No', 'gridshow') ) ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_author_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_author_home_control', array( 'label' => esc_html__( 'Hide Post Author Names from Non-Grid Posts Summaries', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_post_author_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_posted_date_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_posted_date_home_control', array( 'label' => esc_html__( 'Hide Posted Dates from Non-Grid Posts Summaries', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_posted_date_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_comments_link_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_comments_link_home_control', array( 'label' => esc_html__( 'Hide Comment Links from Non-Grid Posts Summaries', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_comments_link_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_categories_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_categories_home_control', array( 'label' => esc_html__( 'Hide Post Categories from Non-Grid Posts Summaries', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_post_categories_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_tags_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_tags_home_control', array( 'label' => esc_html__( 'Hide Post Tags from Non-Grid Posts Summaries', 'gridshow' ), 'section' => 'gridshow_section_posts_grid', 'settings' => 'gridshow_options[hide_post_tags_home]', 'type' => 'checkbox', ) );

}

/**
* Post options
*/

function gridshow_post_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_post', array( 'title' => esc_html__( 'Post Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 180 ) );

    $wp_customize->add_setting( 'gridshow_options[thumbnail_link]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_yes_no' ) );

    $wp_customize->add_control( 'gridshow_thumbnail_link_control', array( 'label' => esc_html__( 'Featured Image Link', 'gridshow' ), 'description' => esc_html__('Do you want the featured image in a single post to be linked to its post?', 'gridshow'), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[thumbnail_link]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gridshow'), 'no' => esc_html__('No', 'gridshow') ) ) );

    $wp_customize->add_setting( 'gridshow_options[hide_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_thumbnail_control', array( 'label' => esc_html__( 'Hide Featured Image from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[featured_media_under_post_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_featured_media_under_post_title_control', array( 'label' => esc_html__( 'Move Featured Image to Bottom of Full Post Title', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[featured_media_under_post_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[auto_width_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_auto_width_thumbnail_control', array( 'label' => esc_html__( 'Do not Stretch Small Featured Image in Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[auto_width_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_header]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_header_control', array( 'label' => esc_html__( 'Hide Post Header from Full Post', 'gridshow' ), 'description' => esc_html__('If you check this option, it will hide post title and post header meta data from full post.', 'gridshow'), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_post_header]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_title_control', array( 'label' => esc_html__( 'Hide Post Title from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_post_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[remove_post_title_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_remove_post_title_link_control', array( 'label' => esc_html__( 'Remove Link from Full Post Title', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[remove_post_title_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_categories]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_categories_control', array( 'label' => esc_html__( 'Hide Post Categories from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_post_categories]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_author_control', array( 'label' => esc_html__( 'Hide Post Author from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_post_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_posted_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_posted_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_posted_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_comments_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_comments_link_control', array( 'label' => esc_html__( 'Hide Comment Link from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_comments_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_edit_control', array( 'label' => esc_html__( 'Hide Post Edit Link', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_post_edit]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_tags]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_tags_control', array( 'label' => esc_html__( 'Hide Post Tags from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_post_tags]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_author_bio_box]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_author_bio_box_control', array( 'label' => esc_html__( 'Hide Author Bio Box from Full Post', 'gridshow' ), 'section' => 'gridshow_section_post', 'settings' => 'gridshow_options[hide_author_bio_box]', 'type' => 'checkbox', ) );

}

/**
* Navigation options
*/

function gridshow_navigation_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_navigation', array( 'title' => esc_html__( 'Post/Posts Navigation Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 185 ) );

    $wp_customize->add_setting( 'gridshow_options[hide_post_navigation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_post_navigation_control', array( 'label' => esc_html__( 'Hide Post Navigation from Full Posts', 'gridshow' ), 'section' => 'gridshow_section_navigation', 'settings' => 'gridshow_options[hide_post_navigation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_posts_navigation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_posts_navigation_control', array( 'label' => esc_html__( 'Hide Posts Navigation from Home/Archive/Search Pages', 'gridshow' ), 'section' => 'gridshow_section_navigation', 'settings' => 'gridshow_options[hide_posts_navigation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[posts_navigation_type]', array( 'default' => 'numberednavi', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_posts_navigation_type' ) );

    $wp_customize->add_control( 'gridshow_posts_navigation_type_control', array( 'label' => esc_html__( 'Posts Navigation Type', 'gridshow' ), 'description' => esc_html__('Select posts navigation type you need. If you activate WP-PageNavi plugin, this navigation will be replaced by WP-PageNavi navigation.', 'gridshow'), 'section' => 'gridshow_section_navigation', 'settings' => 'gridshow_options[posts_navigation_type]', 'type' => 'select', 'choices' => array( 'normalnavi' => esc_html__('Normal Navigation', 'gridshow'), 'numberednavi' => esc_html__('Numbered Navigation', 'gridshow') ) ) );

}

/**
* Page options
*/

function gridshow_page_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_page', array( 'title' => esc_html__( 'Page Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 190 ) );

    $wp_customize->add_setting( 'gridshow_options[thumbnail_link_page]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_yes_no' ) );

    $wp_customize->add_control( 'gridshow_thumbnail_link_page_control', array( 'label' => esc_html__( 'Featured Image Link', 'gridshow' ), 'description' => esc_html__('Do you want the featured image in a page to be linked to its page?', 'gridshow'), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[thumbnail_link_page]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'gridshow'), 'no' => esc_html__('No', 'gridshow') ) ) );

    $wp_customize->add_setting( 'gridshow_options[hide_page_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_page_thumbnail_control', array( 'label' => esc_html__( 'Hide Featured Image from Single Page', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[hide_page_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[featured_media_under_page_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_featured_media_under_page_title_control', array( 'label' => esc_html__( 'Move Featured Image to Bottom of Page Title', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[featured_media_under_page_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_page_header]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_page_header_control', array( 'label' => esc_html__( 'Hide Page Header from Single Page', 'gridshow' ), 'description' => esc_html__('If you check this option, it will hide page title and page header meta data from single page.', 'gridshow'), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[hide_page_header]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_page_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_page_title_control', array( 'label' => esc_html__( 'Hide Page Title from Single Page', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[hide_page_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[remove_page_title_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_remove_page_title_link_control', array( 'label' => esc_html__( 'Remove Link from Single Page Title', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[remove_page_title_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_page_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_page_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Single Page', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[hide_page_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_page_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_page_author_control', array( 'label' => esc_html__( 'Hide Page Author from Single Page', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[hide_page_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_page_comments]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_page_comments_control', array( 'label' => esc_html__( 'Hide Comment Link from Single Page', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[hide_page_comments]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_page_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_page_edit_control', array( 'label' => esc_html__( 'Hide Edit Link from Single Page', 'gridshow' ), 'section' => 'gridshow_section_page', 'settings' => 'gridshow_options[hide_page_edit]', 'type' => 'checkbox', ) );

}

/**
* Social profiles options
*/

function gridshow_social_profiles($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_social', array( 'title' => esc_html__( 'Social Links Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 240, ));

    $wp_customize->add_setting( 'gridshow_options[social_buttons_location]', array( 'default' => 'primary-menu', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_social_buttons_location' ) );

    $wp_customize->add_control( 'gridshow_social_buttons_location_control', array( 'label' => esc_html__( 'Social + Search + Random + Login/Logout Buttons Location', 'gridshow' ), 'description' => esc_html__('Select where you want to display social buttons.', 'gridshow'), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[social_buttons_location]', 'type' => 'select', 'choices' => array( 'primary-menu' => esc_html__( 'Primary Menu', 'gridshow' ), 'secondary-menu' => esc_html__( 'Secondary Menu', 'gridshow' ) ) ) );

    $wp_customize->add_setting( 'gridshow_options[hide_social_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_social_buttons_control', array( 'label' => esc_html__( 'Hide Social + Search + Random + Login/Logout Buttons', 'gridshow' ), 'description' => esc_html__('If you checked this option, all buttons will disappear. There is no any effect from these options: "Hide Search Button", "Show Login/Logout Button", "Show Random Post Button".', 'gridshow'), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[hide_social_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_search_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_search_button_control', array( 'label' => esc_html__( 'Hide Search Button', 'gridshow' ), 'description' => esc_html__('This option has no effect if you have checked the option: "Hide Social + Search + Random + Login/Logout Buttons".', 'gridshow'), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[hide_search_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[show_login_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_show_login_button_control', array( 'label' => esc_html__( 'Show Login/Logout Button', 'gridshow' ), 'description' => esc_html__('This option has no effect if you have checked the option: "Hide Social + Search + Random + Login/Logout Buttons".', 'gridshow'), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[show_login_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[show_rp_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_show_rp_button_control', array( 'label' => esc_html__( 'Show Random Post Button', 'gridshow' ), 'description' => esc_html__('This option has no effect if you have checked the option: "Hide Social + Search + Random + Login/Logout Buttons".', 'gridshow'), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[show_rp_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[twitterlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_twitterlink_control', array( 'label' => esc_html__( 'Twitter URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[twitterlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[facebooklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_facebooklink_control', array( 'label' => esc_html__( 'Facebook URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[facebooklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[googlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) ); 

    $wp_customize->add_control( 'gridshow_googlelink_control', array( 'label' => esc_html__( 'Google Plus URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[googlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[pinterestlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_pinterestlink_control', array( 'label' => esc_html__( 'Pinterest URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[pinterestlink]', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'gridshow_options[linkedinlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_linkedinlink_control', array( 'label' => esc_html__( 'Linkedin Link', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[linkedinlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[instagramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_instagramlink_control', array( 'label' => esc_html__( 'Instagram Link', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[instagramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[vklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_vklink_control', array( 'label' => esc_html__( 'VK Link', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[vklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[flickrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_flickrlink_control', array( 'label' => esc_html__( 'Flickr Link', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[flickrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[youtubelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_youtubelink_control', array( 'label' => esc_html__( 'Youtube URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[youtubelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[vimeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_vimeolink_control', array( 'label' => esc_html__( 'Vimeo URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[vimeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[soundcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_soundcloudlink_control', array( 'label' => esc_html__( 'Soundcloud URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[soundcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[messengerlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_messengerlink_control', array( 'label' => esc_html__( 'Messenger URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[messengerlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[whatsapplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_whatsapplink_control', array( 'label' => esc_html__( 'WhatsApp URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[whatsapplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[lastfmlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_lastfmlink_control', array( 'label' => esc_html__( 'Lastfm URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[lastfmlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[mediumlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_mediumlink_control', array( 'label' => esc_html__( 'Medium URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[mediumlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[githublink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_githublink_control', array( 'label' => esc_html__( 'Github URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[githublink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[bitbucketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_bitbucketlink_control', array( 'label' => esc_html__( 'Bitbucket URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[bitbucketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[tumblrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_tumblrlink_control', array( 'label' => esc_html__( 'Tumblr URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[tumblrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[digglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_digglink_control', array( 'label' => esc_html__( 'Digg URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[digglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[deliciouslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_deliciouslink_control', array( 'label' => esc_html__( 'Delicious URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[deliciouslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[stumblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_stumblelink_control', array( 'label' => esc_html__( 'Stumbleupon URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[stumblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[mixlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_mixlink_control', array( 'label' => esc_html__( 'Mix URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[mixlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[redditlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_redditlink_control', array( 'label' => esc_html__( 'Reddit URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[redditlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[dribbblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_dribbblelink_control', array( 'label' => esc_html__( 'Dribbble URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[dribbblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[flipboardlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_flipboardlink_control', array( 'label' => esc_html__( 'Flipboard URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[flipboardlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[bloggerlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_bloggerlink_control', array( 'label' => esc_html__( 'Blogger URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[bloggerlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[etsylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_etsylink_control', array( 'label' => esc_html__( 'Etsy URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[etsylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[behancelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_behancelink_control', array( 'label' => esc_html__( 'Behance URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[behancelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[amazonlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_amazonlink_control', array( 'label' => esc_html__( 'Amazon URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[amazonlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[meetuplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_meetuplink_control', array( 'label' => esc_html__( 'Meetup URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[meetuplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[mixcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_mixcloudlink_control', array( 'label' => esc_html__( 'Mixcloud URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[mixcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[slacklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_slacklink_control', array( 'label' => esc_html__( 'Slack URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[slacklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[snapchatlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_snapchatlink_control', array( 'label' => esc_html__( 'Snapchat URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[snapchatlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[spotifylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_spotifylink_control', array( 'label' => esc_html__( 'Spotify URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[spotifylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[yelplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_yelplink_control', array( 'label' => esc_html__( 'Yelp URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[yelplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[wordpresslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_wordpresslink_control', array( 'label' => esc_html__( 'WordPress URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[wordpresslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[twitchlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_twitchlink_control', array( 'label' => esc_html__( 'Twitch URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[twitchlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[telegramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_telegramlink_control', array( 'label' => esc_html__( 'Telegram URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[telegramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[bandcamplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_bandcamplink_control', array( 'label' => esc_html__( 'Bandcamp URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[bandcamplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[quoralink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_quoralink_control', array( 'label' => esc_html__( 'Quora URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[quoralink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[foursquarelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_foursquarelink_control', array( 'label' => esc_html__( 'Foursquare URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[foursquarelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[deviantartlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_deviantartlink_control', array( 'label' => esc_html__( 'DeviantArt URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[deviantartlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[imdblink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_imdblink_control', array( 'label' => esc_html__( 'IMDB URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[imdblink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[codepenlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_codepenlink_control', array( 'label' => esc_html__( 'Codepen URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[codepenlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[jsfiddlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_jsfiddlelink_control', array( 'label' => esc_html__( 'JSFiddle URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[jsfiddlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[stackoverflowlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_stackoverflowlink_control', array( 'label' => esc_html__( 'Stack Overflow URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[stackoverflowlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[stackexchangelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_stackexchangelink_control', array( 'label' => esc_html__( 'Stack Exchange URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[stackexchangelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[bsalink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_bsalink_control', array( 'label' => esc_html__( 'BuySellAds URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[bsalink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[web500pxlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_web500pxlink_control', array( 'label' => esc_html__( '500px URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[web500pxlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[ellolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_ellolink_control', array( 'label' => esc_html__( 'Ello URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[ellolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[discordlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_discordlink_control', array( 'label' => esc_html__( 'Discord URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[discordlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[goodreadslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_goodreadslink_control', array( 'label' => esc_html__( 'Goodreads URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[goodreadslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[odnoklassnikilink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_odnoklassnikilink_control', array( 'label' => esc_html__( 'Odnoklassniki URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[odnoklassnikilink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[houzzlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_houzzlink_control', array( 'label' => esc_html__( 'Houzz URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[houzzlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[pocketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_pocketlink_control', array( 'label' => esc_html__( 'Pocket URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[pocketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[xinglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_xinglink_control', array( 'label' => esc_html__( 'XING URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[xinglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[googleplaylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_googleplaylink_control', array( 'label' => esc_html__( 'Google Play URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[googleplaylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[slidesharelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_slidesharelink_control', array( 'label' => esc_html__( 'SlideShare URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[slidesharelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[dropboxlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_dropboxlink_control', array( 'label' => esc_html__( 'Dropbox URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[dropboxlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[paypallink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_paypallink_control', array( 'label' => esc_html__( 'PayPal URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[paypallink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[viadeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_viadeolink_control', array( 'label' => esc_html__( 'Viadeo URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[viadeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[wikipedialink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_wikipedialink_control', array( 'label' => esc_html__( 'Wikipedia URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[wikipedialink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[skypeusername]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'gridshow_skypeusername_control', array( 'label' => esc_html__( 'Skype Username', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[skypeusername]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[emailaddress]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_email' ) );

    $wp_customize->add_control( 'gridshow_emailaddress_control', array( 'label' => esc_html__( 'Email Address', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[emailaddress]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[rsslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'gridshow_rsslink_control', array( 'label' => esc_html__( 'RSS Feed URL', 'gridshow' ), 'section' => 'gridshow_section_social', 'settings' => 'gridshow_options[rsslink]', 'type' => 'text' ) );

}

/**
* Footer options
*/

function gridshow_footer_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_footer', array( 'title' => esc_html__( 'Footer Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 280 ) );

    $wp_customize->add_setting( 'gridshow_options[footer_text]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_html', ) );

    $wp_customize->add_control( 'gridshow_footer_text_control', array( 'label' => esc_html__( 'Footer copyright notice', 'gridshow' ), 'section' => 'gridshow_section_footer', 'settings' => 'gridshow_options[footer_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_footer_widgets]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_footer_widgets_control', array( 'label' => esc_html__( 'Hide Footer Widgets', 'gridshow' ), 'section' => 'gridshow_section_footer', 'settings' => 'gridshow_options[hide_footer_widgets]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[disable_backtotop]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_disable_backtotop_control', array( 'label' => esc_html__( 'Disable Back to Top Button', 'gridshow' ), 'section' => 'gridshow_section_footer', 'settings' => 'gridshow_options[disable_backtotop]', 'type' => 'checkbox', ) );

}

/**
* 404 options
*/

function gridshow_search_404_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_search_404', array( 'title' => esc_html__( 'Search and 404 Pages Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 340 ) );

    $wp_customize->add_setting( 'gridshow_options[no_search_heading]', array( 'default' => esc_html__( 'Nothing Found', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_html', ) );

    $wp_customize->add_control( 'gridshow_no_search_heading_control', array( 'label' => esc_html__( 'No Search Results Heading', 'gridshow' ), 'description' => esc_html__( 'Enter a heading to display when no search results are found.', 'gridshow' ), 'section' => 'gridshow_section_search_404', 'settings' => 'gridshow_options[no_search_heading]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[no_search_results]', array( 'default' => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_html', ) );

    $wp_customize->add_control( 'gridshow_no_search_results_control', array( 'label' => esc_html__( 'No Search Results Message', 'gridshow' ), 'description' => esc_html__( 'Enter a message to display when no search results are found.', 'gridshow' ), 'section' => 'gridshow_section_search_404', 'settings' => 'gridshow_options[no_search_results]', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'gridshow_options[error_404_heading]', array( 'default' => esc_html__( 'Oops! That page can not be found.', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_html', ) );

    $wp_customize->add_control( 'gridshow_error_404_heading_control', array( 'label' => esc_html__( '404 Error Page Heading', 'gridshow' ), 'description' => esc_html__( 'Enter the heading for the 404 error page.', 'gridshow' ), 'section' => 'gridshow_section_search_404', 'settings' => 'gridshow_options[error_404_heading]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'gridshow_options[error_404_message]', array( 'default' => esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gridshow' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_html', ) );

    $wp_customize->add_control( 'gridshow_error_404_message_control', array( 'label' => esc_html__( 'Error 404 Message', 'gridshow' ), 'description' => esc_html__( 'Enter a message to display on the 404 error page.', 'gridshow' ), 'section' => 'gridshow_section_search_404', 'settings' => 'gridshow_options[error_404_message]', 'type' => 'textarea', ) );

    $wp_customize->add_setting( 'gridshow_options[hide_404_search]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_hide_404_search_control', array( 'label' => esc_html__( 'Hide Search Box from 404 Page', 'gridshow' ), 'section' => 'gridshow_section_search_404', 'settings' => 'gridshow_options[hide_404_search]', 'type' => 'checkbox', ) );

}

/**
* Other options
*/

function gridshow_other_options($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_other_options', array( 'title' => esc_html__( 'Other Options', 'gridshow' ), 'panel' => 'gridshow_main_options_panel', 'priority' => 600 ) );

    $wp_customize->add_setting( 'gridshow_options[enable_widgets_block_editor]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_enable_widgets_block_editor_control', array( 'label' => esc_html__( 'Enable Gutenberg Widget Block Editor', 'gridshow' ), 'section' => 'gridshow_section_other_options', 'settings' => 'gridshow_options[enable_widgets_block_editor]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[disable_loading_animation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_disable_loading_animation_control', array( 'label' => esc_html__( 'Disable Site Loading Animation', 'gridshow' ), 'section' => 'gridshow_section_other_options', 'settings' => 'gridshow_options[disable_loading_animation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'gridshow_options[disable_fitvids]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'gridshow_sanitize_checkbox', ) );

    $wp_customize->add_control( 'gridshow_disable_fitvids_control', array( 'label' => esc_html__( 'Disable FitVids.JS', 'gridshow' ), 'description' => esc_html__( 'You can disable fitvids.js script if you are not using videos on your website or if you do not want fluid width videos in your post content.', 'gridshow' ), 'section' => 'gridshow_section_other_options', 'settings' => 'gridshow_options[disable_fitvids]', 'type' => 'checkbox', ) );

}

/**
* Upgrade to pro options
*/

function gridshow_upgrade_to_pro($wp_customize) {

    $wp_customize->add_section( 'gridshow_section_upgrade', array( 'title' => esc_html__( 'Upgrade to Pro Version', 'gridshow' ), 'priority' => 400 ) );
    
    $wp_customize->add_setting( 'gridshow_options[upgrade_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new GridShow_Customize_Static_Text_Control( $wp_customize, 'gridshow_upgrade_text_control', array(
        'label'       => esc_html__( 'GridShow Pro', 'gridshow' ),
        'section'     => 'gridshow_section_upgrade',
        'settings' => 'gridshow_options[upgrade_text]',
        'description' => esc_html__( 'Do you enjoy GridShow? Upgrade to GridShow Pro now and get:', 'gridshow' ).
            '<ul class="gridshow-customizer-pro-features">' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Color Options', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Font Options', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '1/2/3/4/5/6/7/8/9/10 Columns Options for Posts Grids', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Thumbnail Sizes Options for Posts Grids', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Custom Thumbnail Size Options for Posts Grids', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Switch between Masonry Grid (JavaScript based) and CSS only Grid', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Display Ads/Custom Contents between Posts in the Grid', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Switch between Boxed or Full Layout Type', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Layout Styles for Posts/Pages', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Layout Styles for Non-Singular Pages', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Width Change Options for Full Website/Main Content/Left Sidebar/Right Sidebar', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Custom Page Templates', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '10+ Custom Post Templates', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '3 Header Layouts with Width options - (Logo + Header Menu) / (Logo + Header Banner) / (Full Width Header)', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Footer with Layout Options (1/2/3/4/5/6 columns)', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Change Website Width/Layout Type/Layout Style/Header Style/Footer Style of any Post/Page', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Capability to Add Different Header Images for Each Post/Page with Unique Link, Title and Description', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Grid Featured Posts Widget (Recent/Categories/Tags/PostIDs based) - with capability to display posts according to Likes/Views/Comments/Dates/... and there are many options', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'List Featured Posts Widget (Recent/Categories/Tags/PostIDs based) - with capability to display posts according to Likes/Views/Comments/Dates/... and there are many options', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Tabbed Widget (Recent/Categories/Tags/PostIDs based) - with capability to display posts according to Likes/Views/Comments/Dates/... and there are many options.', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'About and Social Widget - 60+ Social Buttons', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'News Ticker (Recent/Categories/Tags/PostIDs based) - It can display posts according to Likes/Views/Comments/Dates/... and there are many options.', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Settings Panel to Control Options in Each Post', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Settings Panel to Control Options in Each Page', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Posts Views Counter', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Posts Likes System', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Infinite Scroll and Load More Button', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Post Share Buttons Styles with Options - 25+ Social Networks are Supported', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Related Posts (Categories/Tags/Author/PostIDs based) with Many Options - For both single posts and post summaries', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Sticky Menu/Sticky Sidebars with enable/disable capability', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Author Bio Box with Social Buttons - 60+ Social Buttons', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Enable/Disable Mobile View from Primary, Secondary and Header Menus', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Post Navigation with Thumbnails', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to add Ads under Post Title and under Post Content', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Disable Google Fonts - for faster loading', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'More Widget Areas', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Contact Form', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'WooCommerce Compatible', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Yoast SEO Breadcrumbs Support', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Full RTL Language Support', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Search Engine Optimized', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Random Posts Button in Header', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Many Useful Customizer Theme options', 'gridshow' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'More Features...', 'gridshow' ) . '</li>' .
            '</ul>'.
            '<strong><a href="'.GRIDSHOW_PROURL.'" class="button button-primary" target="_blank"><i class="fas fa-shopping-cart" aria-hidden="true"></i> ' . esc_html__( 'Upgrade To GridShow PRO', 'gridshow' ) . '</a></strong>'
    ) ) );

}

/**
* Sanitize callback functions
*/

function gridshow_sanitize_checkbox( $input ) {
    return ( ( isset( $input ) && ( true == $input ) ) ? true : false );
}

function gridshow_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function gridshow_sanitize_yes_no( $input, $setting ) {
    $valid = array('yes','no');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_grid_thumb_style( $input, $setting ) {
    $valid = array('gridshow-360w-270h-image','gridshow-360w-autoh-image');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_post_summaries_style( $input, $setting ) {
    $valid = array('grid','non-grid');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_posts_navigation_type( $input, $setting ) {
    $valid = array('normalnavi','numberednavi');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_email( $input, $setting ) {
    if ( '' != $input && is_email( $input ) ) {
        $input = sanitize_email( $input );
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_logo_location( $input, $setting ) {
    $valid = array('beside-title','above-title');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_social_buttons_location( $input, $setting ) {
    $valid = array('primary-menu','secondary-menu');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_secondary_menu_location( $input, $setting ) {
    $valid = array(
            'before-header' => esc_html__('Before Header', 'gridshow'),
            'after-header' => esc_html__('After Header', 'gridshow'),
            'before-footer' => esc_html__('Before Footer', 'gridshow'),
            'after-footer' => esc_html__( 'After Footer', 'gridshow' )
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function gridshow_sanitize_positive_integer( $input, $setting ) {
    $input = absint( $input ); // Force the value into non-negative integer.
    return ( 0 < $input ) ? $input : $setting->default;
}

function gridshow_sanitize_positive_float( $input, $setting ) {
    $input = (float) $input;
    return ( 0 < $input ) ? $input : $setting->default;
}

function gridshow_register_theme_customizer( $wp_customize ) {

    if(method_exists('WP_Customize_Manager', 'add_panel')):
    $wp_customize->add_panel('gridshow_main_options_panel', array( 'title' => esc_html__('Theme Options', 'gridshow'), 'priority' => 10, ));
    endif;

    $wp_customize->get_section( 'title_tagline' )->panel = 'gridshow_main_options_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = 20;
    $wp_customize->get_section( 'header_image' )->panel = 'gridshow_main_options_panel';
    $wp_customize->get_section( 'header_image' )->priority = 26;
    $wp_customize->get_section( 'background_image' )->panel = 'gridshow_main_options_panel';
    $wp_customize->get_section( 'background_image' )->priority = 27;
    $wp_customize->get_section( 'colors' )->panel = 'gridshow_main_options_panel';
    $wp_customize->get_section( 'colors' )->priority = 40;
      
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
    $wp_customize->get_control( 'background_color' )->description = esc_html__('To change Background Color, need to remove background image first:- go to Appearance : Customize : Theme Options : Background Image', 'gridshow');

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.gridshow-site-title a',
            'render_callback' => 'gridshow_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.gridshow-site-description',
            'render_callback' => 'gridshow_customize_partial_blogdescription',
        ) );
    }

    gridshow_getting_started($wp_customize);
    gridshow_menu_options($wp_customize);
    gridshow_header_options($wp_customize);
    gridshow_posts_grid_options($wp_customize);
    gridshow_post_options($wp_customize);
    gridshow_navigation_options($wp_customize);
    gridshow_page_options($wp_customize);
    gridshow_social_profiles($wp_customize);
    gridshow_footer_options($wp_customize);
    gridshow_search_404_options($wp_customize);
    gridshow_other_options($wp_customize);
    gridshow_upgrade_to_pro($wp_customize);

}

add_action( 'customize_register', 'gridshow_register_theme_customizer' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gridshow_customize_partial_blogname() {
    bloginfo( 'name' );
}
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gridshow_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

function gridshow_customizer_js_scripts() {
    wp_enqueue_script('gridshow-theme-customizer-js', get_template_directory_uri() . '/assets/js/customizer.js', array( 'jquery', 'customize-preview' ), NULL, true);
}
add_action( 'customize_preview_init', 'gridshow_customizer_js_scripts' );