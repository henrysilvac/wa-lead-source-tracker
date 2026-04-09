<?php
if (!defined('ABSPATH')) {
    exit;
}

class WA_LS_Settings {
    public static function get_defaults() {
        return [
            'enabled' => 1,
            'phone' => '51999999999',
            'message_template' => __("Hi, I'd like more information.\n\n*[Do not modify — reference code to assign you the right advisor]:*\n[channel:{channel}]\n[source:{utm_source}]\n[medium:{utm_medium}]\n[campaign:{utm_campaign}]\n[term:{utm_term}]\n[gclid:{gclid}]", 'wa-lead-source-tracker'),
            'mode' => 'selector',
            'selector' => '.js-whatsapp-track',
            'debug' => 0,
        ];
    }

    public static function get_settings() {
        $saved = get_option(WA_LS_OPTION_KEY, []);
        if (!is_array($saved)) {
            $saved = [];
        }
        return wp_parse_args($saved, self::get_defaults());
    }

    public static function register_settings() {
        register_setting(
            'wa_ls_settings_group',
            WA_LS_OPTION_KEY,
            [
                'type' => 'array',
                'sanitize_callback' => [__CLASS__, 'sanitize_settings'],
                'default' => self::get_defaults(),
            ]
        );

        add_settings_section(
            'wa_ls_main_section',
            __('General Settings', 'wa-lead-source-tracker'),
            '__return_false',
            'wa-lead-source-tracker'
        );

        $fields = [
            'enabled'          => __('Enable plugin', 'wa-lead-source-tracker'),
            'phone'            => __('WhatsApp number', 'wa-lead-source-tracker'),
            'mode'             => __('Operation mode', 'wa-lead-source-tracker'),
            'selector'         => __('CSS selector', 'wa-lead-source-tracker'),
            'message_template' => __('Message template', 'wa-lead-source-tracker'),
            'debug'            => __('Debug mode', 'wa-lead-source-tracker'),
        ];

        foreach ($fields as $key => $label) {
            add_settings_field(
                'wa_ls_' . $key,
                $label,
                [__CLASS__, 'render_field'],
                'wa-lead-source-tracker',
                'wa_ls_main_section',
                ['key' => $key]
            );
        }
    }

    public static function sanitize_settings($input) {
        $defaults = self::get_defaults();
        $output = [];

        $output['enabled'] = !empty($input['enabled']) ? 1 : 0;
        $output['debug'] = !empty($input['debug']) ? 1 : 0;
        $output['phone'] = isset($input['phone']) ? preg_replace('/\D+/', '', (string) $input['phone']) : $defaults['phone'];

        $allowed_modes = ['selector', 'shortcode'];
        $mode = isset($input['mode']) ? sanitize_text_field((string) $input['mode']) : $defaults['mode'];
        $output['mode'] = in_array($mode, $allowed_modes, true) ? $mode : $defaults['mode'];

        $output['selector'] = isset($input['selector']) ? sanitize_text_field((string) $input['selector']) : $defaults['selector'];

        if (isset($input['message_template'])) {
            $message = wp_kses_post((string) $input['message_template']);
            $output['message_template'] = trim($message) !== '' ? $message : $defaults['message_template'];
        } else {
            $output['message_template'] = $defaults['message_template'];
        }

        return wp_parse_args($output, $defaults);
    }

    public static function render_field($args) {
        $settings = self::get_settings();
        $key = isset($args['key']) ? $args['key'] : '';

        switch ($key) {
            case 'enabled':
            case 'debug':
                ?>
                <label>
                    <input type="checkbox" name="<?php echo esc_attr(WA_LS_OPTION_KEY); ?>[<?php echo esc_attr($key); ?>]" value="1" <?php checked(!empty($settings[$key])); ?> />
                    <?php echo $key === 'enabled'
                        ? esc_html__('Enable frontend functionality.', 'wa-lead-source-tracker')
                        : esc_html__('Show data in browser console.', 'wa-lead-source-tracker'); ?>
                </label>
                <?php
                break;

            case 'phone':
                ?>
                <input type="text" class="regular-text" name="<?php echo esc_attr(WA_LS_OPTION_KEY); ?>[phone]" value="<?php echo esc_attr($settings['phone']); ?>" placeholder="51999999999" />
                <p class="description"><?php esc_html_e('Use international format without symbols or spaces.', 'wa-lead-source-tracker'); ?></p>
                <?php
                break;

            case 'mode':
                ?>
                <select name="<?php echo esc_attr(WA_LS_OPTION_KEY); ?>[mode]">
                    <option value="selector" <?php selected($settings['mode'], 'selector'); ?>><?php esc_html_e('CSS Selector', 'wa-lead-source-tracker'); ?></option>
                    <option value="shortcode" <?php selected($settings['mode'], 'shortcode'); ?>><?php esc_html_e('Plugin shortcode', 'wa-lead-source-tracker'); ?></option>
                </select>
                <p class="description"><?php esc_html_e('CSS Selector reuses existing buttons. Shortcode creates plugin buttons.', 'wa-lead-source-tracker'); ?></p>
                <?php
                break;

            case 'selector':
                ?>
                <input type="text" class="regular-text" name="<?php echo esc_attr(WA_LS_OPTION_KEY); ?>[selector]" value="<?php echo esc_attr($settings['selector']); ?>" placeholder=".js-whatsapp-track" />
                <p class="description"><?php esc_html_e('Example: .js-whatsapp-track or a[href*="wa.me"]', 'wa-lead-source-tracker'); ?></p>
                <?php
                break;

            case 'message_template':
                ?>
                <textarea name="<?php echo esc_attr(WA_LS_OPTION_KEY); ?>[message_template]" rows="8" class="large-text code"><?php echo esc_textarea($settings['message_template']); ?></textarea>
                <p class="description"><?php esc_html_e('Available placeholders: {channel}, {utm_source}, {utm_medium}, {utm_campaign}, {utm_content}, {utm_term}, {gclid}, {gbraid}, {wbraid}, {fbclid}, {landing_page}, {captured_at}', 'wa-lead-source-tracker'); ?></p>
                <?php
                break;
        }
    }
}
