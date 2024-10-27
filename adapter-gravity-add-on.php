<?php
/**
 * Adapter Gravity Add-On
 *
 * @package AdapterGravityAddOn
 *
 * Plugin Name: Adapter Gravity Add-On
 * Plugin URI: https://github.com/kienstra/adapter-gravity-add-on
 * Description: Add-on for Gravity Forms, with an option to show a form at the end of every post. To use, click "Forms" in the left menu of your admin screen. Scroll over one of your forms, and click "Settings." Scroll down to "Form Options." You'll see a toggle "Display at the bottom of every post."
 * Version: 2.0.1
 * Requires at least: 6.4
 * Requires PHP: 8.0
 * Author: Ryan Kienstra
 * Author URI: https://ryankienstra.com
 * License: GPL2 v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: adapter-gravity-add-on
 * Domain Path: languages
 */

namespace AdapterGravityAddOn;

require_once __DIR__ . '/vendor/autoload.php';

( new Plugin(
	[ 'GFForms', 'include_addon_framework' ],
	[ 'GFAddOn', 'register' ]
) )->init();
