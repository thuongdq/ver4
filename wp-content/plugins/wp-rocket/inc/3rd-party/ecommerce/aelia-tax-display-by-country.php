<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

/**
 * Compatibility with Aelia Tax Display by Country.
 *
 * @since 2.8.15
 */
if ( class_exists( 'Aelia\WC\TaxDisplayByCountry\WC_Aelia_Tax_Display_By_Country' ) ) :
	/*
	 * Generate a caching file depending to the tax display cookie values
	 *
	 */
	add_filter( 'rocket_htaccess_mod_rewrite'	 , '__return_false' );
	add_filter( 'rocket_cache_dynamic_cookies'	 , '_rocket_add_aelia_tax_display_by_country_dynamic_cookies' );
endif;

// Add cookie when we activate the plugin
add_action( 'activate_woocommerce-tax-display-by-country/woocommerce-tax-display-by-country.php', '__rocket_activate_aelia_tax_display_by_country', 11 );
function __rocket_activate_aelia_tax_display_by_country() {
	add_filter( 'rocket_htaccess_mod_rewrite'	 , '__return_false' );
	add_filter( 'rocket_cache_dynamic_cookies'	 , '_rocket_add_aelia_tax_display_by_country_dynamic_cookies' );

	// Update the WP Rocket rules on the .htaccess file
	flush_rocket_htaccess();

	// Regenerate the config file
	rocket_generate_config_file();
}

// Remove cookies when we deactivate the plugin
add_action( 'deactivate_woocommerce-tax-display-by-country/woocommerce-tax-display-by-country.php', '__rocket_deactivate_aelia_tax_display_by_country', 11 );
function __rocket_deactivate_aelia_tax_display_by_country() {
	remove_filter( 'rocket_htaccess_mod_rewrite' , '__return_false' );
	remove_filter( 'rocket_cache_dynamic_cookies', '_rocket_add_aelia_tax_display_by_country_dynamic_cookies' );

	// Update the WP Rocket rules on the .htaccess file
	flush_rocket_htaccess();

	// Regenerate the config file
	rocket_generate_config_file();
}

// Add the Aelia Tax Display by Country cookies to generate caching files depending on their values
function _rocket_add_aelia_tax_display_by_country_dynamic_cookies( $cookies ) {
	$cookies[] = 'aelia_customer_country';
	$cookies[] = 'aelia_customer_state';
	$cookies[] = 'aelia_tax_exempt';

	return $cookies;
}