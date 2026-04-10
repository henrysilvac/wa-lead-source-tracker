<?php
/**
 * Plugin Name: WA Lead Source Tracker
 * Plugin URI: https://henry.silva.llc/
 * Description: Captura UTMs y click IDs, los persiste en el navegador y los inyecta dinámicamente en enlaces de WhatsApp.
 * Version: 0.5.4
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Henry Silva
 * License: GPLv2 or later
 * Text Domain: wa-lead-source-tracker
 */

if (!defined('ABSPATH')) {
    exit;
}

define('WA_LS_VERSION', '0.5.4');
define('WA_LS_PLUGIN_FILE', __FILE__);
define('WA_LS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WA_LS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WA_LS_OPTION_KEY', 'wa_ls_settings');

require_once WA_LS_PLUGIN_DIR . 'includes/class-wa-ls-settings.php';
require_once WA_LS_PLUGIN_DIR . 'includes/class-wa-ls-shortcode.php';
require_once WA_LS_PLUGIN_DIR . 'includes/class-wa-ls-plugin.php';

function wa_ls_activate() {
    $defaults = WA_LS_Settings::get_defaults();
    $existing = get_option(WA_LS_OPTION_KEY, []);
    if (!is_array($existing)) {
        $existing = [];
    }
    update_option(WA_LS_OPTION_KEY, wp_parse_args($existing, $defaults));
}
register_activation_hook(__FILE__, 'wa_ls_activate');

function wa_ls_boot_plugin() {
    $plugin = new WA_LS_Plugin();
    $plugin->init();
}
wa_ls_boot_plugin();
