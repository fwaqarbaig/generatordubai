# SEO Audit & Fix Plan — Rental Power UAE (local: http://127.0.0.1:8000)

Audited: 2026-10-19. Scope: homepage, services (34), fleet/products (~25), blog posts (~140), categories, sitemap/robots, schema, images, internal linking. 196 URLs crawled from `sitemap.xml` — **all returned HTTP 200** (no broken links found in the current sitemap).

Give this whole file to Antigravity as the task list. Items are ordered by priority. Each item names the file(s) to touch.

---

## 🔴 P1 — Critical

### 1. Duplicate/near-duplicate blog posts competing for the same keyword (keyword cannibalization)
Several posts target the **identical search intent** with near-identical titles/content. Google will pick one (or neither) to rank and split link equity/CTR between them.

Confirmed duplicate pairs (same topic, different slug):
- `/rental-chiller-vs-portable-ac-for-commercial-buildings-in-the-uae` **and** `/rental-chiller-vs-portable-ac-for-commercial-buildings` — same title pattern, same opening paragraph structure, ~80% topical overlap.
- `/temporary-cooling-services-in-dubai` **and** `/temporary-cooling-options-in-the-uae` — same intent ("temporary cooling UAE/Dubai"), same structure, 13–15k chars each.
- Also inspect (not fully diffed, same keyword cluster, high risk): 
  - `/how-to-choose-rental-generator-construction-projects-uae` vs `/how-to-select-a-rental-generator-for-a-high-rise-construction-project-in-dubai` vs `/how-to-prepare-a-construction-site-before-generator-delivery-in-the-uae` vs `/how-to-prepare-construction-site-before-rental-generator-delivery`
  - `/what-affects-rental-generator-prices-in-dubai` vs `/rental-generator-vs-buying-generator-long-term-projects-uae`
  - `/how-to-calculate-rental-generator-fuel-consumption` vs `/how-to-estimate-generator-diesel-fuel-costs`
  - `/rental-chiller-vs-portable-ac-for-commercial-buildings*` (2 posts above) vs `/what-is-the-difference-between-chiller-rental-and-ac-rental`

**Fix:**
1. For each duplicate pair, pick the stronger-performing/better-written page as canonical.
2. 301-redirect the loser to the winner in `routes/web.php` (or a redirects table entry — the app already has `admin/redirects`, use that UI/table).
3. Merge any unique value (FAQs, stats) from the loser into the winner before redirecting.
4. Remove the loser post row (or set `status = draft` + `is_indexable = false`) so it drops out of the sitemap (`app/Http/Controllers/Admin/PostController.php`, `app/Models/Post.php`).
5. Going forward, before publishing a new post, grep existing post titles/slugs for the target keyword to prevent this recurring — this content was clearly produced in bulk (same opening sentence templates across many posts), so an editorial-calendar/keyword-map check is needed, not just a one-time cleanup.

### 2. Service-level cannibalization: near-identical service pages
- `/service/rental-generator-in-uae` vs `/service/rental-power-in-uae` — both target "generator rental UAE" intent; titles/descriptions are differentiated (good), but check on-page H2/body keyword density isn't duplicating.
- `/service/generator-maintenance-uae` vs `/service/generator-amc-uae` — "maintenance" and "AMC" (annual maintenance contract) are the same searcher intent in this market; consider merging into one authoritative page with an AMC section, or keep both but add a clear differentiator block + cross-link with distinct anchor text (not "learn more").
- `/service/chiller-maintenance` vs `/service/chiller-amc-uae` — same issue.
- `/service/used-generators-uae` vs `/service/refurbished-generators-uae` and `/service/used-chiller-in-uae` vs `/service/refurbished-chillers-uae` — "used" vs "refurbished" often searched interchangeably; verify body content is substantively different (used = as-is, refurbished = reconditioned) and make that distinction explicit and prominent in H1/first 100 words on both, otherwise merge.

**Fix:** For each pair, add an explicit differentiation paragraph near the top ("Looking for AMC/contract pricing instead? See our Generator AMC page →") with descriptive anchor text, and ensure `h1`/first-100-words don't share the same primary keyword phrase verbatim.

### 3. Product schema (`Product` JSON-LD) missing `offers`
`/fleet/diesel-generator` (and presumably all fleet pages — check the shared partial) emits a `Product` schema with `name`, `description`, `image`, `sku`, `brand`, `category` but **no `offers`** (price/priceCurrency/availability) and no `aggregateRating`/`review`.

