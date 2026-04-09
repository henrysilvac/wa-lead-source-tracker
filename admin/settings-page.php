<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap wa-ls-wrap">
    <h1><?php echo esc_html('WA Lead Source Tracker'); ?></h1>
    <p><?php esc_html_e('Starter kit MVP for capturing UTMs and adding attribution to the WhatsApp message.', 'wa-lead-source-tracker'); ?></p>

    <form method="post" action="options.php">
        <?php
        settings_fields('wa_ls_settings_group');
        do_settings_sections('wa-lead-source-tracker');
        submit_button(__('Save changes', 'wa-lead-source-tracker'));
        ?>
    </form>

    <hr />

    <h2><?php esc_html_e('Quick setup', 'wa-lead-source-tracker'); ?></h2>
    <ol>
        <li><?php esc_html_e('Set your WhatsApp number and save.', 'wa-lead-source-tracker'); ?></li>
        <li><?php esc_html_e('If using existing buttons, define the CSS selector.', 'wa-lead-source-tracker'); ?></li>
        <li><?php esc_html_e('If using the shortcode, insert [wa_lead_button] on any page.', 'wa-lead-source-tracker'); ?></li>
        <li><?php esc_html_e('Test with a URL that includes UTM parameters, for example ?utm_source=google&utm_medium=cpc&utm_campaign=test', 'wa-lead-source-tracker'); ?></li>
    </ol>

    <h2><?php esc_html_e('Placeholder reference', 'wa-lead-source-tracker'); ?></h2>
    <div class="wa-ls-placeholders">
        <code>{channel}</code>
        <code>{utm_source}</code>
        <code>{utm_medium}</code>
        <code>{utm_campaign}</code>
        <code>{utm_content}</code>
        <code>{utm_term}</code>
        <code>{gclid}</code>
        <code>{gbraid}</code>
        <code>{wbraid}</code>
        <code>{fbclid}</code>
        <code>{landing_page}</code>
        <code>{captured_at}</code>
    </div>
</div>
