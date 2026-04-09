=== WA Lead Source Tracker ===
Contributors: henrysilvac
Tags: whatsapp, utm, tracking, leads, attribution
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 0.5.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Author URI: https://henry.silva.llc/

Captures UTMs and click IDs, persists them in the browser, and dynamically injects them into WhatsApp links.

== Description ==

=== English ===

WA Lead Source Tracker captures UTM parameters and click IDs (gclid, gbraid, wbraid, fbclid) from the URL, stores them in localStorage (first-touch attribution), and automatically updates WhatsApp links with a dynamic message that includes the lead source data.

**Key features:**

* Captures utm_source, utm_medium, utm_campaign, utm_content, utm_term, gclid, gbraid, wbraid, fbclid
* First-touch attribution: data is preserved across pages even if subsequent visits have no UTMs
* Automatic channel detection: Google Ads, Meta Ads, Organic, Referral
* Lines with no captured data are omitted from the WhatsApp message
* Two operation modes: CSS Selector (reuse existing buttons) or Shortcode (plugin-generated buttons)
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
* Dos modos de funcionamiento: Selector CSS (reutiliza botones existentes) o Shortcode (botones generados por el plugin)
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
4. Set your WhatsApp number, operation mode, CSS selector, and message template.
5. Use the [wa_lead_button] shortcode or apply the configured CSS class to existing buttons.
6. Test with a URL containing UTM parameters, e.g. ?utm_source=google&utm_medium=cpc&utm_campaign=test

=== Español ===

1. Sube el zip del plugin desde Plugins > Añadir nuevo > Subir plugin.
2. Activa el plugin.
3. Ve a Ajustes > WA Lead Source Tracker.
4. Configura número de WhatsApp, modo de funcionamiento, selector CSS y plantilla de mensaje.
5. Usa el shortcode [wa_lead_button] o aplica la clase CSS configurada a botones existentes.
6. Prueba con una URL que incluya UTMs, por ejemplo ?utm_source=google&utm_medium=cpc&utm_campaign=test

== Frequently Asked Questions ==

= Does it work with any WhatsApp button? / ¿Funciona con cualquier botón de WhatsApp? =

English: Yes. In CSS Selector mode, set the selector to match your existing buttons (e.g. a[href*="wa.me"]) and the plugin will update their href automatically.

Español: Sí. En modo Selector CSS, define el selector para que coincida con tus botones existentes (p. ej. a[href*="wa.me"]) y el plugin actualizará su href automáticamente.

= What is first-touch attribution? / ¿Qué es la atribución first-touch? =

English: The first UTM parameters captured during a user's session are stored and kept even if the user navigates to other pages without UTMs. This way, the original traffic source is always preserved in the WhatsApp message.

Español: Los primeros parámetros UTM capturados durante la sesión del usuario se guardan y se conservan aunque navegue a otras páginas sin UTMs. Así, el origen del tráfico original siempre se incluye en el mensaje de WhatsApp.

= What happens if a field has no data? / ¿Qué pasa si un campo no tiene datos? =

English: Lines in the message template whose placeholder has no captured value are automatically removed from the WhatsApp message.

Español: Las líneas de la plantilla cuyo placeholder no tenga valor capturado se eliminan automáticamente del mensaje de WhatsApp.

== Changelog ==

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