Per Google's structured data guidelines, a `Product` without `offers`, `review`, or `aggregateRating` is **not eligible for rich results** and can trigger a Search Console "Missing field 'offers'" warning.

**Fix (file: product/fleet show view + `app/Http/Controllers/Frontend/ProductController.php` or wherever the schema is built):**
- Add an `offers` block, even for rental/quote-based pricing:
```json
"offers": {
  "@type": "Offer",
  "priceCurrency": "AED",
  "price": "0",
  "availability": "https://schema.org/InStock",
  "url": "https://rentalpower.ae/fleet/diesel-generator",
  "businessFunction": "http://purl.org/goodrelations/v1#LeaseOut"
}
```
Or, if a fixed price genuinely doesn't exist, consider switching from `Product` to a more accurate type for "contact for quote" listings — many sites use `Product` + `Offer` with `priceSpecification` ("Call for pricing") rather than omitting `offers` entirely. Validate with Google's Rich Results Test after the fix.

### 4. Inconsistent host in generated URLs (schema, images, sitemap)
On the same page (`/fleet/diesel-generator`) the `Product` schema `image` array contains the **same image listed twice** with two different hosts:
```
http://localhost:8000/storage/media/diesel-generator.jpg
http://127.0.0.1:8000/storage/media/diesel-generator.jpg
```
and on-page `<img>` tags mix `http://localhost:8000/...` (absolute, from `config('app.url')`/`asset()`), `http://127.0.0.1:8000` (from `url()`/`request()`), and bare relative `/storage/...` paths — all in the same template render.

This is a code bug, not just a local-env artifact: in production, if `APP_URL` in `.env` doesn't exactly match the canonical domain used elsewhere (e.g. `www` vs non-`www`, or `http` vs `https`), this will produce **duplicate image URLs in schema and mixed canonical/og URLs**, which can cause Google to see the same image/page as two different resources and split signals.

**Fix:**
1. Audit `.env` → confirm `APP_URL=https://rentalpower.ae` (no trailing slash, correct scheme, matches the domain Search Console is verified on).
2. Standardize on ONE way to build absolute URLs site-wide — prefer `asset()`/`url()` which both respect `APP_URL`, and stop mixing in `request()->getSchemeAndHttpHost()` anywhere in schema-building code. Grep for `getSchemeAndHttpHost` and `request()->url()` in `app/` and blade views and replace with `url()`/`asset()`.
3. De-duplicate the `image` array when building `Product`/`Organization` schema (wrap in `array_unique`).

### 5. Sitemap host diverges from canonical/og host
`sitemap.xml` emits `http://localhost:8000/...` URLs while the page `<link rel="canonical">` and `og:url` emit `http://127.0.0.1:8000/...`. This is purely because `config('app.url')` (used by `SitemapController::getBaseUrl()`) differs from what `url()`/canonical tags use locally. **In production these must resolve to the exact same domain**, or Google will index sitemap URLs that don't match canonical URLs.

**Fix:** Before deploying, confirm `APP_URL` in production `.env` is `https://rentalpower.ae` and that every canonical/og/schema/sitemap URL builder reads from that same source (see item 4). Add an automated check: a simple Artisan command or test that asserts `route('home')`, the sitemap's first `<loc>`, and the homepage's `<link rel="canonical">` all share the same host — run it in CI before deploy.

---

## 🟠 P2 — High priority

### 6. "City/project-variant" doorway pages in blog
Many posts are the same article re-written per city/vertical, e.g.:
- `how-to-choose-rental-generator-construction-projects-uae`, `...-remote-construction-sites-abu-dhabi`, `...-for-a-factory-expansion-in-sharjah`, `...-for-a-high-rise-construction-project-in-dubai`
- `how-to-choose-temporary-cooling-for-a-manufacturing-plant-in-sharjah`, `...-for-a-hotel-renovation-in-dubai`, `...-equipment-uae-summer-conditions`

This pattern (swap city name, keep ~90% of the article) is classic **doorway-page** territory and a cannibalization risk even when titles differ, because the pages compete for overlapping long-tail queries and dilute topical authority instead of consolidating it.

