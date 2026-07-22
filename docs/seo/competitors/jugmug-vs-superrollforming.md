# Competitor analysis — Jugmug vs Super Rollforming

**You:** superrollforming.com (Udaipur, est. 1969) · **Competitor:** jugmugrollforming.com (Ludhiana, est. 1982)

> **How to read this.** The OpenSEO MCP isn't authenticated yet, so I have **no live rank/traffic/backlink
> numbers**. Everything below is **first-hand data** from fetching both live sites (titles, schema, sitemaps,
> content, freshness, reviews) plus public directory ratings. Where I say jugmug is "likely winning," that is
> **inference from observable on-page/technical signals**, not confirmed ranking data. Confirm the actual gaps
> with `get_ranked_keywords` + GSC once OpenSEO is connected — the playbook is at the end.

## Side-by-side (observed)

| Signal | Super Rollforming | Jugmug | Who's ahead |
| --- | --- | --- | --- |
| Established | **1969** (older!) | 1982 | Super (unused advantage) |
| Homepage `<title>` | `Roll Forming Machine Expert Since 1969 - Super Rollforming` (brand-led) | `Roll Forming Machine Manufacturers in India \| Expert since 1982` (money-keyword-led) | **Jugmug** |
| Meta description | Generic "leading manufacturer…" | `…best roll forming machine manufacturers in India? … Supply from India to USA, UAE, UK.` (keyword + export + CTA) | **Jugmug** |
| Blog freshness | 76 posts but **stale** — bulk Sep–Oct 2024, last activity Feb–Mar 2026 | 21 posts but **fresh** — 8 updated **Jul 2026** (this month) | **Jugmug** |
| Export positioning | Domestic-leaning; export mentioned | Strong — 17+ countries, named intl. client testimonials, export in title/meta | **Jugmug** |
| Homepage social proof | "Our Satisfied Clients" (generic) | 5 **named** client testimonials w/ countries, front and centre | **Jugmug** |
| Location/state landing pages | Not evident | Yes — e.g. `/custom-profile/` targets "Roll Forming Manufacturers in UP" | **Jugmug** |
| Product/Machine schema | None (Yoast default only) | None (Yoast default only) | Tie — **open goal** |
| Review/AggregateRating schema | None | None | Tie — **open goal** |
| Extra branded properties | FB, IG, YouTube | FB, LinkedIn, **Google Play app** | Jugmug (breadth) |
| Rating (public) | **4.8 Google** | 4.7 (34 ratings, Justdial) | **Super** |
| Platform | WP + WooCommerce + Elementor + Yoast | WP + Yoast (custom "machines" CPT) | Tie |

## Where Jugmug is likely beating you — and *why*

1. **Their homepage title targets the money keyword; yours doesn't.**
   Jugmug leads with **"Roll Forming Machine Manufacturers in India"** — the highest-intent commercial query a
   buyer types. Yours leads with "Expert Since 1969 - Super Rollforming" (brand + heritage). Google weights the
   title heavily; you're not competing for the exact phrase in the strongest on-page slot — despite being the
   *older, more credible* manufacturer.

2. **They publish fresh content every month; your blog went quiet.**
   You have far more posts (76 vs 21) but they're mostly from 2024. Jugmug updated **8 posts this month**.
   Consistent freshness signals an active, authoritative site and keeps harvesting long-tail queries.

3. **They sell the export story harder.**
   Named international testimonials + "Supply from India to USA, UAE, UK" in the meta + country lists win
   export-intent and higher-value international queries. You have 1500+ machines worldwide but barely say so.

4. **They build location/state landing pages.**
   Pages targeting "…Manufacturers in UP" (and similar) capture geo-modified searches you're not covering.

5. **Breadth of branded properties.**
   A Google Play app + active LinkedIn give them extra branded search real estate and citation/link signals.

## How to beat them (adopt what they do — then do it better)

### Quick wins (days) — you can leapfrog on schema immediately
- **Rewrite the homepage title to own the money keyword AND your heritage edge:**
  `Roll Forming Machine Manufacturers in India — Since 1969 | Super Rollforming`
  You're older than Jugmug (1969 vs 1982) — say it *in the same slot* where they say 1982. This is a direct win.
- **Sharpen the meta description** to their formula but stronger: question + money keyword + export + your proof:
  `Looking for the most experienced roll forming machine manufacturer in India? Super Rollforming — since 1969, 1500+ machines across India, USA, UAE & UK. Get a quote.`
- **Ship Product + Review schema (they have neither).** The mu-plugin in this PR already adds Product schema;
  add **AggregateRating** from your real 4.8 rating/reviews → you can show **star snippets they don't have**.
  This is the single biggest "beat them" lever — see `google-ratings-plan.md`.
- **Put 4–6 named client testimonials on the homepage** (name, company, country) like they do — you have 1500+
  installs to draw from; make yours more specific.

### Content (2–6 weeks) — out-publish and out-structure them
- **Restart the blog on a monthly cadence**, mapped to buyer queries (use `/keyword-research` once MCP is live).
  You already have 76 posts — refresh/expand the best and interlink them to product pages instead of letting them rot.
- **Build location + application landing pages** they're using: "roll forming machine manufacturer in
  [Rajasthan/Gujarat/UP/…]", "cable tray machine manufacturer in India", "solar strut roll forming machine for
  EPC". One focused page per real query, each linking to the matching product.
- **Build a dedicated Export page** (countries served, container/shipping, installation abroad, international
  case studies) to contest their export advantage — and back it with your 1500+/worldwide proof.

### Authority (1–3 months)
- **Match their off-site footprint and exceed it:** active LinkedIn company page, and evaluate whether an app or
  a richer IndiaMART/TradeIndia/export-marketplace presence is worth it. Then execute `backlink-plan.md`.
- **Link-gap them:** once OpenSEO is authenticated, pull jugmug's backlinks and target domains that link to them
  but not you (`/link-prospecting`).

## Your unfair advantage to lean on
You are the **older, larger-deployment** manufacturer (1969 vs 1982; 1500+ machines; 4.8 vs 4.7). Jugmug is
simply *marketing* better on-page. Put your real credibility into the title, meta, testimonials, and schema and
you should out-rank a younger competitor on the exact terms they lead on today.

## Confirm with live data (after OpenSEO auth)
1. `/competitor-analysis` → `get_ranked_keywords` for **jugmugrollforming.com** = their actual ranking keywords.
2. `get_ranked_keywords` for **superrollforming.com** = yours. Diff = the keywords they rank for and you don't.
3. `get_keyword_metrics` on that gap list → prioritise by volume × intent × difficulty.
4. Backlink overview on both → referring-domain gap for `/link-prospecting`.
5. In GSC, work your **striking-distance** queries (positions 5–20) first — fastest wins.
