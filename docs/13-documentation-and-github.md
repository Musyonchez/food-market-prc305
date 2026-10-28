# 13 - Documentation and GitHub

The brief requires a **source code repository link (e.g. GitHub)** and gives **10%** for documentation.

## What "source code" means for a WordPress site

WordPress core and plugins are not your code, so don't commit them. Commit what **you** made and what lets someone recreate the site:

```
/ (repo root)
|-- README.md
|-- docs/                       <- these planning/how-to docs
|-- design/                     <- logo, palette, wireframes, sitemap
|-- wp-content/
|   |-- themes/
|   |   '-- <child-theme>/      <- child theme with custom CSS/PHP (if used)
|   '-- mu-plugins or plugins/<custom>/   <- any custom code
|-- exports/
|   |-- site-backup.wpress      <- All-in-One WP Migration export (check size; use a Release if large)
|   '-- sample-data.csv         <- demo products/vendors export
|-- .gitignore
'-- LICENSE (optional)
```

### Use a child theme
Create a **child theme** of Astra/Kadence so you have real, committable code: `style.css` (custom styling) and `functions.php` (small tweaks like showing the vendor name, hiding unused fields).

### .gitignore (important)

```
wp-config.php
.env
*.log
wp-content/uploads/
wp-content/cache/
wp-content/plugins/*
!wp-content/plugins/<your-custom-plugin>/
wp-content/themes/*
!wp-content/themes/<your-child-theme>/
```

**Never commit** `wp-config.php`, passwords, FTP/SMTP/API keys or database dumps with real user data.

## GitHub steps

1. Create a GitHub account if needed, then a repo `food-market-prc305` (public, or private and shared with the instructor).
2. Clone it locally, add the files, then commit and push.
3. Commit in small steps with clear messages ("Add child theme styles", "Add wireframes") so the history shows your own work, which also helps against plagiarism concerns.
4. Download the site files over FTP (or use the child theme folder) and copy them in.

## README.md contents

- Project name, tagline and one-paragraph description
- **Live URL**
- Screenshot or GIF
- Features list
- Tech stack (WordPress, WooCommerce, Dokan, theme, plugins and versions)
- How to run/reproduce: install WP, install plugins, import the backup
- Demo accounts (**roles only**, with passwords given to the instructor privately)
- Folder structure
- Credits: stock photo sources, plugin licences, inspiration (Glovo concept)
- Author: your name, PRC 305, Daystar University, Sept-Dec 2026

## Documentation to hand in (keep these in `docs/`)

| Item | Where |
|---|---|
| Project overview and requirements | docs 01-02 |
| Technical decisions | doc 05 |
| Setup guide | docs 06-08 |
| Design and wireframes | doc 09 |
| Test results | doc 12 (tick it off and add notes/screenshots) |
| **User guide for cooks** | add a 1-page "How to add a dish and change a price" with screenshots |
| **Admin guide** | add a short guide on approving cooks and viewing orders |

## Attribution

The brief warns that reuse without attribution is **disciplinary**. Credit every theme, plugin, starter template and image source in the README and on the site footer ("Photos: Unsplash/Pexels").
