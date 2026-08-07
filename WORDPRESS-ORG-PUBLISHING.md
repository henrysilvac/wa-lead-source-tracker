# Publishing WA Lead Source Tracker to the official WordPress.org plugin repository

Reference guide to pick up in a future session. This is a manual process that requires
a personal wordpress.org account — nothing here can be automated by an assistant.

## 0. Pre-flight checklist (plugin-specific)

Before packaging, check/fix these:

- [ ] **`Tested up to:` in `readme.txt`** — bump to the current stable WordPress version
      (was last set to `6.8`; check the real latest version before submitting).
- [ ] **`Contributors:` in `readme.txt`** — must exactly match your wordpress.org
      username (currently `henrysilvac`). Create/verify the account uses this exact
      username, or update the readme to match.
- [ ] **Trademark ("WhatsApp")** — the plugin name ("WA Lead Source Tracker") doesn't
      use "WhatsApp" in full, which is good. Keep descriptions factual/descriptive,
      avoid anything implying official affiliation with WhatsApp/Meta.
- [ ] **No external calls** — confirmed clean: the plugin only uses `localStorage` and
      `wa.me` links, no phone-home, no bundled analytics. This simplifies review a lot.
- [ ] Run the readme through the official validator:
      https://wordpress.org/plugins/developers/readme-validator/
- [ ] Decide on a `== Screenshots ==` section (optional) — needs matching
      `screenshot-1.png`, `screenshot-2.png`, etc. in the SVN `assets/` folder later.

## 1. Account & prerequisites

1. Create an account at https://wordpress.org/ if you don't have one (same account
   used for forums, SVN, and the plugin developer dashboard).
2. Enable **two-factor authentication (2FA)** on that account — required since 2024
   to get SVN commit access once approved.
3. Read the official review checklist:
   https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/

## 2. Package the plugin

1. Validate `readme.txt` (see link above).
2. Zip the plugin folder, excluding dev-only files:
   ```bash
   cd /Users/henrysilvacastillo/Webs
   zip -r wa-lead-source-tracker.zip wa-lead-source-tracker \
     -x "*.git*" "*.DS_Store" "*.docx" "*.code-workspace"
   ```
   Do **not** include `.git`, `.gitignore`, `.DS_Store`, the spec `.docx`, or the
   `.code-workspace` file in the public ZIP.

## 3. Submit for review

1. Go to https://wordpress.org/plugins/developers/add/ (logged in).
2. Upload the ZIP and fill in the description of what the plugin does and why it's useful.
3. Submit. You'll get a confirmation email that it's in the review queue.

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
# 1. Checkout the empty repo you were assigned
svn co https://plugins.svn.wordpress.org/wa-lead-source-tracker wa-ls-svn
cd wa-ls-svn

# 2. Copy the real plugin files into trunk/
cp -R /Users/henrysilvacastillo/Webs/wa-lead-source-tracker/* trunk/

# 3. Add the new files to SVN
svn add trunk/* --force

# 4. Commit to trunk (this alone does NOT publish a version yet)
svn ci -m "Initial commit v0.6.0" --username your-wp-username

# 5. Tag the stable version — THIS is what actually publishes it
svn cp trunk tags/0.6.0
svn ci -m "Tagging version 0.6.0" --username your-wp-username
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
