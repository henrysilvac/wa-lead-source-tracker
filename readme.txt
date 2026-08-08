=== Capybara SEO Lead Source Tracker ===
Contributors: capybaraseo
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=paypal@ilmaistro.pe&currency_code=USD
Tags: whatsapp, utm, tracking, leads, attribution
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 0.6.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Author URI: https://seo.pe

Captures UTMs and click IDs and adds them to your WhatsApp messages via a floating button, existing buttons, or a shortcode.

== Description ==

=== English ===

Capybara SEO Lead Source Tracker captures UTM parameters and click IDs (gclid, gbraid, wbraid, fbclid) from the URL, stores them in localStorage (first-touch attribution), and automatically updates WhatsApp links with a dynamic message that includes the lead source data.

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

Capybara SEO Lead Source Tracker captura parámetros UTM y click IDs (gclid, gbraid, wbraid, fbclid) desde la URL, los guarda en localStorage (atribución first-touch) y actualiza automáticamente los enlaces de WhatsApp con un mensaje dinámico que incluye los datos de origen del lead.

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
3. Go to Settings > Capybara SEO Lead Source Tracker.
4. Set your WhatsApp number and message template.
5. Turn on "Floating button" for a ready-to-use button with no further setup, and/or turn on "CSS Selector" with the CSS class of an existing button to add tracking to it — both can be enabled together. The [wa_lead_button] shortcode is always available regardless of these toggles.
6. Test with a URL containing UTM parameters, e.g. ?utm_source=google&utm_medium=cpc&utm_campaign=test

=== Español ===

1. Sube el zip del plugin desde Plugins > Añadir nuevo > Subir plugin.
2. Activa el plugin.
3. Ve a Ajustes > Capybara SEO Lead Source Tracker.
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

= 0.6.2 =
**English:**
* Renamed the plugin again, from "Capybara SEO Lead Source Tracker for WhatsApp" to "Capybara SEO Lead Source Tracker" — WordPress.org's readme validator flagged "whatsapp" as a restricted term that cannot appear anywhere in the plugin name or permalink/slug (not just at the start). The word is still used freely in the description, FAQ, and tags, which aren't restricted. No functional changes; settings and stored data are preserved.

**Español:**
* Se volvió a renombrar el plugin, de "Capybara SEO Lead Source Tracker for WhatsApp" a "Capybara SEO Lead Source Tracker" — el validador de readme de WordPress.org marcó "whatsapp" como un término restringido que no puede aparecer en ninguna parte del nombre o el permalink/slug del plugin (no solo al inicio). La palabra se sigue usando libremente en la descripción, el FAQ y los tags, que no están restringidos. Sin cambios funcionales; se conservan los ajustes y los datos guardados.

= 0.6.1 =
**English:**
* Renamed the plugin from "WA Lead Source Tracker" to "Capybara SEO Lead Source Tracker for WhatsApp" — WordPress.org rejected the "WA" prefix as a restricted trademark-related term at the start of a plugin name/slug. No functional changes; settings and stored data are preserved.

**Español:**
* Se renombró el plugin de "WA Lead Source Tracker" a "Capybara SEO Lead Source Tracker for WhatsApp" — WordPress.org rechazó el prefijo "WA" por ser un término restringido relacionado con una marca registrada al inicio del nombre/slug del plugin. Sin cambios funcionales; se conservan los ajustes y los datos guardados.

