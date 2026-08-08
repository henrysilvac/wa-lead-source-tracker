# Publishing Capybara SEO Lead Source Tracker to the official WordPress.org plugin repository

Reference guide to pick up in a future session. This is a manual process that requires
a personal wordpress.org account — nothing here can be automated by an assistant.

Plugin slug: `capybara-seo-lead-source-tracker`
(local dev folder is still named `wa-lead-source-tracker` — that's fine, only the ZIP's
internal root folder name and the readme/header need to match the slug.)

## 0. Pre-flight checklist (plugin-specific)

Before packaging, check/fix these:

- [x] **`Tested up to:` in `readme.txt`** — set to `7.0` (verify against the real
      latest stable WordPress version before submitting again if time has passed).
- [x] **`Contributors:` in `readme.txt`** — matches wordpress.org username `capybaraseo`.
- [x] **Trademark-restricted terms in the plugin name/slug** — rejected **twice** on
      this front, in two different ways:
      1. First rejection: the name/slug can't **start with** the term "wa" (used as
         a WhatsApp-adjacent abbreviation), even though "WhatsApp" itself could still
         appear elsewhere in the name at that point.
      2. Second rejection (via the readme validator): "whatsapp" can't appear **at
         all** — anywhere — in the display name or permalink/slug, not just at the
         start. It can still be used freely in the description, FAQ, and tags, which
         aren't restricted.
      Final result after both fixes:
      - Display name: `WA Lead Source Tracker` → `Capybara SEO Lead Source Tracker`
        (went through an intermediate `Capybara SEO Lead Source Tracker for WhatsApp`
        that also had to be dropped)
      - Slug: `wa-lead-source-tracker` → `capybara-seo-lead-source-tracker`
      - Main file, Text Domain, and language files renamed to match. Internal PHP
        prefixes (`WA_LS_*` constants/classes, `wa_ls_settings` option key, the
        `wa-lead-source-tracker` **admin menu slug** used internally by
        `add_options_page()`/`do_settings_sections()`) were intentionally left
        unchanged — those aren't reviewed by WordPress.org and renaming them added
        no value, only risk of breaking something.
      - **Lesson for next time:** before submitting, run the name/slug past the
        readme validator (step below) and assume any WhatsApp-related term —
        abbreviated or spelled out, at the start or anywhere else — needs to stay
        out of the display name and slug entirely. Keep it in the description/FAQ
        instead.
- [x] **No external calls** — confirmed clean: the plugin only uses `localStorage` and
      `wa.me` links, no phone-home, no bundled analytics. This simplifies review a lot.
- [x] Run the readme through the official validator:
      https://wordpress.org/plugins/developers/readme-validator/
      (caught the "whatsapp" issue above). It also flags these as informational —
      not blockers, safe to ignore unless you want them:
      - No `== Upgrade Notice ==` section (optional; only shown to users updating
        from an older version, in addition to the changelog)
      - No `== Screenshots ==` section (optional — decided against for now, see below)
- [x] **Donate link** — added, using the classic PayPal button URL format
      (`business=` param set to the PayPal email `paypal@ilmaistro.pe`).
- [ ] Decide on a `== Screenshots ==` section (optional) — needs matching
      `screenshot-1.png`, `screenshot-2.png`, etc. in the SVN `assets/` folder later.

## 1. Account & prerequisites

1. Create an account at https://wordpress.org/ if you don't have one (same account
   used for forums, SVN, and the plugin developer dashboard). Done — username `capybaraseo`.
2. Enable **two-factor authentication (2FA)** on that account — required since 2024
   to get SVN commit access once approved.
3. Read the official review checklist:
   https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/

## 2. Package the plugin

1. Validate `readme.txt` (see link above).
2. Zip the plugin folder with the root directory renamed to the plugin **slug**
   (not the local dev folder name), excluding dev-only files:
   ```bash
   cd /Users/henrysilvacastillo/Webs
   rm -rf /tmp/capybara-seo-lead-source-tracker
   rsync -a wa-lead-source-tracker/ /tmp/capybara-seo-lead-source-tracker/ \
     --exclude ".git*" --exclude ".DS_Store" --exclude "*.docx" \
     --exclude "*.code-workspace" --exclude "WORDPRESS-ORG-PUBLISHING.md"
   cd /tmp
   zip -r capybara-seo-lead-source-tracker.zip capybara-seo-lead-source-tracker
   mv capybara-seo-lead-source-tracker.zip /Users/henrysilvacastillo/Webs/
   ```
   Do **not** include `.git`, `.gitignore`, `.DS_Store`, the spec `.docx`, the
   `.code-workspace` file, or this guide in the public ZIP. The ZIP's top-level
   folder name should be the slug, not `wa-lead-source-tracker`.

