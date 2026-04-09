(function () {
  'use strict';

  if (typeof wa_ls_config === 'undefined') {
    return;
  }

  const STORAGE_KEY = wa_ls_config.storageKey || 'wa_ls_data';
  const FALLBACK_LABEL = wa_ls_config.fallbackLabel || 'N/D';

  function getParams() {
    const p = new URLSearchParams(window.location.search);
    return {
      utm_source: p.get('utm_source') || '',
      utm_medium: p.get('utm_medium') || '',
      utm_campaign: p.get('utm_campaign') || '',
      utm_content: p.get('utm_content') || '',
      utm_term: p.get('utm_term') || '',
      gclid: p.get('gclid') || '',
      gbraid: p.get('gbraid') || '',
      wbraid: p.get('wbraid') || '',
      fbclid: p.get('fbclid') || '',
      landing_page: window.location.href,
      captured_at: new Date().toISOString()
    };
  }

  function getStored() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
    } catch (e) {
      return {};
    }
  }

  function hasAttributionData(data) {
    return [
      data.utm_source,
      data.utm_medium,
      data.utm_campaign,
      data.utm_content,
      data.utm_term,
      data.gclid,
      data.gbraid,
      data.wbraid,
      data.fbclid
    ].some(Boolean);
  }

  function saveData(current) {
    const stored = getStored();

    if (!hasAttributionData(current)) {
      return stored;
    }

    const merged = Object.assign({}, stored, current);
    localStorage.setItem(STORAGE_KEY, JSON.stringify(merged));
    return merged;
  }

  function detectChannel(data) {
    const source = (data.utm_source || '').toLowerCase();
    const medium = (data.utm_medium || '').toLowerCase();

    if (source === 'google' && ['cpc', 'ppc', 'paid'].includes(medium)) {
      return 'Google Ads';
    }

    if ((source === 'facebook' || source === 'instagram') && ['cpc', 'ppc', 'paid', 'paid_social'].includes(medium)) {
      return 'Meta Ads';
    }

    if (data.gclid || data.gbraid || data.wbraid) {
      return 'Google Ads';
    }

    if (data.fbclid) {
      return 'Meta Ads';
    }

    if (source === 'google' && medium === 'organic') {
      return 'Orgánico';
    }

    if (medium === 'organic') {
      return 'Orgánico';
    }

    if (medium === 'referral') {
      return 'Referral';
    }

    return '';
  }

  function normalizeData(data) {
    return {
      channel: detectChannel(data) || '',
      utm_source: data.utm_source || FALLBACK_LABEL,
      utm_medium: data.utm_medium || FALLBACK_LABEL,
      utm_campaign: data.utm_campaign || FALLBACK_LABEL,
      utm_content: data.utm_content || FALLBACK_LABEL,
      utm_term: data.utm_term || FALLBACK_LABEL,
      gclid: data.gclid || FALLBACK_LABEL,
      gbraid: data.gbraid || FALLBACK_LABEL,
      wbraid: data.wbraid || FALLBACK_LABEL,
      fbclid: data.fbclid || FALLBACK_LABEL,
      landing_page: data.landing_page || window.location.href,
      captured_at: data.captured_at || new Date().toISOString()
    };
  }

  function buildMessage(template, rawData) {
    const raw = rawData || {};
    const data = normalizeData(raw);

    const replacements = {
      '{channel}': data.channel,
      '{utm_source}': data.utm_source,
      '{utm_medium}': data.utm_medium,
      '{utm_campaign}': data.utm_campaign,
      '{utm_content}': data.utm_content,
      '{utm_term}': data.utm_term,
      '{gclid}': data.gclid,
      '{gbraid}': data.gbraid,
      '{wbraid}': data.wbraid,
      '{fbclid}': data.fbclid,
      '{landing_page}': data.landing_page,
      '{captured_at}': data.captured_at
    };

    // Placeholders que dependen de datos capturados (vacíos = eliminar la línea)
    const hasData = {
      '{channel}': !!data.channel,
      '{utm_source}': !!raw.utm_source,
      '{utm_medium}': !!raw.utm_medium,
      '{utm_campaign}': !!raw.utm_campaign,
      '{utm_content}': !!raw.utm_content,
      '{utm_term}': !!raw.utm_term,
      '{gclid}': !!raw.gclid,
      '{gbraid}': !!raw.gbraid,
      '{wbraid}': !!raw.wbraid,
      '{fbclid}': !!raw.fbclid,
      '{landing_page}': true,
      '{captured_at}': true
    };

    let message = template || 'Hola, quiero más información.\n\n[canal:{channel}]';

    // Eliminar líneas cuyo placeholder no tenga datos
    var lines = message.split('\n');
    var filtered = [];
    var prevWasBlank = false;
    for (var i = 0; i < lines.length; i++) {
      var line = lines[i];
      var skip = false;
      for (var placeholder in hasData) {
        if (line.indexOf(placeholder) !== -1 && !hasData[placeholder]) {
          skip = true;
          break;
        }
      }
      if (skip) continue;
      // Colapsar líneas en blanco consecutivas
      var isBlank = line.trim() === '';
      if (isBlank && prevWasBlank) continue;
      filtered.push(line);
      prevWasBlank = isBlank;
    }
    // Eliminar línea en blanco final
    while (filtered.length && filtered[filtered.length - 1].trim() === '') {
      filtered.pop();
    }
    message = filtered.join('\n');

    // Reemplazar placeholders restantes
    Object.keys(replacements).forEach(function (placeholder) {
      message = message.split(placeholder).join(replacements[placeholder]);
    });

    return message;
  }

  function resolvePhone(button) {
    const dataPhone = button.getAttribute('data-wa-phone');
    if (dataPhone) {
      return String(dataPhone).replace(/\D+/g, '');
    }

    return String(wa_ls_config.phone || '').replace(/\D+/g, '');
  }

  function applyToButtons(data) {
    const selector = wa_ls_config.mode === 'shortcode'
      ? '.wa-ls-button'
      : (wa_ls_config.selector || '.js-whatsapp-track');
    let buttons = [];

    try {
      buttons = document.querySelectorAll(selector);
    } catch (e) {
      if (wa_ls_config.debug) {
        console.warn('WA Lead Source Tracker: selector inválido.', selector);
      }
      return;
    }

    if (!buttons.length) {
      return;
    }

    buttons.forEach(function (button) {
      const phone = resolvePhone(button);
      if (!phone) {
        return;
      }

      const message = buildMessage(wa_ls_config.template, data);
      const url = 'https://wa.me/' + encodeURIComponent(phone) + '?text=' + encodeURIComponent(message);
      button.setAttribute('href', url);
      button.setAttribute('target', '_blank');
      button.setAttribute('rel', 'noopener noreferrer');
    });
  }

  function init() {
    const current = getParams();
    const data = saveData(current);
    applyToButtons(data);

    if (wa_ls_config.debug) {
      console.log('WA Lead Source Tracker data:', data);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