**Fix:** Consolidate each cluster into one comprehensive pillar article per core topic (e.g. "Generator Rental for UAE Construction Sites — Dubai, Abu Dhabi & Sharjah"), with city-specific sections/anchors inside it (`#dubai`, `#sharjah`) instead of separate thin pages. Redirect the thin variants to the pillar page with anchors. Keep the genuinely distinct `/locations/{city}` landing pages — those are legitimate local-SEO pages — but stop spinning blog posts per city on the same how-to topic.

### 7. "Used" vs "Refurbished" vs "Second-hand" term overlap in blog too
`what-should-you-inspect-before-buying-used-generator-uae`, `how-to-inspect-a-used-generator-before-transporting-it-to-your-site`, `what-should-you-inspect-before-purchasing-a-second-hand-portacabin` — review this cluster (10+ posts under the used/refurbished generator and portacabin categories) for the same consolidation treatment as item 6.

### 8. Verify `hreflang` / single-language signal
Site serves English + has `availableLanguage: ["English","Arabic"]` in Organization schema but no Arabic content was found and no `hreflang` tags exist. If Arabic content isn't actually coming, remove `"Arabic"` from `availableLanguage` to avoid promising content/support that isn't backed by the site. If Arabic pages are planned, add `hreflang="ar"` alternates once built.

### 9. FAQ schema duplication across many Service pages
Every service page (`Service`, `BreadcrumbList`, `FAQPage`, `Organization`) repeats the same `Organization` block. Confirm the FAQ **questions themselves** aren't copy-pasted identically across different services (only spot-checked 4 — `generator-maintenance-uae` vs `generator-amc-uae` FAQs should be diffed for exact duplicate Q&A text, which would reinforce the cannibalization in item #2).

---

## 🟡 P3 — Medium / polish

### 10. Organization schema `image` array has no `alt`/caption context and reuses generic photos (`b-1.jpg`) across every page
Low impact but worth tidying — use a consistent, branded hero image set.

### 11. Robots.txt hostnames
`robots.txt` correctly lists multiple sitemap URLs but uses `localhost:8000` — confirm this is only a local artifact (driven by item #5's `APP_URL` fix) and resolves to `https://rentalpower.ae/...` in production.

### 12. `used-refurbished-generators`, `industries`, `locations`, `odoo` pages — low priority 0.3 for `/odoo` page in sitemap suggests it's a legacy/migration page. Confirm `/odoo` is meant to be public and indexable; if it's a leftover from a CMS migration, set `is_indexable=false` or noindex it (check `app/Models/OdooPage.php` and `app/Http/Controllers/Frontend/*` for how it's rendered).

### 13. Images — alt text and lazy-loading are already implemented correctly
Checked homepage (10 imgs), service pages (15 imgs), blog index (11 imgs), fleet page (5 imgs): **0 missing `alt` attributes**, `loading="lazy"` used correctly on below-fold images. No action needed here — good baseline, just keep enforcing it via the admin "quick SEO" / Yoast-style box already in `resources/views/admin/partials/yoast-seo-box.blade.php` when new posts are added.

### 14. Titles & meta descriptions
Crawled all 196 sitemap URLs: **zero duplicate `<title>` tags, zero duplicate meta descriptions, zero missing descriptions, zero missing H1s.** This part of the SEO setup is solid — don't let the P1/P2 consolidation work regress it (when merging/redirecting pages, update internal links that pointed at the removed slugs).

---

## ✅ What's already working well (don't break it)
- Organization / WebSite / Service / Product / FAQPage / BreadcrumbList JSON-LD present on all page types sampled.
- All 196 sitemap URLs return HTTP 200 — no broken links found.
- Every crawled page has a unique title, unique meta description, and an H1.
- Images have alt text and lazy-loading.
- `robots.txt` correctly blocks `/admin`, `/login`, `/register`, `/api/`.

---

## Suggested execution order for Antigravity
1. Fix `APP_URL`/host consistency (items 4 & 5) — quick, prevents future duplicate-content signals.
2. Add `offers` to Product schema (item 3) — quick, fixes a real structured-data error.
3. Resolve the two confirmed duplicate blog pairs (item 1) — redirect + deindex.
4. Audit and consolidate the city-variant / used-vs-refurbished blog clusters (items 6 & 7) — biggest content effort, biggest cannibalization payoff.
5. Differentiate or merge the maintenance/AMC and used/refurbished service pairs (item 2).
6. Polish items (8–12).
