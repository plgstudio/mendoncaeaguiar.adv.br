/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	/********************************************************/
	/******************* Ribbon Section *********************/
	/********************************************************/

 	wp.customize( 'lawyeriax_ribbon_tagline', function( value ) {
 		value.bind( function( to ) {
 			$( '.ribbon .ribbon-big-title' ).html( to );
 		} );
 	} );

/********************************************************/
/******************* Lawyers Section ********************/
/********************************************************/

	wp.customize( 'lawyeriax_lawyers_heading', function( value ) {
		value.bind( function( to ) {
			$( '.lawyer .home-section-title' ).html( to );
		} );
	} );

/********************************************************/
/****************** Practices Section *******************/
/********************************************************/

	wp.customize( 'lawyeriax_practice_heading', function( value ) {
		value.bind( function( to ) {
			$( '#practice .home-section-title' ).html( to );
		} );
	} );

/********************************************************/
/****************** Clients Section *********************/
/********************************************************/

	wp.customize( 'lawyeriax_clients_heading', function( value ) {
		value.bind( function( to ) {
			$( '#clients .home-section-title' ).html( to );
		} );
	} );


/********************************************************/
/******************* About Section **********************/
/********************************************************/

//heading

	wp.customize( 'lawyeriax_about_heading', function( value ) {
		value.bind( function( to ) {
			$( '.about .about-title' ).html( to );
		} );
	} );

	//text

	wp.customize( 'lawyeriax_about_text', function( value ) {
		value.bind( function( to ) {
			$( '.about .about-content p' ).html( to );
		} );
	} );

	/********************************************************/
	/******************** News Section **********************/
	/********************************************************/


	wp.customize( 'news_heading', function( value ) {
		value.bind( function( to ) {
			$( '#news .home-section-title' ).html( to );
		} );
	} );

	/********************************************************/
	/**************** Case Studies Section ******************/
	/********************************************************/


	wp.customize( 'case_studies_heading', function( value ) {
		value.bind( function( to ) {
			$( '#case-studies > div.home-section-title-wrap > h2' ).html( to );
		} );
	} );

	/********************************************************/
	/**************** Testimonial Section *******************/
	/********************************************************/


	wp.customize( 'testimonial_heading', function( value ) {
		value.bind( function( to ) {
			$( '#testimonials > div.home-section-title-wrap > h2' ).html( to );
		} );
	} );

	/********************************************************/
	/******************** Footer Text ***********************/
	/********************************************************/

	wp.customize( 'footer_copyright', function( value ) {
		value.bind( function( newval ) {
			$( 'footer .site-info > .site-info-inner > a' ).html( newval );
		} );
	} );

	/********************************************************/
	/**************** Custom Colors Async *******************/
	/********************************************************/

/* TOP BAR / FOOTER
============================================================================= */
wp.customize( 'background_top_footer', function( value ) {
	value.bind( function( newval ) {
		$('.top-bar, .site-footer').css('background-color', newval );
	} );
} );

  /*Text Color*/
wp.customize( 'text_top_footer', function( value ) {
	value.bind( function( newval ) {
		$('.top-bar .top-bar-contact a, .site-footer').css('color', newval );
	} );
} );

  /*Links*/
wp.customize( 'links_top_footer', function( value ) {
	value.bind( function( newval ) {
		$('.top-bar .top-bar-social a, .site-footer a').css('color', newval );
	} );
} );

/* NAVBAR
============================================================================= */
wp.customize( 'background_navbar', function( value ) {
	value.bind( function( newval ) {
		$('.sticky-navigation').css('background-color', newval );
	} );
} );

/*Links*/
wp.customize( 'links_navbar', function( value ) {
	value.bind( function( newval ) {
		$('.main-navigation a, button.menu-toggle').css('color', newval );
	} );
} );

/*Dropdown Background*/
wp.customize( 'dropdown_navbar', function( value ) {
	value.bind( function( newval ) {
		$('.main-navigation ul ul').css('background-color', newval );
	} );
} );

/*Dropdown Links*/
wp.customize( 'dropdown_links_navbar', function( value ) {
	value.bind( function( newval ) {
		$('.main-navigation ul ul a').css('color', newval );
	} );
} );

