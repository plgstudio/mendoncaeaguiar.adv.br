<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lawyeriax
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="section-line-sidebar">
	<div class="clearfix"></div><div class="col-sm-10 col-sm-offset-1 section-line"></div><div class="clearfix"></div>
</div>

<aside id="secondary" class="col-sm-12 col-md-3 border-left widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
