<?php
if (!defined('ABSPATH')) {
    exit;
}

class WA_LS_Plugin {
    public function init() {
        add_action('plugins_loaded', [$this, 'load_textdomain']);
        add_action('admin_menu', [$this, 'register_admin_menu']);
        add_action('admin_init', ['WA_LS_Settings', 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_public_assets']);
        add_action('admin_notices', [$this, 'render_admin_notice']);
        add_shortcode('wa_lead_button', ['WA_LS_Shortcode', 'render']);
    }

    public function load_textdomain() {
        load_plugin_textdomain(
            'wa-lead-source-tracker',
            false,
            dirname(plugin_basename(WA_LS_PLUGIN_FILE)) . '/languages'
        );
    }

    public function register_admin_menu() {
        add_options_page(
            'WA Lead Source Tracker',
            'WA Lead Source Tracker',
            'manage_options',
            'wa-lead-source-tracker',
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        $settings = WA_LS_Settings::get_settings();
        include WA_LS_PLUGIN_DIR . 'admin/settings-page.php';
    }

    public function enqueue_admin_assets($hook) {
        if ($hook !== 'settings_page_wa-lead-source-tracker') {
            return;
        }

        wp_enqueue_style(
            'wa-ls-admin',
            WA_LS_PLUGIN_URL . 'admin/admin.css',
            [],
            WA_LS_VERSION
        );

        wp_enqueue_script(
            'wa-ls-admin',
            WA_LS_PLUGIN_URL . 'admin/admin.js',
            [],
            WA_LS_VERSION,
            true
        );
    }

    public function enqueue_public_assets() {
        $settings = WA_LS_Settings::get_settings();
        if (empty($settings['enabled'])) {
            return;
        }

        wp_enqueue_style(
            'wa-ls-public',
            WA_LS_PLUGIN_URL . 'public/public.css',
            [],
            WA_LS_VERSION
        );

        wp_enqueue_script(
            'wa-ls-public',
            WA_LS_PLUGIN_URL . 'public/public.js',
            [],
            WA_LS_VERSION,
            true
        );

        wp_localize_script('wa-ls-public', 'wa_ls_config', [
            'phone' => isset($settings['phone']) ? (string) $settings['phone'] : '',
            'template' => isset($settings['message_template']) ? (string) $settings['message_template'] : '',
            'selector' => isset($settings['selector']) ? (string) $settings['selector'] : '.js-whatsapp-track',
            'mode' => isset($settings['mode']) ? (string) $settings['mode'] : 'selector',
            'debug' => !empty($settings['debug']),
            'storageKey' => 'wa_ls_data',
            'siteUrl' => home_url('/'),
            'fallbackLabel' => __('N/A', 'wa-lead-source-tracker'),
            'channels' => [
                'google_ads' => __('Google Ads', 'wa-lead-source-tracker'),
                'meta_ads'   => __('Meta Ads', 'wa-lead-source-tracker'),
                'organic'    => __('Organic', 'wa-lead-source-tracker'),
                'referral'   => __('Referral', 'wa-lead-source-tracker'),
            ],
        ]);
    }

    public function render_admin_notice() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $screen = get_current_screen();
        if (!$screen || $screen->id !== 'settings_page_wa-lead-source-tracker') {
            return;
        }

        echo '<div class="notice notice-info"><p>';
        echo esc_html__('Starter kit installed. Use the [wa_lead_button] shortcode or define a CSS selector to reuse existing buttons.', 'wa-lead-source-tracker');
        echo '</p></div>';
    }
}
