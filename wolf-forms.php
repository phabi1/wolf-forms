<?php

/**
 * Plugin Name:       Wolf Forms
 * Description:       A WordPress plugin to manage forms.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wolf-forms
 * Requires Plugins:  wolf-core
 *
 * @package WolfForms
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('WOLF_FORMS_PLUGIN_DIR', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';

$plugin = new Wolf\Forms\Plugin();
$plugin->bootstrap();