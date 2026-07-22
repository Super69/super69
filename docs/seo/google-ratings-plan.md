# Improving your Google ratings (and turning them into SEO wins)

Good news first: public data shows **Super Rollforming at ~4.8 on Google** — *higher* than jugmug (4.7 / 34 on
Justdial). The opportunity isn't fixing a bad score; it's **(a) getting more reviews, (b) responding to them,
and (c) showing those stars in Google search** — none of which you're currently doing to full effect.

## Part 1 — Get more (and better) Google reviews

1. **Claim & complete your Google Business Profile** (Udaipur / *Machinery manufacturer*). Add both addresses,
   hours, all product lines, photos of machines + factory, and post updates monthly. A complete profile ranks
   and converts better and is where reviews live.
2. **Make asking systematic**, not occasional:
   - Create your **short review link** (GBP → Ask for reviews → copy link) and turn it into a QR code.
   - Send it **after every machine delivery / installation** by WhatsApp (you already use WhatsApp) and email.
   - Put the QR on the machine handover document, invoice, and a factory-floor sticker.
   - Personal ask from the founder/sales lead converts far better than a generic blast.
3. **Target your happiest, most credible customers first** — the export clients and repeat buyers. A few reviews
   that mention **the machine type + city/country** ("cable tray line, shipped to Dubai") are SEO gold: they put
   your keywords in third-party content.
4. **Respond to every review**, positive and negative, within a few days. Google rewards engagement, and thoughtful
   replies to any criticism build trust with future buyers. Never argue — acknowledge, offer to make it right.
5. **Never buy or incentivise reviews** — it violates Google policy and risks removal. Volume from real customers,
   steadily, is what moves the needle.

**Target:** a steady drip (e.g. 3–5 new Google reviews/month) beats a one-time burst — Google and buyers both
favour recency and consistency.

## Part 2 — Show the stars in search (the SEO multiplier)

A 4.8 rating that only lives on your Google Business Profile does nothing for your website's search snippets.
Neither you nor jugmug currently output **review schema** — so this is where you leapfrog them:

1. **Collect on-site reviews** (WooCommerce product reviews, or a reviews plugin) so you have first-party ratings
   tied to products and the company.
2. **Emit `AggregateRating` / `Review` schema:**
   - The mu-plugin in this PR (`super-seo-enhancements.php`) already adds **Product schema** and will attach
     `aggregateRating` automatically **once real WooCommerce reviews exist** on a product.
   - For the **company/homepage** star rating, add `aggregateRating` to the Organization/LocalBusiness node from
     genuine, on-site collected reviews (don't hard-code your Google score into schema — Google requires the
     rating be for content on *your* page and can penalise self-serving markup).
3. **Validate** each page in Google's Rich Results Test, then request re-indexing in Search Console.
4. Result: eligibility for **★ star snippets** in organic results and richer Product/Local panels — a click-through
   advantage jugmug doesn't have.

## Part 3 — Reinforce with consistent citations (helps local + trust)
- Keep **Name, Address, Phone identical** across Google, Justdial, IndiaMART, TradeIndia, Facebook, LinkedIn.
  Inconsistent NAP dilutes local ranking and erodes rating trust signals.
- Encourage reviews on the **secondary platforms too** (Justdial, IndiaMART) — jugmug shows 34 Justdial ratings;
  matching/exceeding that broadens your review footprint and referral traffic.

## Do-this-week checklist
- [ ] Claim/complete Google Business Profile (both Udaipur locations, photos, products, hours).
- [ ] Generate the GBP review short-link + QR; add to handover doc, invoice, WhatsApp template.
- [ ] Reply to all existing Google reviews.
- [ ] Turn on WooCommerce product reviews; invite 10–15 recent buyers to review specific machines.
- [ ] Once a few product reviews land, verify `aggregateRating` shows in Rich Results Test (mu-plugin handles it).
