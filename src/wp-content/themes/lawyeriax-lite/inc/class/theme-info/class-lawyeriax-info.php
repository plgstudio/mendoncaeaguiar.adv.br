<?php
/**
 * Theme info control for customizer.
 *
 * @package Lawyeriax
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Lawyeriax_Info
 */
class Lawyeriax_Info extends WP_Customize_Control {

	/**
	 * The links for the control.
	 *
	 * @var links links to add to the control.
	 */
	public $links;

	/**
	 * Enqueue required scripts and styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'lawyeriax-theme-info-control', get_template_directory_uri() . '/css/admin-style.css','1.0.0' );
	}

	/**
	 * The render function for the controler
	 */
	public function render_content() {
		?>


		<div class="lawyeriax-theme-info">
			<?php
			foreach ( $this->links as $item ) {  ?>
				<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank"><?php echo esc_html( $item['name'] ); ?></a>
				<hr/>
				<?php
			} ?>
		</div>
		<?php
	}
}
