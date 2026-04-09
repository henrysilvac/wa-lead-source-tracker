document.addEventListener('DOMContentLoaded', function () {
  const textarea = document.querySelector('textarea[name="wa_ls_settings[message_template]"]');
  if (!textarea) return;

  textarea.addEventListener('focus', function () {
    textarea.style.minHeight = '180px';
  });
});
