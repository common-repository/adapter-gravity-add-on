<?php
/**
 * Plugin bootstrap file
 *
 * @package AdapterGravityAddOn
 */

namespace AdapterGravityAddOn;

/**
 * Registers this add-on via the Gravity Forms add-on framework.
 *
 * @see https://docs.gravityforms.com/gfaddon/
 */
class Plugin {
	private array $include_framework;
	private array $register_add_on;

	public function __construct( array $include_framework, array $register_add_on ) {
		$this->include_framework = $include_framework;
		$this->register_add_on   = $register_add_on;
	}

	/**
	 * Load this add-on with the Gravity Forms add-on hook.
	 */
	public function init(): void {
		add_action( 'gform_loaded', [ $this, 'register' ], 5 );
	}

	/**
	 * Register the add-on, using the strategy that Gravity Forms recommends.
	 *
	 * If the needed Gravity Forms method does not exist, display an admin error and return.
	 * Otherwise, require and register the main add-on file.
	 */
	public function register(): void {
		call_user_func( $this->include_framework );
		call_user_func( $this->register_add_on, __NAMESPACE__ . '\AdapterAddOn' );
	}
}
