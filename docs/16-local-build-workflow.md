# 16 - Local Build Workflow (build locally, deploy to InfinityFree)

## Why

InfinityFree blocks scripted/API access (bot-check), has no SSH or WP-CLI, and has tight limits. So we build and test on the laptop, then move the finished site to InfinityFree. This replaces the "build directly on the host" assumption in docs 06-07: do doc 06 only for the account, subdomain and SSL, then follow this doc for the actual build.

## Steps

### 1. Local WordPress
1. Install **LocalWP** (localwp.com). Create a site `food-market` (PHP 8.x, nginx or Apache, MySQL).
2. Log in at `http://food-market.local/wp-admin`.
3. Do doc 07 (cleanup, theme, plugins, WooCommerce wizard) and doc 08 (Dokan) here.

### 2. Install our code (from this repo)
Copy `wp-content/themes/mapishi-child/` into the local site's `wp-content/themes/`. Install the parent theme **Astra**, then activate **Mapishi Child**.

### 3. Load demo data
1. WooCommerce -> Products -> **Import** -> upload `exports/sample-products.csv`.
2. Create 5 vendor users through Dokan registration (names in the CSV's `Cook` notes). Then, in Products, set each dish's **Author** to its cook (Quick Edit or the Author box).
3. Paste the page copy from `content/page-copy.md` into the pages (doc 10).

### 4. Let AI help (optional)
- With Claude in Chrome, Claude can drive local wp-admin to build pages and menus. Local has no bot-check, so it works.
- WordPress REST API + an Application Password (Users -> Profile) also works locally for scripted content creation.

### 5. Export
Install **All-in-One WP Migration** -> Export -> File. Save the `.wpress` file. Make a copy per milestone (`milestone-1.wpress`, ...).

### 6. Deploy to InfinityFree
1. Install a fresh WordPress on InfinityFree (doc 06) and the All-in-One WP Migration plugin.
2. Import the `.wpress` file. If it fails on the upload limit, raise `upload_max_filesize` in the InfinityFree PHP config or upload the file by FTP to `wp-content/ai1wm-backups/` and restore it from the plugin's Backups page. If that still fails, copy the files by FTP and import the database through phpMyAdmin, then use Better Search Replace to swap `food-market.local` for the live URL.
3. Re-save Settings -> Permalinks, re-issue SSL, and test mail (doc 11).
4. Run doc 12.

### 7. Updates after the first deploy
Make small content edits directly on live. Make structural changes locally, re-export, and re-import. Don't do both on the same day, or you overwrite one with the other.

## Tips
- Keep the plugin list identical in local and live.
- Compress images before upload (about 200 KB each).
- Commit to GitHub after every milestone (doc 13).
