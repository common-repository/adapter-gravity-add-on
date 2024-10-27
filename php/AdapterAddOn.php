<?php
/**
 * Main add-on file
 *
 * @package AdapterGravityAddOn
 */

namespace AdapterGravityAddOn;

use GFAddOn;

// phpcs:disable PSR2.Classes.PropertyDeclaration.Underscore

/**
 * Add-on class.
 *
 * Mainly follows the add-on conventions from the Gravity Forms documentation.
 * The properties in this override those defined in GFAddOn.
 * So their names are predetermined.
 *
 * @see https://docs.gravityforms.com/gfaddon
 */
class AdapterAddOn extends GFAddOn {
	public $_version                  = '2.0.1';
	public $_min_gravityforms_version = '2.8.0';
	public $_slug                     = 'adapter-gravity-add-on';
	public $_full_path                = __FILE__;

	public function __construct() {
		$this->_path        = $this->_slug . '/php/AdapterAddOn.php';
		$this->_title       = __( 'Adapter Gravity Add On', 'adapter-gravity-add-on' );
		$this->_short_title = __( 'Adapter Add On', 'adapter-gravity-add-on' );

		parent::__construct();
	}

	public static function get_instance(): AdapterAddOn {
		static $instance;

		if ( ! $instance ) {
			$instance = new AdapterAddOn();
		}

		return $instance;
	}

	public function init(): void {
		$email_setting = EmailSettingFactory::create();
		$email_setting->init();
		( EmailFormFactory::create( $email_setting ) )->init();

		parent::init();
	}
}
