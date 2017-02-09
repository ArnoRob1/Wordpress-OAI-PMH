<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.univ-rennes2.fr/
 * @since      1.0.0
 *
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/public
 * @author     CREA - Université Rennes 2 <arnaud.robin@univ-rennes2.fr>
 */
class Wpoaipmh_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpoaipmh-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpoaipmh-public.js', array( 'jquery' ), $this->version, false );
	}

	/* Adds url pattern : /oai?request... */
	public function wpoai_rewrite_rule() {
		add_rewrite_rule('^oai/?([^/]*)', 'index.php?wpoaipmh=true&$matches[1]', 'top');
	}

	/* Adds some OAIPMH variables */
	/* wpoaipmh => to ideitify OAIPMH request */
	/* verb, identifier, metadataPrefix, from, until, set => OAIPMH variables */
	public function wpoai_vars() {
		add_rewrite_tag('%wpoaipmh%', '([^&]+)');
		add_rewrite_tag('%verb%', '([^&]+)');
		add_rewrite_tag('%identifier%', '([^&]+)');
		add_rewrite_tag('%metadataPrefix%', '([^&]+)');
		add_rewrite_tag('%from%', '([^&]+)');
		add_rewrite_tag('%until%', '([^&]+)');
		add_rewrite_tag('%set%', '([^&]+)');
		add_rewrite_tag('%resumptionToken%', '([^&]+)');
	}

	/* If the query contains 'wpoaipmh' as a variable, returns oaipage.php template */
	public function oai_template($template) {

		global $wp_query;

		if (isset($wp_query->query_vars['wpoaipmh'])) {
			return dirname(__FILE__) . '/oaipage.php';
		}
		return $template;
	}


}
