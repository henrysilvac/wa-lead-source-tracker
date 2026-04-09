<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap wa-ls-wrap">
    <h1><?php esc_html_e('WA Lead Source Tracker', 'wa-lead-source-tracker'); ?></h1>
    <p><?php esc_html_e('Starter kit MVP para capturar UTMs y añadir atribución al mensaje de WhatsApp.', 'wa-lead-source-tracker'); ?></p>

    <form method="post" action="options.php">
        <?php
        settings_fields('wa_ls_settings_group');
        do_settings_sections('wa-lead-source-tracker');
        submit_button(__('Guardar cambios', 'wa-lead-source-tracker'));
        ?>
    </form>

    <hr />

    <h2><?php esc_html_e('Implementación rápida', 'wa-lead-source-tracker'); ?></h2>
    <ol>
        <li><?php esc_html_e('Configura el número de WhatsApp y guarda.', 'wa-lead-source-tracker'); ?></li>
        <li><?php esc_html_e('Si usarás botones existentes, define el selector CSS.', 'wa-lead-source-tracker'); ?></li>
        <li><?php esc_html_e('Si usarás el shortcode, inserta [wa_lead_button] en cualquier página.', 'wa-lead-source-tracker'); ?></li>
        <li><?php esc_html_e('Prueba con una URL que incluya UTM, por ejemplo ?utm_source=google&utm_medium=cpc&utm_campaign=test', 'wa-lead-source-tracker'); ?></li>
    </ol>

    <h2><?php esc_html_e('Vista previa de placeholders', 'wa-lead-source-tracker'); ?></h2>
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
