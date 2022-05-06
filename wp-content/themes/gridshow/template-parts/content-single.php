<?php
/**
* Template part for displaying single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php gridshow_before_single_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('gridshow-post-singular gridshow-box'); ?>>
<div class="gridshow-box-inside">

    <?php if( !(gridshow_get_option('featured_media_under_post_title')) ) { ?><?php gridshow_media_content_single(); ?><?php } ?>

    <?php gridshow_before_single_post_title(); ?>

    <?php if ( !(gridshow_get_option('hide_post_header')) ) { ?>
    <header class="entry-header">
    <div class="entry-header-inside gridshow-clearfix">
        <?php if ( !(gridshow_get_option('hide_post_title')) ) { ?>
        <?php if ( gridshow_get_option('remove_post_title_link') ) { ?>
            <?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>
        <?php } else { ?>
            <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
        <?php } ?>
        <?php } ?>

        <?php gridshow_single_postmeta(); ?>
    </div>
    </header><!-- .entry-header -->
    <?php } ?>

    <?php gridshow_after_single_post_title(); ?>

    <?php if( gridshow_get_option('featured_media_under_post_title') ) { ?><?php gridshow_media_content_single(); ?><?php } ?>

    <div class="entry-content gridshow-clearfix">
            <?php
            gridshow_top_single_post_content();

            the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="gridshow-sr-only"> "%s"</span> <span class="meta-nav">&rarr;</span>', 'gridshow' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            ) );

            wp_link_pages( array(
             'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gridshow' ) . '</span>',
             'after'       => '</div>',
             'link_before' => '<span>',
             'link_after'  => '</span>',
             ) );

            gridshow_bottom_single_post_content();
            ?>
    </div><!-- .entry-content -->

    <?php gridshow_after_single_post_content(); ?>

    <?php if ( !(gridshow_get_option('hide_post_tags')) ) { ?>
    <?php if ( has_tag() ) { ?>
    <footer class="entry-footer gridshow-entry-footer">
    <div class="gridshow-entry-footer-inside">
        <?php gridshow_post_tags(); ?>
    </div>
    </footer><!-- .entry-footer -->
    <?php } ?>
    <?php } ?>

    <?php if ( !(gridshow_get_option('hide_author_bio_box')) ) { echo wp_kses_post( force_balance_tags( gridshow_add_author_bio_box() ) ); } ?>

</div>
</article>

<?php gridshow_after_single_post(); ?>