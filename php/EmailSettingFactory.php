<?php
/**
 * Email setting factory
 *
 * @package AdapterGravityAddOn
 */

namespace AdapterGravityAddOn;

/**
 * Creates an email setting.
 */
class EmailSettingFactory {
	public static function create(): EmailSetting {
		return new EmailSetting();
	}
}
