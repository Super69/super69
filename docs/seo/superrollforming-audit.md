# SEO review — superrollforming.com

**Date:** 2026-07-20 · **Site:** https://superrollforming.com
**Business:** Roll forming machine manufacturer (India, est. 1969) — WooCommerce catalogue of
roll forming machines (cable tray, uni-strut/channel, rolling shutter, deck, C/Z purlin, solar strut).

> **Scope note.** The keyword volume / difficulty / backlink / rank-tracking numbers in the
> "command playbook" below come from the **OpenSEO MCP**, which needs a one-time OAuth login
> (see [README](../../README.md#one-time-authentication-required-before-running-commands)).
> Everything in **Part 1** is a live, first-hand technical/on-page audit performed by fetching
> the site directly — no third-party or estimated metrics, no invented data.

---

## Part 1 — On-page & technical audit (live findings)

### Platform
WordPress + WooCommerce + Elementor, Yoast SEO, hosted on Hostinger (LiteSpeed, HTTP/2 + HTTP/3).

### What's already good ✅
- **HTTPS enforced** — `http://` → `https://` (301) and `www` → non-`www` (301) both redirect cleanly.
- **Homepage title** — `Roll Forming Machine Expert Since 1969 - Super Rollforming` (57 chars, keyword-first, within limits).
- **Homepage meta description** — present, ~137 chars, keyword-rich and benefit-led.
- **One `<h1>` per page**; H2 structure is logical.
- **All 16 homepage images carry `alt` text.**
- **Mobile viewport** meta present.
- **Sitemaps** — `sitemap_index.xml` with product/page/post/category sub-sitemaps.
- **robots.txt** — sensible WooCommerce disallows (cart params, wc-logs), sitemap referenced.
- **Schema present** — `Organization`, `WebSite`, `WebPage`, `BreadcrumbList`, `SearchAction`.
- **Canonical tags** present and self-referential.

### Issues to fix 🔧 (priority order)

| # | Issue | Evidence | Fix |
|---|-------|----------|-----|
| 1 | **No `Product` schema on product pages** | `/product/deck-forming-machine/` emits only `WebPage`/`Organization`/`Breadcrumb` — no `Product`/`Offer`/`AggregateRating` | Enable WooCommerce/Yoast product schema (or RankMath) so machines are eligible for rich results (price/availability/ratings). Biggest win for a 20-product store. |
| 2 | **Emojis in product `<title>` tags** | `Deck Forming Machine 🔥😍 for Floor Deck Profile - Super Rollforming` | Remove 🔥😍 from title tags — Google often strips them and they read as spammy in B2B SERPs. Keep them out of titles/meta; fine in body copy. |
| 3 | **Open Graph title is generic** | Homepage `og:title` = `"Home"` | Set `og:title` to a branded, keyword-led string so shared links don't say "Home". |
| 4 | **No `LocalBusiness` / `Organization` address + geo schema** | Only bare `Organization` in schema | Add `LocalBusiness` (or `Organization` with `address`, `telephone`, `sameAs`) — strong for a "manufacturer in India" intent and Google Business alignment. |
| 5 | **`og:image` is small (370×222)** | `og:image:width=370` | Provide a ≥1200×630 OG image for proper social/link-preview rendering. |
| 6 | **Thin catalogue depth** | 20 products, 6 categories, but 76 blog posts | Ensure each product page has ≥300 words of unique spec/application copy and internal links from relevant blog posts (topical authority is already being built via the blog — connect it to money pages). |

---

## Part 2 — OpenSEO command playbook (run after authenticating)

Once `claude mcp list` shows **openseo ✔ connected**, run these in Claude Code from this repo.
Each maps to an installed skill. Seeds below are tailored to this business.

### Step 0 — Create the project
```
/seo-project-setup
```
Set: site `superrollforming.com`, market **India** (language `en`), industry *industrial machinery / roll forming*,
positioning *50+ years, high-durability roll forming machine manufacturer*. Connect Google Search Console if available —
it unlocks first-party "striking distance" queries via `get_search_console_performance`.

### Step 1 — Keyword research
```
/keyword-research
```
Suggested seeds (use 1–5 per `research_keywords` call, market = India):
- `roll forming machine`
- `cable tray roll forming machine`
- `uni strut / c channel forming machine`
- `rolling shutter making machine`
- `deck forming machine` / `floor deck roll forming machine`
- `c z purlin roll forming machine`
- `solar strut roll forming machine`

Then hydrate the candidate list with `get_keyword_metrics` (volume, KD, intent, CPC) and pull
`get_ranked_keywords` for `superrollforming.com` to find current rankings + near-misses.

### Step 2 — Cluster into page targets
```
/keyword-clustering
```
Cluster the researched terms by intent and map each cluster to an existing product/category page
(or a proposed new one). Use the clusters to prioritize the Part 1 product-page copy work.

### Step 3 — Competitor & landscape analysis
```
/competitor-analysis        # one named competitor's organic footprint + gaps
/competitive-landscape      # market leaders, content themes, keyword & backlink gaps
```
Feed 2–4 competing Indian roll-forming/sheet-metal machine manufacturers you compete with.

### Step 4 — Link building
```
/link-prospecting
```
Find prospects (industry directories, B2B marketplaces, trade publications) and draft outreach.

### Step 5 — Ongoing
```
/seo-coach
```
Use coach mode any time to decide the next best action from the data collected.

---

## Suggested execution order
1. Fix Part 1 items **#1–#3** (schema + titles + OG) — quick, high-impact, no data needed.
2. Authenticate OpenSEO → run **Step 0–1** to get the real keyword/ranking baseline for India.
3. Cluster (Step 2) → rewrite product pages against the clusters (fixes Part 1 #6).
4. Competitor + link work (Steps 3–4) on a recurring cadence.
