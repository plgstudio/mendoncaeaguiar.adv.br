<?php
/**
 * General repeater class
 *
 * @package LawyeriaX Lite
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}


/**
 * Class LawyeriaX_General_Repeater
 */
class LawyeriaX_General_Repeater extends WP_Customize_Control {

	/**
	 * Id
	 *
	 * @var integer $id id
	 */
	public $id;

	/**
	 * Box title
	 *
	 * @var array $boxtitle Box title
	 */
	private $boxtitle = array();

	/**
	 * Control for image
	 *
	 * @var bool $customizer_repeater_image_control Control for image
	 */
	private $customizer_repeater_image_control = false;

	/**
	 * Control for icon
	 *
	 * @var bool $customizer_repeater_icon_control Control for icon
	 */
	private $customizer_repeater_icon_control = false;


	/**
	 * Control for title
	 *
	 * @var bool $customizer_repeater_title_control Control for title
	 */
	private $customizer_repeater_title_control = false;

	/**
	 * Control for subtitle
	 *
	 * @var bool $customizer_repeater_subtitle_control Control for subtitle
	 */
	private $customizer_repeater_subtitle_control = false;

	/**
	 * Control for text
	 *
	 * @var bool $customizer_repeater_text_control Control for text
	 */
	private $customizer_repeater_text_control = false;

	/**
	 * Control for text
	 *
	 * @var bool $lawyeriax_button_text_control Control for text
	 */
	private $lawyeriax_button_text_control = false;

	/**
	 * Control for link
	 *
	 * @var bool $customizer_repeater_link_control Control for link
	 */
	private $customizer_repeater_link_control = false;

