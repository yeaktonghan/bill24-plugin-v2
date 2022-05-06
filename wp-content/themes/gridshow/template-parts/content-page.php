<?php
/**
* Template part for displaying page content in page.php.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php gridshow_before_single_page(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('gridshow-post-singular gridshow-box'); ?>>
<div class="gridshow-box-inside">

    <?php if( !(gridshow_get_option('featured_media_under_page_title')) ) { ?><?php gridshow_media_content_page(); ?><?php } ?>

    <?php gridshow_before_single_page_title(); ?>

    <?php if ( !(gridshow_get_option('hide_page_header')) ) { ?>
    <header class="entry-header">
    <div class="entry-header-inside gridshow-clearfix">
        <?php if ( !(gridshow_get_option('hide_page_title')) ) { ?>
        <?php if ( gridshow_get_option('remove_page_title_link') ) { ?>
            <?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>
        <?php } else { ?>
            <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
        <?php } ?>
        <?php } ?>

        <?php gridshow_page_postmeta(); ?>
    </div>
    </header><!-- .entry-header -->
    <?php } ?>

    <?php gridshow_after_single_page_title(); ?>

    <?php if( gridshow_get_option('featured_media_under_page_title') ) { ?><?php gridshow_media_content_page(); ?><?php } ?>

    <div class="entry-content gridshow-clearfix">
            <?php
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
             ?>
    </div><!-- .entry-content -->

    <?php gridshow_after_single_page_content(); ?>

    <?php
    if ( !(gridshow_get_option('hide_page_edit')) ) {
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="gridshow-sr-only">%s</span>', 'gridshow' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            ),
            '<footer class="entry-footer gridshow-entry-footer"><div class="gridshow-entry-footer-inside"><span class="edit-link">',
            '</span></div></footer>'
        );
    }
    ?>

</div>
</article>

<?php gridshow_after_single_page(); ?>