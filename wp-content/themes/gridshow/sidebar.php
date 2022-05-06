<?php
/**
* The file for displaying the sidebars.
*
* @package GridShow WordPress Theme
* @copyright Copyright (C) 2022 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php if ( is_singular() ) { ?>

<?php if(!is_page_template(array( 'template-full-width-page.php', 'template-full-width-post.php' ))) { ?>
<div class="gridshow-sidebar-one-wrapper gridshow-sidebar-widget-areas gridshow-clearfix" id="gridshow-sidebar-one-wrapper" itemscope="itemscope" itemtype="http://schema.org/WPSideBar" role="complementary">
<div class="theiaStickySidebar">
<div class="gridshow-sidebar-one-wrapper-inside gridshow-clearfix">

<?php gridshow_sidebar_one(); ?>

</div>
</div>
</div><!-- /#gridshow-sidebar-one-wrapper-->
<?php } ?>

<?php } ?>