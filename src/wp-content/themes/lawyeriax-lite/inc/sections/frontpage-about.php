<?php
/**
 * Frontpage About Section
 *
 * @package LawyeriaX
 */

if ( ! function_exists( 'lawyeriax_about_section' ) ) :
	/**
	 * About us sections
	 */
	function lawyeriax_about_section() {

		$about_toggle  = get_theme_mod( 'lawyeriax_about_toggle', 0 );
		$about_image = get_theme_mod( 'lawyeria_about_image', get_template_directory_uri() . '/images/about-us.jpg' );
		$about_title = get_theme_mod( 'lawyeriax_about_heading', esc_html__( 'Choose the color that suits you for the following: Menu, Header, Footer and Frontpage boxes', 'lawyeriax-lite' ) );
		$about_text = get_theme_mod( 'lawyeriax_about_text', esc_html( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Expressa vero in iis aetatibus, quae iam confirmatae sunt. Nihil opus est exemplis hoc facere longius. Restincta enim sitis stabilitatem voluptatis habet, inquit, illa autem voluptas ipsius restinctionis in motu est. Sed tu, ut dignum est tua erga me et philosophiam voluntate ab adolescentulo suscepta, fac ut Metrodori tueare liberos. Vitae autem degendae ratio maxime quidem illis placuit quieta. Quae si potest singula consolando levare, universa quo modo sustinebit? Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti. Duo Reges: constructio interrete. Epicurus ait exiguam intervenire sapienti. Duo Reges: constructio interrete.', 'lawyeriax' ) );

		if ( isset( $about_toggle ) && ! $about_toggle ) {

			echo '<section id="about" class="home-section about">';

		} elseif ( is_customize_preview() ) {

			echo '<section id="about" class="home-section about hidden-in-customizer">';

		}

		if ( ( isset( $about_toggle ) && ! $about_toggle ) || is_customize_preview() ) { ?>

			<div class="container">

				<div class="home-section-inner">

					<?php if ( ! empty( $about_image ) ) { ?>

					<div class="col-sm-5 about-image-wrap">
						<img src="<?php echo esc_url( $about_image ); ?>" alt="About Us Image">
					</div>

					<div class="col-sm-7 about-content-wrap">

						<?php } else { ?>

						<div class="col-sm-12 about-content-wrap">

							<?php }

if ( ! empty( $about_title ) ) { ?>

								<h3 class="about-title"><?php echo wp_kses_post( force_balance_tags( $about_title ) ); ?></h3>

								<?php
}

if ( ! empty( $about_text ) ) { ?>

								<div class="border-left about-content">

									<p><?php echo wp_kses_post( force_balance_tags( $about_text ) ); ?></p>

								</div>

								<?php
}
							?>

						</div><!-- .about-content-wrap -->
					</div><!-- .home-section-inner -->

					<div class="col-sm-10 col-sm-offset-1 section-line"></div>
			</div><!-- .container -->
			</section>

			<?php
		}
	}
	endif;
