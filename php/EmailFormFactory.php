<?php
/**
 * Email form factory.
 *
 * @package AdapterGravityAddOn
 */

namespace AdapterGravityAddOn;

use GFFormsModel;

/**
 * Creates an email form.
 */
class EmailFormFactory {
	public static function create( EmailSetting $email_setting ): EmailForm {
		return new EmailForm(
			$email_setting,
			GFFormsModel::get_forms(),
			[ 'GFAPI', 'get_form' ],
			'gravity_form'
		);
	}
}
