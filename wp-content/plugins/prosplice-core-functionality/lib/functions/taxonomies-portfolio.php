<?php
/**
 * Portfolio Template for Taxonomies
 * 
 * This tells WordPress “if we’re on either the portfolio category or portfolio tag taxonomies, use the portfolio archive template file”.
 * Ref: http://www.billerickson.net/genesis-portfolio/
 *
 */
function be_portfolio_template( $template ) {
  if( is_tax( array( 'portfolio_category', 'portfolio_tag' ) ) )
    $template = get_query_template( 'archive-portfolio' );
  return $template;
}
add_filter( 'template_include', 'be_portfolio_template' );