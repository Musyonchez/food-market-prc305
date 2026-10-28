# 05 - Tech Stack and Architecture

## Decision

| Layer | Choice | Why |
|---|---|---|
| CMS | **WordPress** | Default for the course, runs on InfinityFree |
| Store engine | **WooCommerce** (free) | Cart, checkout, orders, product pages |
| Multi-vendor | **Dokan Lite** (free) | Each cook gets a store page and a dashboard to manage their own dishes and prices. Alternative: WCFM Marketplace |
| Theme | **Astra** or **Kadence** (free) | Lightweight, responsive, easy to style, which matters on free hosting |
| Page building | Block editor (Gutenberg); Elementor Free optional | Faster to build the pages |
| Forms | **Contact Form 7** or **WPForms Lite** | Validation, email delivery |
| Email | **WP Mail SMTP** + Gmail SMTP | InfinityFree's PHP `mail()` is unreliable |
| Social | **Smash Balloon** (free feeds) or plain embeds | Meets the 2-platform requirement |
| Gallery | Built-in Gallery block or **Envira/FooGallery Lite** | Optional marks |
| Performance | **LiteSpeed Cache is not supported on InfinityFree; use WP Super Cache** (or none) + image compression (**Smush**) | Keeps pages fast |
| Backup/export | **All-in-One WP Migration** | Backs up the site and moves it between hosts |
| Hosting | **InfinityFree** (required) | Set by the university |

## Why not a custom build

A from-scratch PHP/React app would take longer, needs a database and auth work, and is risky for a 4-week deadline. The course is about **CMS-based** development, and the grading rewards functionality, design and deployment. WordPress also gives the client something they can manage after handover.

## How the pieces fit

```
Customer browser
      |
  WordPress site (InfinityFree)
      |-- Theme (Astra/Kadence): layout, branding
      |-- WooCommerce: products = dishes, orders, checkout
      |-- Dokan: vendors = cooks, each with
      |       store page + menu + dashboard
      |-- Contact form + SMTP email
      |-- Social embeds
      |
  MySQL database (InfinityFree)
```

## Data model mapping

| Marketplace concept | WordPress/Woo/Dokan object |
|---|---|
| Cook / kitchen | Dokan **vendor** (user role `seller`) and their **store page** |
| Dish | WooCommerce **product** owned by that vendor |
| Cuisine (Swahili, Indian, Italian, Street food...) | Product **category** |
| Dietary tags (vegetarian, halal, spicy) | Product **tags** or attributes |
| Order | WooCommerce **order** (split per vendor by Dokan) |
| Customer | WooCommerce **customer** user |

## InfinityFree limits to design around

- No SSH or WP-CLI. Everything runs from the browser, plus FTP/File Manager.
- Limited CPU/hit allowance, so keep plugins few and images small.
- Outbound email via PHP `mail()` is unreliable. Use SMTP.
- No guaranteed cron. WP-Cron fires only on page visits.
- Some plugins that call external servers can fail. Test each one right after installing.
- Free plan's `free.nf` / `rf.gd` / `wuaze.com` style subdomains are acceptable, and SSL is available via the control panel.
- The host may show an anti-bot "JavaScript required" page on first visits. That is normal.

## Plugin budget

Keep the total under about **12 plugins**. Each extra plugin slows the site on shared free hosting.
