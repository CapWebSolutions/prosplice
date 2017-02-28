<?php
/**
 * Genesis Framework.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

// Remove default loop.
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );

/**
 * This function outputs a Custom 404 "Not Found" error message.
 *
 * @since 1.6
 */

function genesis_404() {

	genesis_markup( array(
		'open' => '<article class="entry">',
		'context' => 'entry-404',
	) );

		printf( '<h1 class="entry-title">%s</h1>', apply_filters( 'genesis_404_entry_title', __( 'Oops. It seems that the page you are looking for is no longer found on this website.<br><hr>The dreaded <em>Error 404</em>. ', 'genesis' ) ) );
		echo '<div class="entry-content">';

			if ( genesis_html5() ) :

				echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'A couple of options: <br>1) You can return to the site\'s <a href="%s">homepage</a>. <br>2) Try searching the site using the search form below.<br>3) Check the site map at the bottom for reference.', 'genesis' ), trailingslashit( home_url() ) ) . '</p>' );

				get_search_form();

			else :
	?>
	<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), trailingslashit( home_url() ) ); ?></p>
	<?php
			endif;

			if ( genesis_a11y( '404-page' ) ) {
				echo '<h2>' . __( 'Sitemap', 'genesis' ) . '</h2>';
				genesis_sitemap( 'h3' );
			} else {
				genesis_sitemap( 'h4' );
			}

		echo '</div>';

	genesis_markup( array(
		'close' => '</article>',
		'context' => 'entry-404',
	) );

}

genesis();