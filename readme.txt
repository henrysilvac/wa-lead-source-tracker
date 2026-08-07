=== WA Lead Source Tracker ===
Contributors: henrysilvac
Tags: whatsapp, utm, tracking, leads, attribution
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 0.6.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Author URI: https://henry.silva.llc/

Captures UTMs and click IDs and adds them to your WhatsApp messages via a floating button, existing buttons, or a shortcode.

== Description ==

=== English ===

WA Lead Source Tracker captures UTM parameters and click IDs (gclid, gbraid, wbraid, fbclid) from the URL, stores them in localStorage (first-touch attribution), and automatically updates WhatsApp links with a dynamic message that includes the lead source data.

**Key features:**

* Captures utm_source, utm_medium, utm_campaign, utm_content, utm_term, gclid, gbraid, wbraid, fbclid
* First-touch attribution: data is preserved across pages even if subsequent visits have no UTMs
* Automatic channel detection: Google Ads, Meta Ads, Organic, Referral
* Lines with no captured data are omitted from the WhatsApp message
* Combinable button placements: Floating button (auto-injected, zero setup) and CSS Selector (reuse existing buttons) can both be turned on at once, plus the always-available [wa_lead_button] shortcode — all sharing the same number and tracking
* Customizable message template with placeholders
* Multilingual: English and Spanish included. Language is set automatically based on the WordPress site locale.
* Debug mode: logs captured data to the browser console

**Available placeholders for the message template:**

{channel}, {utm_source}, {utm_medium}, {utm_campaign}, {utm_content}, {utm_term}, {gclid}, {gbraid}, {wbraid}, {fbclid}, {landing_page}, {captured_at}

---

=== Español ===

WA Lead Source Tracker captura parámetros UTM y click IDs (gclid, gbraid, wbraid, fbclid) desde la URL, los guarda en localStorage (atribución first-touch) y actualiza automáticamente los enlaces de WhatsApp con un mensaje dinámico que incluye los datos de origen del lead.

**Características principales:**

* Captura utm_source, utm_medium, utm_campaign, utm_content, utm_term, gclid, gbraid, wbraid, fbclid
* Atribución first-touch: los datos se conservan entre páginas aunque visitas posteriores no traigan UTMs
* Detección automática de canal: Google Ads, Meta Ads, Orgánico, Referral
* Las líneas sin datos capturados se omiten del mensaje de WhatsApp
* Ubicaciones combinables del botón: Botón flotante (auto-inyectado, sin configuración adicional) y Selector CSS (reutiliza botones existentes) se pueden activar al mismo tiempo, además del shortcode [wa_lead_button] siempre disponible — todos comparten el mismo número y tracking
* Plantilla de mensaje personalizable con placeholders
* Multiidioma: incluye inglés y español. El idioma se establece automáticamente según el locale de la instalación de WordPress.
* Modo debug: registra los datos capturados en la consola del navegador

**Placeholders disponibles para la plantilla de mensaje:**

{channel}, {utm_source}, {utm_medium}, {utm_campaign}, {utm_content}, {utm_term}, {gclid}, {gbraid}, {wbraid}, {fbclid}, {landing_page}, {captured_at}

== Installation ==

=== English ===

1. Upload the plugin zip from Plugins > Add New > Upload Plugin.
2. Activate the plugin.
3. Go to Settings > WA Lead Source Tracker.
4. Set your WhatsApp number and message template.
5. Turn on "Floating button" for a ready-to-use button with no further setup, and/or turn on "CSS Selector" with the CSS class of an existing button to add tracking to it — both can be enabled together. The [wa_lead_button] shortcode is always available regardless of these toggles.
6. Test with a URL containing UTM parameters, e.g. ?utm_source=google&utm_medium=cpc&utm_campaign=test

=== Español ===

1. Sube el zip del plugin desde Plugins > Añadir nuevo > Subir plugin.
2. Activa el plugin.
3. Ve a Ajustes > WA Lead Source Tracker.
4. Configura número de WhatsApp y plantilla de mensaje.
5. Activa "Botón flotante" para un botón listo para usar sin configuración adicional, y/o activa "Selector CSS" con la clase CSS de un botón existente para agregarle tracking — ambos se pueden activar a la vez. El shortcode [wa_lead_button] siempre está disponible sin importar estos interruptores.
6. Prueba con una URL que incluya UTMs, por ejemplo ?utm_source=google&utm_medium=cpc&utm_campaign=test

== Frequently Asked Questions ==

= Does it work with any WhatsApp button? / ¿Funciona con cualquier botón de WhatsApp? =

