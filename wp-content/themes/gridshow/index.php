<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class="gridshow-main-wrapper gridshow-clearfix" id="gridshow-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="gridshow-main-wrapper-inside gridshow-clearfix">

<?php gridshow_before_main_content(); ?>

<div class="gridshow-posts-wrapper" id="gridshow-posts-wrapper">

<?php if ( !(gridshow_get_option('hide_posts_heading')) ) { ?>
<?php if(is_home() && !is_paged()) { ?>
<?php if ( gridshow_get_option('posts_heading') ) : ?>
<div class="gridshow-posts-header"><div class="gridshow-posts-header-inside"><h2 class="gridshow-posts-heading"><span class="gridshow-posts-heading-inside"><?php echo esc_html( gridshow_get_option('posts_heading') ); ?></span></h2></div></div>
<?php else : ?>
<div class="gridshow-posts-header"><div class="gridshow-posts-header-inside"><h2 class="gridshow-posts-heading"><span class="gridshow-posts-heading-inside"><?php esc_html_e( 'Recent Posts', 'gridshow' ); ?></span></h2></div></div>
<?php endif; ?>
<?php } ?>
<?php } ?>

<div class="gridshow-posts-content">

<?php if (have_posts()) : ?>

    <?php if ( 'grid' === gridshow_post_summaries_style() ) { ?>

    <div class="gridshow-posts gridshow-posts-grid">
    <?php $gridshow_post_counter=1; while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'template-parts/content-grid' ); ?>

    <?php $gridshow_post_counter++; endwhile; ?>
    </div>

    <?php } else { ?>

    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part( 'template-parts/content-nongrid' ); ?>
    <?php endwhile; ?>

    <?php } ?>

    <div class="clear"></div>

    <?php gridshow_posts_navigation(); ?>

<?php else : ?>

  <?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

</div>

</div><!--/#gridshow-posts-wrapper -->

<?php gridshow_after_main_content(); ?>

</div>
</div>
</div><!-- /#gridshow-main-wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>