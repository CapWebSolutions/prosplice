<?php

/**
 * Testimonials 
 *
 * This file registers CPT fields groups
 *
 * @package      ProSplice Core Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/prosplice-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
add_action( 'genesis_before_loop', 'trs_testimonial_repeater_page' );

function trs_testimonial_repeater_page () {

//My ACF Fields for reference
//testimonials - field group
//testimonial - sub-field
//testimonial_header - sub-field

if( is_page( 'testimonials' ) ) {//target the testimonials page
echo '<h2>What Our Clients Are Saying About Us</h2><br>';
remove_action( 'genesis_loop', 'genesis_do_loop' );//remove default loop
add_action( 'genesis_loop', 'trs_testimonial_loop' );//add in the repeater loop below

function trs_testimonial_loop () {

// check if the repeater field has rows of data
if( have_rows('testimonials') ):

 	// loop through the rows of data
    while ( have_rows('testimonials') ) : the_row();

        // display a sub field value
		echo 	'<div class="entry-content testimonials">
			 <p>' . get_sub_field('testimonial') . '</p>
			 <h4>' . get_sub_field('testimonial_header') . '</h4><hr>
			 </div>';

    endwhile;

else :

    // no rows found

endif;
		}

	}
}