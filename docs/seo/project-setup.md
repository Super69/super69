# SEO project — Super Rollforming

Local SEO workspace context for superrollforming.com. This is the durable project file the
agent reads to build context over time (goals, scope, positioning, data status).

## Status checklist

| Step | Status | Notes | Next action |
| ---- | ------ | ----- | ----------- |
| Working folder | ✅ | This repo's `docs/seo/` is the workspace (audit, plans, copy, competitors) | Keep new SEO work here |
| Website scope | ✅ | See below | — |
| Goals | ◻ needs your input | Draft goals below — confirm/adjust | Reply with priorities |
| Positioning | ✅ (researched) | From live site + directories | Refine with your input |
| OpenSEO MCP | ⏸ not authenticated | `openseo` server added but needs one-time OAuth login | Run `claude` locally → approve login → `claude mcp list` = ✔ |
| Google Search Console | ⚠ verified, data not accessible here | Verification tag present on site; GA4 missing | See `google-connect-guide.md` |
| Assets inventory | ✅ | 20 products, 16 pages, 76 posts, sitemaps, FB/IG/YouTube | — |
| First workflow | ▶ competitor-analysis | jugmug vs super done → `competitors/jugmug-vs-superrollforming.md` | Then keyword-research (needs MCP auth) |

## Website scope
- **Primary domain:** superrollforming.com (WordPress + WooCommerce + Elementor + Yoast, Hostinger)
- **Business:** Roll forming machine manufacturer, **est. 1969**, Udaipur, Rajasthan
- **Locations:** Factory — F-176 RIICO Industrial Area Gudli, Udaipur 313001; Office — 27 Jhariya Marg, Hathipole, Udaipur 313001
- **Product lines:** rolling shutter, cable tray, uni-strut/channel, deck forming, C/Z purlin, solar strut machines (20 products, 6 categories)
- **Markets:** India primary; export intent (1500+ machines worldwide per company materials)
- **Status:** established site, no known traffic drop

## Goals (draft — confirm)
1. Rank top-10 for high-intent commercial terms (e.g. "roll forming machine manufacturers in India", per-machine terms).
2. Win Product + review rich results (stars) on product pages.
3. Grow non-branded organic leads (quote requests / calls).
4. Strengthen export visibility (USA / UAE / UK / GCC).
5. Beat the nearest competitor (jugmugrollforming.com) on the terms where they currently lead.

## Positioning (researched)
- **Edge:** oldest heritage in the niche (**1969** — older than the main competitor's 1982), 1500+ machines deployed, wide machine range, 4.8 Google rating.
- **Buyers:** fabricators, construction-material producers, solar EPCs, cable-management makers, shutter makers — in India and export markets.
- **Underused today:** the "since 1969 / most experienced manufacturer in India" story is not in the money-keyword position of the homepage title; export proof is thinner than the competitor's.

## Data status
- **OpenSEO MCP:** not authenticated → live keyword/backlink/rank tools unavailable. All findings here are first-hand from fetching the live sites (real), with likely-cause reasoning flagged as inference.
- **GSC:** verification tag present; connect via Site Kit to unlock `get_search_console_performance` striking-distance data (`google-connect-guide.md`).

## Recommended next workflows
1. **competitor-analysis** — done (jugmug). 2. **keyword-research** + **keyword-clustering** (after MCP auth). 3. **link-prospecting** for export/trade links.