/* ACCENTS
============================================================================= */
wp.customize( 'main_accents', function( value ) {
	value.bind( function( newval ) {
		$('a.slider-button, .features-title-icon, a.view-profile, .news-date, .widget_search input[type="submit"], #siteModal button, #siteModal button.modal-close-button, #siteModal input[type="submit"]').css('background-color', newval );
		$('h4.practice-box-title, a.read-more, h4.practice-box-title:hover, a.read-more:hover').css('color', newval );
	} );
} );

/*Accents content*/
wp.customize( 'secondary_accents', function( value ) {
	value.bind( function( newval ) {
		$('a.slider-button, .features-title-icon, a.view-profile, .news-date span, .widget_search input[type="submit"], #siteModal button, #siteModal button.modal-close-button').css('color', newval );
	} );
} );

/* SLIDER
============================================================================= */
/*Primary Heading*/
wp.customize( 'main_heading_slider', function( value ) {
	value.bind( function( newval ) {
		$('#main-slider .carousel-title').css('color', newval );
	} );
} );

/*Secondary Heading*/
wp.customize( 'secondary_heading_slider', function( value ) {
	value.bind( function( newval ) {
		$('#main-slider .carousel-content').css('color', newval );
	} );
} );


/* BODY TEXT
============================================================================= */
/*Section Headings*/
wp.customize( 'section_headings', function( value ) {
	value.bind( function( newval ) {
		$('.home-section-title').css('color', newval );
	} );
} );

/*Tagline*/
wp.customize( 'ribbon_text', function( value ) {
	value.bind( function( newval ) {
		$('.ribbon-big-title').css('color', newval );
	} );
} );

/*Body Text*/
wp.customize( 'body_text_color', function( value ) {
	value.bind( function( newval ) {
		$('body, .testimonial-subname').css('color', newval );
	} );
} );

/*Link*/
wp.customize( 'body_links_color', function( value ) {
	value.bind( function( newval ) {
		$('.lawyer-title a, .news-post-title a, .news-posted-on a, .entry-meta a, .entry-meta span, .entry-meta .posted-on a, .entry-meta .author a, .entry-footer a, a.team-social-icon-link').css('color', newval );
	} );
} );

/*Small Headings*/
wp.customize( 'small_headings_color', function( value ) {
	value.bind( function( newval ) {
		$('.testimonial-name, h3').css('color', newval );
	} );
} );

/*Practice Area Icons*/
wp.customize( 'practice_icons_color', function( value ) {
	value.bind( function( newval ) {
		$('.practie-title-icon').css('color', newval );
	} );
} );

/********************************************************/
/**************** Section Toggle ************************/
/********************************************************/

/*Top Bar*/
wp.customize( 'lawyeriax_top_bar_hide', function( value ) {
	value.bind( function( newval ) {
        if( true !== newval ) {
			$( '.top-bar' ).removeClass( 'hidden-in-customizer' );
			$( '#page' ).css( 'padding-top','110px' );
		}
		else {
			$( '.top-bar' ).addClass( 'hidden-in-customizer' );
			$( '#page' ).css( 'padding-top','100px' );
		}
	} );
} );

/*Slider*/
wp.customize( 'lawyeriax_slider_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#slider' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#slider' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*Ribbon*/
wp.customize( 'lawyeriax_ribbon_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#ribbon' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#ribbon' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*Features Section*/
wp.customize( 'lawyeriax_features_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#features' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#features' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*Lawyers Section*/
wp.customize( 'lawyeriax_lawyers_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#lawyer' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#lawyer' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*Practice Section*/
wp.customize( 'lawyeriax_practice_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#practice' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#practice' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*About Section*/
wp.customize( 'lawyeriax_about_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#about' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#about' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*Clients Section*/
wp.customize( 'lawyeriax_clients_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#clients' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#clients' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*News Section*/
wp.customize( 'lawyeriax_news_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#news' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#news' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*Case Studies Section*/
wp.customize( 'lawyeriax_case_studies_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#case-studies' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#case-studies' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

/*Testimonials Section*/
wp.customize( 'lawyeriax_testimonial_toggle', function( value ) {
	value.bind( function( newval ) {
		if( true !== newval ) {
			$( '#testimonials' ).removeClass( 'hidden-in-customizer' );
		}
		else {
			$( '#testimonials' ).addClass( 'hidden-in-customizer' );
		}
	} );
} );

} )( jQuery );
