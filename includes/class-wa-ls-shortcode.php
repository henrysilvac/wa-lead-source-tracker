<?php
if (!defined('ABSPATH')) {
    exit;
}

class WA_LS_Shortcode {
    public static function render($atts = []) {
        $settings = WA_LS_Settings::get_settings();

        $atts = shortcode_atts([
            'label' => __('Escríbenos por WhatsApp', 'wa-lead-source-tracker'),
            'phone' => $settings['phone'],
            'class' => 'js-whatsapp-track wa-ls-button',
        ], $atts, 'wa_lead_button');

        $classes = trim((string) $atts['class']);
        if ($classes === '') {
            $classes = 'js-whatsapp-track wa-ls-button';
        }

        $phone = preg_replace('/\D+/', '', (string) $atts['phone']);
        $fallback_href = 'https://wa.me/' . $phone;

        return sprintf(
            '<a href="%1$s" class="%2$s" data-wa-phone="%3$s">%4$s</a>',
            esc_url($fallback_href),
            esc_attr($classes),
            esc_attr($phone),
            esc_html($atts['label'])
        );
    }
}
