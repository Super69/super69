# SEO action plan — superrollforming.com

Roll forming machine manufacturer, Udaipur (India), est. 1969. WooCommerce catalogue of 20
machines, 6 categories, ~76 blog posts. B2B, quote-based, primary market **India** (with export
intent). This is the prioritized roadmap; the technical audit is in
[`superrollforming-audit.md`](superrollforming-audit.md) and the deployable code is in
[`apply-guide.md`](apply-guide.md).

## Now — ship this week (code in this PR, no third-party data needed)

1. **Install `super-seo-enhancements.php`** → Product schema, emoji-clean titles, fixed `og:title`, LocalBusiness schema. Verify in Rich Results Test.
2. **Fix duplicate/broken product titles.** Two products share the identical title *"Uni Strut Channel Roll Forming Machine for Solar panels Structure- Super Rollforming"*, and several titles miss a space before the trailing dash (`Structure- Super`). Give each product a **unique, keyword-led title** (e.g. *"41×21 Uni-Strut Channel Roll Forming Machine"* vs *"Multi-Size Uni-Strut Channel Roll Forming Machine"*).
3. **Enrich thin product pages.** Add ≥300 words of unique copy per machine: forming range/sizes, material & thickness, speed, motor/PLC, roller stations, applications, and a spec table. This directly supports rich results *and* rankings.
4. **Set up Google Search Console + Bing Webmaster** (if not already) and submit `sitemap_index.xml`. GSC is also what unlocks the first-party "striking distance" workflow in OpenSEO.

## Next — 2 to 4 weeks

5. **Google Business Profile.** Claim/optimize for "Super Rollforming, Udaipur" — category *Machinery manufacturer*, add the factory address, photos, products, and posts. Huge for local + brand SERP, and it aligns with the new LocalBusiness schema.
6. **Keyword → page mapping.** Run the OpenSEO `/keyword-research` + `/keyword-clustering` skills (after authenticating) with the seeds in the audit. Map each cluster to a product or category page; create category landing copy for *Cable Tray Machines*, *Uni-Strut/Channel Machines*, *Rolling Shutter Machines*, *Deck Forming*, *C/Z Purlin*, *Solar Strut*.
7. **Internal linking.** You have ~76 blog posts but they aren't feeding the money pages. Add contextual links from each relevant post to its product/category page, and from products to related products.
8. **Image SEO & speed.** Serve a ≥1200×630 OG image; confirm LiteSpeed Cache + WebP is on; lazy-load below-the-fold images; compress the large hero images.
9. **Reviews.** Start collecting product/company reviews (WooCommerce reviews + Google). Once real reviews exist, the Product schema's `aggregateRating` activates automatically → star-eligible SERPs.

## Then — 1 to 3 months (content + authority)

10. **Publish buyer-intent content** mapped to clusters: "how to choose a cable tray roll forming machine", "cable tray machine price in India", "C vs Z purlin machine", "roll forming machine for solar mounting structure". Each targets a real query and links to a product.
11. **Comparison / spec pages** ("41×21 vs 41×41 uni-strut machine") — capture long-tail commercial intent.
12. **Backlinks** — execute [`backlink-plan.md`](backlink-plan.md).
13. **Track rankings** monthly with OpenSEO `/competitor-analysis` and `get_ranked_keywords`; watch the striking-distance queries in GSC and refresh those pages first.

## Success metrics to watch (monthly, in GSC + OpenSEO)
- Product pages appearing as **Product** rich results (Rich Results report).
- Impressions/clicks on non-branded machine queries (India).
- Number of ranking keywords in positions 1–10 and 11–20 (striking distance).
- Referring domains (from the backlink plan).
- Google Business Profile calls / direction requests.

## Priority order rationale
Schema + titles are quick, high-leverage, and code is ready → do first. Unique/expanded product
copy is the foundation everything else compounds on. GBP + reviews unlock local and rich-result
visibility cheaply. Keyword-mapped content and backlinks are the slower-burn authority plays.
