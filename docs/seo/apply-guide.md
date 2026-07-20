# Apply guide — installing the SEO fixes on superrollforming.com

These changes live in **your WordPress install** (Hostinger), not in this repo's runtime.
This repo holds the ready-to-install code; below is exactly how to deploy and verify it.
Nothing here fakes data — offers appear only when a real price is set, ratings only when
real reviews exist.

## What each file does

| File | Fixes |
| ---- | ----- |
| `wordpress/mu-plugins/super-seo-enhancements.php` | (1) Product JSON-LD schema on product pages, (2) strips emoji from titles/social meta at render, (3) replaces the generic `og:title` "Home", (4) adds LocalBusiness/Organization schema (address, geo, phone, hours, social profiles) |
| `wordpress/scripts/clean-product-titles.php` | One-time WP-CLI cleanup of emoji in the **stored** product/post/page titles |

## Step 1 — Install the mu-plugin (auto-activates, no admin toggle)

**Option A — Hostinger File Manager (hPanel):**
1. hPanel → **Files → File Manager** → open `public_html/wp-content/`.
2. If there's no `mu-plugins` folder, create it (exact name, lowercase).
3. Upload `super-seo-enhancements.php` into `wp-content/mu-plugins/`.
4. Done — "must-use" plugins load automatically. Check **WP Admin → Plugins → Must-Use**.

**Option B — SFTP/SSH:** copy the file to `wp-content/mu-plugins/super-seo-enhancements.php`.

> Review the business profile block at the top of the file (phones, address, geo, socials).
> Values are pre-filled from your site; refine the `geo` lat/long to your Google Business pin.

## Step 2 — Permanently clean emoji from stored titles (optional but recommended)

The mu-plugin already cleans titles as they render. To also clean the database (admin lists,
feeds, exports), run over SSH from the WordPress root:

```bash
# dry run first — shows exactly what would change, changes nothing:
wp eval-file wp-content/scripts/clean-product-titles.php

# take a DB backup, then apply:
wp eval-file wp-content/scripts/clean-product-titles.php --apply
```

If you don't use WP-CLI, just edit the two affected product titles by hand in
**Products → All Products** (e.g. remove 🔥😍 from "Deck Forming Machine").

## Step 3 — Verify

1. **Rich Results Test** — https://search.google.com/test/rich-results
   - Test a product URL (e.g. `/product/deck-forming-machine/`) → expect a **Product** item detected.
   - Test the homepage → expect **Organization / LocalBusiness** with address + phone.
2. **View source** on a product page → confirm a `<script type="application/ld+json">` with `"@type":"Product"`.
3. **Share debuggers** — Facebook Sharing Debugger / LinkedIn Post Inspector on the homepage → `og:title` should now read the branded title, not "Home".
4. After it looks right, **request indexing** for the changed URLs in Google Search Console.

## Rollback

Delete `wp-content/mu-plugins/super-seo-enhancements.php`. All render-time changes revert
instantly. The WP-CLI title cleanup is a content edit — restore from your DB backup if needed.

## Known caveats

- **Quote-based catalogue:** products currently have no price, so Product schema omits `offers`
  (per Google guidelines — don't fake prices). It stays valid and becomes rich-result eligible the
  moment you add prices **or** collect product reviews. See the action plan for the recommendation.
- If you later install **Yoast WooCommerce SEO** (which adds its own Product schema), disable
  section 3 of the mu-plugin to avoid two Product nodes.