= 0.6.0 =
**English:**
* Added a floating WhatsApp button that the plugin can auto-inject on every page (bottom-right, standard chat-bubble style), with no need for an existing button, link, or shortcode placement.
* Replaced the old single, mutually-exclusive "operation mode" with independent, combinable toggles: Floating button and CSS Selector can now be turned on at the same time (e.g. keep tracking your existing button and also show the floating button on pages that don't have one). The [wa_lead_button] shortcode is now always available regardless of these toggles. Existing sites are migrated automatically — no action needed.
* Reorganized the settings page into numbered sections (Enable & number, Where the button appears, Message, Advanced) with a plain-language guide explaining when to turn on each option.

**Español:**
* Se agregó un botón flotante de WhatsApp que el plugin puede auto-inyectar en cada página (esquina inferior derecha, estilo burbuja de chat estándar), sin necesidad de un botón, enlace o shortcode existente.
* Se reemplazó el antiguo "modo de operación" único y mutuamente excluyente por interruptores independientes y combinables: Botón flotante y Selector CSS ahora se pueden activar al mismo tiempo (por ejemplo, seguir rastreando tu botón existente y además mostrar el botón flotante en páginas que no lo tienen). El shortcode [wa_lead_button] ahora está siempre disponible sin importar estos interruptores. Los sitios existentes se migran automáticamente — no se requiere ninguna acción.
* Se reorganizó la página de ajustes en secciones numeradas (Activar y número, Dónde aparece el botón, Mensaje, Avanzado) con una guía en lenguaje sencillo que explica cuándo activar cada opción.

= 0.5.8 =
**English:**
* Added a settings link directly inside the plugin's description on the Plugins screen (in addition to the existing "Settings" row action), pointing to Settings > WA Lead Source Tracker.
* Plugin header Description is now sourced in English and translated to Spanish, consistent with the rest of the plugin's i18n strings.

**Español:**
* Se agregó un enlace de ajustes directamente dentro de la descripción del plugin en la pantalla de Plugins (además del enlace "Ajustes" existente en la fila), apuntando a Ajustes > WA Lead Source Tracker.
* La Descripción de la cabecera del plugin ahora tiene el inglés como idioma fuente y se traduce al español, en línea con el resto de las cadenas i18n del plugin.

= 0.5.7 =
**English:**
* Fix: regional Spanish site locales (es_PE, es_MX, es_AR, es_CO, etc.) fell back to English because the bundled translation only matched es_ES exactly. Any es_* locale now maps to the bundled es_ES translation.
* Fully translated the default WhatsApp message template into Spanish (source/medium/campaign/term labels were previously left in English).
* Added a "Settings" quick link to the plugin's row on the Plugins screen, pointing to Settings > WA Lead Source Tracker.

**Español:**
* Corrección: los locales regionales en español (es_PE, es_MX, es_AR, es_CO, etc.) caían de vuelta al inglés porque la traducción incluida solo coincidía exactamente con es_ES. Ahora cualquier locale es_* se mapea a la traducción es_ES incluida.
* Se tradujo por completo al español la plantilla de mensaje de WhatsApp por defecto (las etiquetas de source/medium/campaign/term antes quedaban en inglés).
* Se agregó un enlace rápido de "Ajustes" en la fila del plugin en la pantalla de Plugins, apuntando a Ajustes > WA Lead Source Tracker.

= 0.5.6 =
**English:**
* Fix: organic Google/Bing/Yahoo/DuckDuckGo/Baidu/Yandex/Ecosia search traffic without UTMs was misclassified as Referral instead of Organic. Search engine referrers are now detected and mapped to the Organic channel before the generic referral fallback.

**Español:**
* Corrección: el tráfico orgánico de buscadores (Google/Bing/Yahoo/DuckDuckGo/Baidu/Yandex/Ecosia) sin UTMs se clasificaba incorrectamente como Referral en vez de Orgánico. Ahora los referrers de buscadores se detectan y se mapean al canal Orgánico antes de aplicar el fallback genérico de Referral.

= 0.5.5 =
**English:**
* Added referral URL tracking via document.referrer: external referrers are captured and exposed via the {referrer} placeholder, and used as a fallback signal for Referral channel detection.

**Español:**
* Se agregó el rastreo de la URL de referencia mediante document.referrer: los referrers externos se capturan y se exponen mediante el placeholder {referrer}, y se usan como señal de respaldo para la detección del canal Referral.

= 0.5.4 =
**English:**
* Fix Joinchat integration: intercept click on document (capture phase) instead of updating data-settings DOM attribute, since Joinchat caches settings in memory on init.

**Español:**
* Corrección en la integración con Joinchat: se intercepta el click en document (fase de captura) en lugar de actualizar el atributo DOM data-settings, ya que Joinchat guarda los ajustes en memoria al inicializar.

= 0.5.3 =
**English:**
* Joinchat plugin compatibility: selector targeting .joinchat updates message_send inside data-settings JSON.

**Español:**
* Compatibilidad con el plugin Joinchat: el selector dirigido a .joinchat actualiza message_send dentro del JSON de data-settings.

= 0.5.2 =
**English:**
* Replaced emoji with WhatsApp bold markdown (*[...]*) to avoid encoding corruption across all devices and WP sanitization pipeline.

**Español:**
* Se reemplazaron los emojis por markdown en negrita de WhatsApp (*[...]*) para evitar corrupción de codificación en todos los dispositivos y en el proceso de sanitización de WP.

= 0.5.1 =
**English:**
* Replaced 📋 emoji with ⚠️ (better device support).

**Español:**
* Se reemplazó el emoji 📋 por ⚠️ (mejor soporte entre dispositivos).

= 0.5.0 =
**English:**
* Default message template now includes a framed reference block before tracking variables to discourage users from deleting attribution data.

**Español:**
* La plantilla de mensaje por defecto ahora incluye un bloque de referencia enmarcado antes de las variables de tracking, para desalentar que los usuarios borren los datos de atribución.

= 0.4.0 =
**English:**
* Added multilingual support: English and Spanish (auto-detected from WordPress site locale).
* English set as source language following WordPress i18n standards.
* Channel labels (Organic, Referral, etc.) are now translatable.
* Added languages/wa-lead-source-tracker-es_ES.po and compiled .mo file.

**Español:**
* Se agregó soporte multiidioma: inglés y español (detectado automáticamente según el locale del sitio WordPress).
* Se estableció el inglés como idioma fuente siguiendo los estándares i18n de WordPress.
* Las etiquetas de canal (Orgánico, Referral, etc.) ahora son traducibles.
* Se agregaron languages/wa-lead-source-tracker-es_ES.po y el archivo .mo compilado.

= 0.3.0 =
**English:**
* Fixed channel detection: gclid, gbraid, wbraid now correctly identify Google Ads without requiring UTM parameters.
* Removed "Directo / sin dato" fallback — channel line is now hidden when there is no attribution data.
* Lines with no captured data are filtered from the WhatsApp message.
* Consecutive blank lines collapsed after filtering.

**Español:**
* Se corrigió la detección de canal: gclid, gbraid, wbraid ahora identifican correctamente Google Ads sin requerir parámetros UTM.
* Se eliminó el fallback "Directo / sin dato" — la línea de canal ahora se oculta cuando no hay datos de atribución.
* Las líneas sin datos capturados se filtran del mensaje de WhatsApp.
* Las líneas en blanco consecutivas se colapsan después del filtrado.

= 0.2.0 =
**English:**
* Operation mode (CSS Selector vs Shortcode) now correctly controls which buttons are targeted.
* Shortcode mode targets only plugin-generated buttons (.wa-ls-button).

**Español:**
* El modo de operación (Selector CSS vs Shortcode) ahora controla correctamente qué botones se ven afectados.
* El modo Shortcode apunta únicamente a los botones generados por el plugin (.wa-ls-button).

= 0.1.0 =
**English:**
* Initial MVP release.

**Español:**
* Lanzamiento inicial MVP.
