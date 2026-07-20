# Connect superrollforming.com (Hostinger WordPress) to your Google account

Goal: link the site to Google **Search Console** (search performance + indexing) and **Google
Analytics 4** (traffic), using your Google account — the data that powers Google's reports *and*
OpenSEO's `get_search_console_performance` workflow.

## Current state (checked live on this site)

| Service | Status | Action |
| ------- | ------ | ------ |
| **Search Console verification** | ✅ Already verified — a `google-site-verification` meta tag is present on the homepage (token `8dMcKp3…`). | Confirm which Google account owns it; submit the sitemap (below). **Do not add a second verification tag.** |
| **Google Analytics 4** | ❌ Not connected — no GA4/gtag found on the site. | Set up GA4 and add the tag (below). |
| **Google Site Kit plugin** | ❌ Not installed. | Optional but recommended — unifies both under one Google login. |

> Because a verification tag already exists, the site is tied to *some* Google account. If you have
> access to that Search Console property, use it. If you don't know which account it is, you can add
> your own as an additional verified owner (Site Kit or a fresh property will do this).

---

## Recommended path — Google Site Kit (one Google login for everything)

Site Kit is Google's official WordPress plugin. It connects **Search Console + Analytics +
PageSpeed** to your Google account and is the cleanest "connect Hostinger WordPress with Google."

1. **WP Admin → Plugins → Add New** → search **"Site Kit by Google"** (by Google) → **Install → Activate**.
2. **Site Kit → Start Setup** → **Sign in with Google** → pick your Google account → grant access.
3. It auto-detects the existing Search Console verification and links the property.
4. When prompted, **Set up Google Analytics** → create/choose a **GA4 property** → Site Kit injects the tag for you.
   - If you do this, **leave `ga4_measurement_id` blank** in the mu-plugin (section 0) so you don't get two GA4 tags / double-counted views.
5. Done — the Site Kit dashboard shows Search + Analytics inside WP Admin.

> Hostinger note: if you use **LiteSpeed Cache**, purge it after setup (LiteSpeed Cache → Purge All) so the new tags are served, and exclude admin from caching (default).

---

## Manual path (no Site Kit) — using the mu-plugin

The `super-seo-enhancements.php` mu-plugin has a Google section (section 0 config). Use this if you
prefer not to install Site Kit.

### A. Google Analytics 4 (the missing piece)
1. Go to **analytics.google.com** with your Google account → **Admin → Create Property** → set up a **GA4** property for `superrollforming.com`.
2. **Admin → Data Streams → Web →** add `https://superrollforming.com` → copy the **Measurement ID** (`G-XXXXXXXXXX`).
3. In `wordpress/mu-plugins/super-seo-enhancements.php`, set:
   ```php
   'ga4_measurement_id' => 'G-XXXXXXXXXX',
   ```
4. Save/upload the file, purge LiteSpeed cache. The plugin outputs the GA4 tag site-wide and
   **excludes logged-in editors/admins** so your own visits don't skew the numbers.
5. Verify in GA4 **Realtime** — open the site in a private window and watch your visit appear.

### B. Search Console (already verified — just confirm + submit sitemap)
1. **search.google.com/search-console** → open the `superrollforming.com` property (or add it if it's not under your account).
2. If you need to (re)verify under **your** account and want to use the meta-tag method:
   - Get your token from GSC → *HTML tag* method (the `content="…"` value).
   - Set `'google_site_verification' => 'YOUR_TOKEN'` in the mu-plugin **only if the existing tag is not yours** — otherwise skip to avoid two tags.
   - Alternative that avoids touching code: **DNS TXT** in Hostinger — hPanel → **Domains → DNS / Nameservers**, add the TXT record GSC gives you.
3. **Search Console → Sitemaps →** submit `https://superrollforming.com/sitemap_index.xml`.
4. **Search Console → Settings → Users and permissions** → add any teammate's Google account.

### C. Bing (optional, quick win)
Set `'bing_site_verification' => 'TOKEN'` in the mu-plugin (from **bing.com/webmasters**), submit the same sitemap. Bing also feeds ChatGPT/Copilot search.

---

## After connecting — feed the SEO workflow
- Link **GA4 ↔ Search Console** (GA4 Admin → Product Links → Search Console) so search queries show in Analytics.
- Once Search Console has ~a few days of data, the OpenSEO `/keyword-research` skill can pull
  `get_search_console_performance` — your real "striking distance" queries (positions ~5–20) become
  the fastest opportunity list. This is the payoff of connecting Google.
- Set up a **Google Business Profile** with the same Google account (Udaipur / Machinery
  manufacturer) — it pairs with the LocalBusiness schema already added by the mu-plugin.

## What I can't do from here
Signing into your Hostinger hPanel and your Google account is an interactive login I can't perform,
and I won't ask for those credentials. The code side is done and inert until you paste your GA4 ID;
the steps above are the parts that need your logged-in click-through.
