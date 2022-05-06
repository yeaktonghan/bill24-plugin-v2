<?php
/**
* The template for displaying author archive pages.
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

<?php if ( !(gridshow_get_option('hide_author_title')) ) { ?>
<div class="gridshow-page-header-outside">
<header class="gridshow-page-header">
<div class="gridshow-page-header-inside">
<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
<?php if ( !(gridshow_get_option('hide_author_description')) ) { ?><?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?><?php } ?>
</div>
</header>
</div>
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