English: Yes. Enable "CSS Selector" and set the selector to match your existing buttons (e.g. a[href*="wa.me"]) and the plugin will update their href automatically. This can be combined with the floating button at the same time.

Español: Sí. Activa "Selector CSS" y define el selector para que coincida con tus botones existentes (p. ej. a[href*="wa.me"]) y el plugin actualizará su href automáticamente. Esto se puede combinar con el botón flotante al mismo tiempo.

= What is first-touch attribution? / ¿Qué es la atribución first-touch? =

English: The first UTM parameters captured during a user's session are stored and kept even if the user navigates to other pages without UTMs. This way, the original traffic source is always preserved in the WhatsApp message.

Español: Los primeros parámetros UTM capturados durante la sesión del usuario se guardan y se conservan aunque navegue a otras páginas sin UTMs. Así, el origen del tráfico original siempre se incluye en el mensaje de WhatsApp.

= What happens if a field has no data? / ¿Qué pasa si un campo no tiene datos? =

English: Lines in the message template whose placeholder has no captured value are automatically removed from the WhatsApp message.

Español: Las líneas de la plantilla cuyo placeholder no tenga valor capturado se eliminan automáticamente del mensaje de WhatsApp.

== Changelog ==

= 0.6.0 =
* Added a floating WhatsApp button that the plugin can auto-inject on every page (bottom-right, standard chat-bubble style), with no need for an existing button, link, or shortcode placement.
* Replaced the old single, mutually-exclusive "operation mode" with independent, combinable toggles: Floating button and CSS Selector can now be turned on at the same time (e.g. keep tracking your existing button and also show the floating button on pages that don't have one). The [wa_lead_button] shortcode is now always available regardless of these toggles. Existing sites are migrated automatically — no action needed.
* Reorganized the settings page into numbered sections (Enable & number, Where the button appears, Message, Advanced) with a plain-language guide explaining when to turn on each option.

= 0.5.8 =
* Added a settings link directly inside the plugin's description on the Plugins screen (in addition to the existing "Settings" row action), pointing to Settings > WA Lead Source Tracker.
* Plugin header Description is now sourced in English and translated to Spanish, consistent with the rest of the plugin's i18n strings.

= 0.5.7 =
* Fix: regional Spanish site locales (es_PE, es_MX, es_AR, es_CO, etc.) fell back to English because the bundled translation only matched es_ES exactly. Any es_* locale now maps to the bundled es_ES translation.
* Fully translated the default WhatsApp message template into Spanish (source/medium/campaign/term labels were previously left in English).
* Added a "Settings" quick link to the plugin's row on the Plugins screen, pointing to Settings > WA Lead Source Tracker.

= 0.5.6 =
* Fix: organic Google/Bing/Yahoo/DuckDuckGo/Baidu/Yandex/Ecosia search traffic without UTMs was misclassified as Referral instead of Organic. Search engine referrers are now detected and mapped to the Organic channel before the generic referral fallback.

= 0.5.5 =
* Added referral URL tracking via document.referrer: external referrers are captured and exposed via the {referrer} placeholder, and used as a fallback signal for Referral channel detection.

= 0.5.4 =
* Fix Joinchat integration: intercept click on document (capture phase) instead of updating data-settings DOM attribute, since Joinchat caches settings in memory on init.

= 0.5.3 =
* Joinchat plugin compatibility: selector targeting .joinchat updates message_send inside data-settings JSON.

= 0.5.2 =
* Replaced emoji with WhatsApp bold markdown (*[...]*) to avoid encoding corruption across all devices and WP sanitization pipeline.

= 0.5.1 =
* Replaced 📋 emoji with ⚠️ (better device support).

= 0.5.0 =
* Default message template now includes a framed reference block before tracking variables to discourage users from deleting attribution data.

= 0.4.0 =
* Added multilingual support: English and Spanish (auto-detected from WordPress site locale).
* English set as source language following WordPress i18n standards.
* Channel labels (Organic, Referral, etc.) are now translatable.
* Added languages/wa-lead-source-tracker-es_ES.po and compiled .mo file.

= 0.3.0 =
* Fixed channel detection: gclid, gbraid, wbraid now correctly identify Google Ads without requiring UTM parameters.
* Removed "Directo / sin dato" fallback — channel line is now hidden when there is no attribution data.
* Lines with no captured data are filtered from the WhatsApp message.
* Consecutive blank lines collapsed after filtering.

= 0.2.0 =
* Operation mode (CSS Selector vs Shortcode) now correctly controls which buttons are targeted.
* Shortcode mode targets only plugin-generated buttons (.wa-ls-button).

= 0.1.0 =
* Initial MVP release.