## 3. Submit for review

1. Go to https://wordpress.org/plugins/developers/add/ (logged in).
2. Upload the ZIP and fill in the description of what the plugin does and why it's useful.
3. Submit. You'll get a confirmation email that it's in the review queue.
4. If rejected for a naming/trademark reason again, see the pre-flight checklist note
   above — same fix pattern applies (and try the readme validator first next time).

**Status: submitted 2026-08-08.** Slug `capybara-seo-lead-source-tracker`, version 0.6.2,
"Awaiting Review". Only one plugin can be in the queue per account at a time — don't
resubmit until this one is reviewed (approved, rejected, or you're asked for changes).

- The developer dashboard also offers **"Check with Plugin Check"** — WordPress.org's
  automated linter (the same `Plugin Check` plugin available on wordpress.org, run
  server-side against the uploaded ZIP). It's optional but recommended: it flags
  things like missing sanitization/escaping, inline styles/scripts, deprecated
  functions, etc. *before* a human reviewer gets to it — fixing issues it finds
  and re-uploading tends to shorten the wait. Not run yet for this submission.
- Review email arrives at henry@seo.pe with the subject
  `[WordPress Plugin Directory] Review in Progress: Capybara SEO Lead Source Tracker`
  — check spam, and consider allow-listing `plugins@wordpress.org`.

## 4. Review wait

- Turnaround varies from days to **several weeks** — there's no way to speed it up.
- Expect an automated scan plus a manual code review (sanitization, escaping, nonces,
  etc.). This plugin already uses the WP Settings API (`settings_fields()` handles
  nonces automatically), which helps.
- It's normal to get an email asking for **specific changes** before approval. Fix,
  reply or re-upload the corrected ZIP as instructed, and it goes back into review.
- On approval, you receive SVN repository access via email.

## 5. Publish via SVN (once approved)

WordPress.org uses **Subversion**, not git, for the official repo. Install svn if needed:
`brew install subversion`.

```bash
# 1. Checkout the empty repo you were assigned (slug in the URL)
svn co https://plugins.svn.wordpress.org/capybara-seo-lead-source-tracker capybara-svn
cd capybara-svn

# 2. Copy the real plugin files into trunk/ (use the packaged folder, not the raw dev folder,
#    so trunk/ has the renamed main file etc.)
cp -R /tmp/capybara-seo-lead-source-tracker/* trunk/

# 3. Add the new files to SVN
svn add trunk/* --force

# 4. Commit to trunk (this alone does NOT publish a version yet)
svn ci -m "Initial commit v0.6.2" --username capybaraseo

# 5. Tag the stable version — THIS is what actually publishes it
svn cp trunk tags/0.6.2
svn ci -m "Tagging version 0.6.2" --username capybaraseo
```

- `Stable tag:` in `readme.txt` must exactly match the `tags/x.x.x` folder you create
  in SVN — that's what WordPress.org uses to decide which version to serve/install.
- The plugin shows up in the public directory ~15 minutes to a few hours after the
  first commit to `tags/`.

## 6. Visual assets (optional but recommended)

Live in a separate `assets/` folder at the SVN root (not inside `trunk/` — doesn't
affect the installed plugin version):

- `icon-128x128.png` and `icon-256x256.png` (square icon)
- `banner-772x250.png` and `banner-1544x500.png` (plugin page banner)
- `screenshot-1.png`, `screenshot-2.png`, ... (referenced from `readme.txt` under
  `== Screenshots ==`)

## 7. Future updates

For every new release: push changes to `trunk/`, bump `Stable tag:` in `readme.txt`,
then `svn cp trunk tags/x.x.x` and commit. The GitHub repo stays the dev/backup copy;
SVN is only the mirror WordPress.org reads to publish.
