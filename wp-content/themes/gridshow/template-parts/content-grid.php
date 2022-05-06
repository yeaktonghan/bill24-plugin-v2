<?php
/**
* Template part for displaying posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php $gridshow_grid_post_content = get_the_content(); ?>
<div id="post-<?php the_ID(); ?>" class="gridshow-grid-post gridshow-5-col">
<div class="gridshow-grid-post-inside">

    <?php if ( !(gridshow_get_option('featured_media_under_summary_post_title')) ) { ?><?php gridshow_media_content_grid(); ?><?php } ?>

    <?php gridshow_before_grid_post_title(); ?>

    <?php if ( !(gridshow_get_option('hide_post_title_home')) ) { ?>
    <?php if ( gridshow_get_option('post_title_link_home') == 'no' ) { ?>
        <div class="gridshow-grid-post-header gridshow-grid-post-block gridshow-clearfix"><div class="gridshow-grid-post-header-inside gridshow-clearfix"><?php the_title( '<h3 class="gridshow-grid-post-title">', '</h3>' ); ?></div></div>
    <?php } else { ?>
        <div class="gridshow-grid-post-header gridshow-grid-post-block gridshow-clearfix"><div class="gridshow-grid-post-header-inside gridshow-clearfix"><?php the_title( sprintf( '<h3 class="gridshow-grid-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?></div></div>
    <?php } ?>
    <?php } ?>

    <?php gridshow_after_grid_post_title(); ?>

    <?php if( gridshow_get_option('featured_media_under_summary_post_title') ) { ?><?php gridshow_media_content_grid(); ?><?php } ?>

</div>
</div>