	/**
	 * LawyeriaX_General_Repeater constructor.
	 *
	 * @param string  $manager Manager.
	 * @param integer $id Id.
	 * @param array   $args Array of parameters.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->boxtitle   = __( 'LawyeriaX','lawyeriax-lite' );

		if ( ! empty( $args['lawyeriax_image_control'] ) ) {
			$this->customizer_repeater_image_control = $args['lawyeriax_image_control'];
		}

		if ( ! empty( $args['lawyeriax_icon_control'] ) ) {
			$this->customizer_repeater_icon_control = $args['lawyeriax_icon_control'];
		}

		if ( ! empty( $args['lawyeriax_title_control'] ) ) {
			$this->customizer_repeater_title_control = $args['lawyeriax_title_control'];
		}

		if ( ! empty( $args['lawyeriax_subtitle_control'] ) ) {
			$this->customizer_repeater_subtitle_control = $args['lawyeriax_subtitle_control'];
		}

		if ( ! empty( $args['lawyeriax_text_control'] ) ) {
			$this->customizer_repeater_text_control = $args['lawyeriax_text_control'];
		}

		if ( ! empty( $args['lawyeriax_button_text_control'] ) ) {
			$this->lawyeriax_button_text_control = $args['lawyeriax_button_text_control'];
		}

		if ( ! empty( $args['lawyeriax_link_control'] ) ) {
			$this->customizer_repeater_link_control = $args['lawyeriax_link_control'];
		}

		if ( ! empty( $args['id'] ) ) {
			$this->id = $args['id'];
		}
	}

	/**
	 * Enqueue resources for the control
	 */
	public function enqueue() {
		wp_enqueue_style( 'customizer-repeater-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css','4.7.0' );

		wp_enqueue_style( 'customizer-repeater-admin-stylesheet', get_template_directory_uri() . '/css/admin-style.css','1.0.0' );

		wp_enqueue_script( 'customizer-repeater-script', get_template_directory_uri() . '/inc/class/customizer-repeater/js/customizer_repeater.js', array( 'jquery', 'jquery-ui-draggable' ), '1.0.1', true );

		wp_enqueue_script( 'customizer-repeater-fontawesome-iconpicker', get_template_directory_uri() . '/inc/class/customizer-repeater/js/fontawesome-iconpicker.min.js', array( 'jquery' ), '1.0.0', true );

		wp_enqueue_script( 'customizer-repeater-iconpicker-control', get_template_directory_uri() . '/inc/class/customizer-repeater/js/iconpicker-control.js', array( 'jquery' ), '1.0.0', true );

		wp_enqueue_style( 'customizer-repeater-fontawesome-iconpicker-script', get_template_directory_uri() . '/inc/class/customizer-repeater/css/fontawesome-iconpicker.min.css' );
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>


		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="lawyeriax_general_control_repeater lawyeriax_general_control_droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
					<input type="hidden"
						   id="lawyeriax_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?>
						   class="lawyeriax_repeater_colector"
						   value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array(); ?>
					<input type="hidden"
						   id="lawyeriax_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?>
						   class="lawyeriax_repeater_colector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
				<input type="hidden" id="lawyeriax_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?>
					   class="lawyeriax_repeater_colector" value="<?php echo esc_attr( $this->value() ); ?>"/>
				<?php
			} ?>
		</div>
		<button type="button" class="button add_field lawyeriax_general_control_new_field">
			<?php esc_html_e( 'Add new field', 'lawyeriax-lite' ); ?>
		</button>
		<?php
	}

	/**
	 * Iterate through repeater's content
	 *
	 * @param array $array Repeater's content.
	 */
	private function iterate_array( $array = array() ) {
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if ( ! empty( $array ) ) {
			foreach ( $array as $icon ) { ?>
				<div class="lawyeriax_general_control_repeater_container lawyeriax_draggable">
					<div class="repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle ); ?>
					</div>
					<div class="repeater-box-content-hidden">
						<?php
						$choice = $image_url = $icon_value = $title = $subtitle = $text = $link = $shortcode = $repeater = $button_text = '';
						if ( ! empty( $icon->choice ) ) {
							$choice = $icon->choice;
						}
						if ( ! empty( $icon->image_url ) ) {
							$image_url = $icon->image_url;
						}
						if ( ! empty( $icon->icon_value ) ) {
							$icon_value = $icon->icon_value;
						}
						if ( ! empty( $icon->title ) ) {
							$title = $icon->title;
						}
						if ( ! empty( $icon->subtitle ) ) {
							$subtitle = $icon->subtitle;
						}
						if ( ! empty( $icon->text ) ) {
							$text = $icon->text;
						}
						if ( ! empty( $icon->link ) ) {
							$link = $icon->link;
						}
						if ( ! empty( $icon->button_text ) ) {
							$button_text = $icon->button_text;
						}

						if ( $this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true ) {
							$this->icon_type_choice( $choice );
						}
						if ( $this->customizer_repeater_image_control == true ) {
							$this->image_control( $image_url, $choice );
						}
						if ( $this->customizer_repeater_icon_control == true ) {
							$this->icon_picker_control( $icon_value, $choice );
						}
						if ( $this->customizer_repeater_title_control == true ) {
							$this->input_control(array(
								'label' => __( 'Title','lawyeriax-lite' ),
								'class' => 'lawyeriax_title_control',
							), $title);
						}

						if ( $this->customizer_repeater_subtitle_control == true ) {
							$this->input_control(array(
								'label' => __( 'Subtitle','lawyeriax-lite' ),
								'class' => 'lawyeriax_subtitle_control',
							), $subtitle);
						}
						if ( $this->customizer_repeater_text_control == true ) {
							$this->input_control(array(
								'label' => __( 'Text','lawyeriax-lite' ),
								'class' => 'lawyeriax_text_control',
								'type'  => 'textarea',
							), $text);
						}
						if ( $this->lawyeriax_button_text_control == true ) {
							$this->input_control(array(
								'label' => __( 'Button Text','lawyeriax-lite' ),
								'class' => 'lawyeriax_button_text_control',
							), $button_text);
						}
						if ( $this->customizer_repeater_link_control ) {
							$this->input_control(array(
								'label' => __( 'Link','lawyeriax-lite' ),
								'class' => 'lawyeriax_link_control',
								'sanitize_callback' => 'esc_url',
							), $link);
						}?>

						<input type="hidden" class="lawyeriax_box_id" value="<?php if ( ! empty( $this->id ) ) {
							echo esc_attr( $this->id );
} ?>">
						<button type="button" class="lawyeriax_general_control_remove_field button" <?php if ( $it == 0 ) {
							echo 'style="display:none;"';
} ?>>
							<?php esc_html_e( 'Delete field', 'lawyeriax-lite' ); ?>
						</button>

					</div>
				</div>

				<?php
				$it++;
			}
		} else { ?>
			<div class="lawyeriax_general_control_repeater_container">
				<div class="repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle ); ?>
				</div>
				<div class="repeater-box-content-hidden">
					<?php
					if ( $this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true ) {
						$this->icon_type_choice();
					}
					if ( $this->customizer_repeater_image_control == true ) {
						$this->image_control();
					}
					if ( $this->customizer_repeater_icon_control == true ) {
						$this->icon_picker_control();
					}
					if ( $this->customizer_repeater_title_control == true ) {
						$this->input_control( array(
							'label' => __( 'Title', 'lawyeriax-lite' ),
							'class' => 'lawyeriax_title_control',
						) );
					}
					if ( $this->customizer_repeater_subtitle_control == true ) {
						$this->input_control( array(
							'label' => __( 'Subtitle', 'lawyeriax-lite' ),
							'class' => 'lawyeriax_subtitle_control',
						) );
					}
					if ( $this->customizer_repeater_text_control == true ) {
						$this->input_control( array(
							'label' => __( 'Text', 'lawyeriax-lite' ),
							'class' => 'lawyeriax_text_control',
							'type'  => 'textarea',
						) );
					}
					if ( $this->lawyeriax_button_text_control == true ) {
						$this->input_control( array(
							'label' => __( 'Button Label', 'lawyeriax-lite' ),
							'class' => 'lawyeriax_button_text_control',
						) );
					}
					if ( $this->customizer_repeater_link_control == true ) {
						$this->input_control( array(
							'label' => __( 'Link', 'lawyeriax-lite' ),
							'class' => 'lawyeriax_link_control',
						) );
					} ?>
					<input type="hidden" class="lawyeriax_box_id">
					<button type="button" class="lawyeriax_general_control_remove_field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'lawyeriax-lite' ); ?>
					</button>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Input control.
	 *
	 * @param array  $options Settings of this input.
	 * @param string $value Value of this input.
	 */
	private function input_control( $options, $value = '' ) {
	?>
		<span class="customize-control-title"><?php echo $options['label']; ?></span>
		<?php
		if ( ! empty( $options['type'] ) && $options['type'] === 'textarea' ) { ?>
			<textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo $options['label']; ?>"><?php echo ( ! empty( $options['sanitize_callback'] ) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr( $value ) ); ?></textarea>
			<?php
		} else { ?>
			<input type="text" value="<?php echo ( ! empty( $options['sanitize_callback'] ) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr( $value ) ); ?>" class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo $options['label']; ?>"/>
			<?php
		}
	}

	/**
	 * Icon picker input
	 *
	 * @param string $value Value of this input.
	 * @param string $show Option to show or hide this.
	 */
	private function icon_picker_control( $value = '', $show = '' ) {
	?>
		<div class="lawyeriax_general_control_icon" <?php if ( $show === 'lawyeriax_image' || $show === 'lawyeriax_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Icon','lawyeriax-lite' ); ?>
			</span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="icp icp-auto" value="<?php if ( ! empty( $value ) ) { echo esc_attr( $value );} ?>" type="text">
				<span class="input-group-addon"></span>
			</div>
		</div>
		<?php
	}

	/**
	 * Image input
	 *
	 * @param string $value Value of this input.
	 * @param string $show Option to show or hide this.
	 */
	private function image_control( $value = '', $show = '' ) {
	?>
		<div class="lawyeriax_image_control" <?php if ( $show === 'lawyeriax_icon' || $show === 'lawyeriax_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Image','lawyeriax-lite' )?>
			</span>
			<input type="text" class="widefat custom_media_url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-primary custom_media_button_repeater" value="<?php esc_attr_e( 'Upload Image','lawyeriax-lite' ); ?>" />
		</div>
		<?php
	}

	/**
	 * Switch between icon and image input
	 *
	 * @param string $value Value of this input.
	 */
	private function icon_type_choice( $value = 'lawyeriax_icon' ) {
	?>
		<span class="customize-control-title">
			<?php esc_html_e( 'Image type','lawyeriax-lite' );?>
		</span>
		<select class="lawyeriax_image_choice">
			<option value="lawyeriax_icon" <?php selected( $value,'lawyeriax_icon' );?>><?php esc_html_e( 'Icon','lawyeriax-lite' ); ?></option>
			<option value="lawyeriax_image" <?php selected( $value,'lawyeriax_image' );?>><?php esc_html_e( 'Image','lawyeriax-lite' ); ?></option>
			<option value="lawyeriax_none" <?php selected( $value,'lawyeriax_none' );?>><?php esc_html_e( 'None','lawyeriax-lite' ); ?></option>
		</select>
		<?php
	}
}
