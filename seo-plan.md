# SEO Implementation Plan

> **Project:**  
> **Date:**  
> **URL:**  

---

## Phase 1 — Foundation

### 1.1 Shared Layout
- [ ] Create a base layout (`layouts/public.blade.php`) with shared `<head>`
- [ ] Extend it on every public view
- [ ] Ensure `<html lang="...">` matches your content language

### 1.2 Meta Tags (per page)
| Tag | Home | Listing | Detail | Static |
|-----|------|---------|--------|--------|
| `title` | Brand name + tagline | Page name — Brand | Entity name — Brand | Page name — Brand |
| `description` | 150–160 chars | 150–160 chars | Truncated from content | 150–160 chars |
| `canonical` | `url()->current()` | `url()->current()` | `url()->current()` | `url()->current()` |
| `robots` | index, follow | index, follow | index, follow | index, follow |

### 1.3 Open Graph & Twitter Cards
```blade
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="...">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
```

- [ ] Implement on all public pages
- [ ] Dynamic pages pull image from first media item

---

## Phase 2 — Content & Semantics

### 2.1 Heading Hierarchy
- [ ] Exactly one `<h1>` per page
- [ ] Logical `h1 > h2 > h3` nesting, no skipping levels
- [ ] Keywords in headings where natural

### 2.2 Semantic HTML
| Element | Usage |
|---------|-------|
| `<header>` | Site header, page headers |
| `<nav>` | Primary navigation |
| `<main>` | Unique page content (one per page) |
| `<article>` | Blog posts, project cards, list items |
| `<section>` | Thematic content groups |
| `<figure>` + `<figcaption>` | Images with captions |
| `<footer>` | Site footer |

- [ ] Audit existing views and replace generic `<div>`s

### 2.3 Images
- [ ] Every `<img>` has a descriptive `alt` attribute
- [ ] `loading="lazy"` on images below the fold
- [ ] Serve modern formats (WebP) with fallback
- [ ] Compress / resize on upload (Intervention, Spatie MediaLibrary, or Glide)

### 2.4 Internal Linking
- [ ] Breadcrumbs on detail pages
- [ ] Related content sections (e.g. "Other projects", "Related articles")
- [ ] Descriptive anchor text (never "click here")

---

## Phase 3 — Technical SEO

### 3.1 robots.txt
```txt
User-agent: *
Disallow: /admin
Disallow: /dashboard
Disallow: /api
Disallow: /_debugbar
Allow: /

Sitemap: https://example.com/sitemap.xml
```

- [ ] Block all admin/auth paths
- [ ] Point to sitemap URL

### 3.2 Sitemap XML
- [ ] Install `spatie/laravel-sitemap`
- [ ] Include: homepage, all public listing pages (paginated), all detail pages, all static pages
- [ ] Set correct `lastmod`, `changefreq`, `priority`
- [ ] Register route or schedule a command to regenerate periodically

### 3.3 Structured Data (JSON-LD)
#### Organization / LocalBusiness (homepage)
```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Business Name",
  "url": "https://example.com",
  "logo": "https://example.com/logo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "...",
    "contactType": "customer service"
  },
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "...",
    "addressLocality": "...",
    "addressCountry": "ID"
  }
}
```

#### ItemList (listing pages)
```json
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": [...]
}
```

#### Product / Article (detail pages)
```json
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "...",
  "description": "...",
  "image": "..."
}
```

- [ ] Add Organization schema to homepage
- [ ] Add ItemList schema to listing/index pages
- [ ] Add detail schema on individual entity pages

### 3.4 Performance
- [ ] Enable Brotli / Gzip compression
- [ ] Set proper `Cache-Control` headers on assets
- [ ] Use a CDN for images (Cloudflare, BunnyCDN, etc.)
- [ ] Core Web Vitals: LCP < 2.5s, FID < 100ms, CLS < 0.1

### 3.5 Mobile
- [ ] Viewport meta tag present: `<meta name="viewport" content="width=device-width, initial-scale=1">`
- [ ] Test all pages with Chrome DevTools mobile emulator
- [ ] Tap targets at least 48x48px

---

## Phase 4 — Ongoing

| Task | Frequency | Tool |
|------|-----------|------|
| Submit sitemap to Google Search Console | Once + on deploy | GSC |
| Monitor index coverage | Weekly | GSC |
| Check for crawl errors | Weekly | GSC |
| Review Core Web Vitals | Monthly | GSC / PageSpeed |
| Competitor keyword gap analysis | Quarterly | Ahrefs / SEMrush |
| Update / prune old content | Quarterly | — |

---

## Checklist Summary

### Priority (do first)
- [ ] Shared layout with meta tags + OG
- [ ] `robots.txt` — block admin paths
- [ ] Sitemap generation
- [ ] Unique `title` / `description` on every page
- [ ] Image alt attributes + lazy loading

### Important (do next)
- [ ] Schema.org structured data (Organization + detail types)
- [ ] Semantic HTML audit
- [ ] Heading hierarchy audit
- [ ] Canonical URLs on all pages
- [ ] Breadcrumb internal links

### Nice to have
- [ ] Image WebP conversion on upload
- [ ] CDN for static assets
- [ ] Automatic sitemap regeneration on content change
- [ ] hreflang tags (if multi-language)
