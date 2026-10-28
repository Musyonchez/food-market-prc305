# 02 - Requirements and Scope

Source: *PRC 305 Web Development Project Guidelines Sept-Dec 2026* (in `misscelenious/`).

## Key facts

- Individual project, 50% of PRC 305 grade.
- **Concept presentation:** 27 Oct 2026 (5-7 slides) - given before development.
- **Final submission and presentation:** **24 Nov 2026**.
- Host: **InfinityFree**. Site must stay live until grading is complete.
- CMS: WordPress by default (other CMS needs instructor permission).

## Grading

| Area | Weight | How we score it |
|---|---|---|
| Functionality and completeness | 30% | Everything in the table below works, no broken links |
| Design quality and responsiveness | 25% | Consistent branding; tested on phone, tablet, desktop |
| Concept presentation | 25% | See doc 04 |
| Documentation | 10% | These docs + README in GitHub |
| Deployment and live demo | 10% | Public URL works during the demo |

## Mandatory pages/features -> how we meet them

| Brief requirement | Our implementation |
|---|---|
| Home page - intro, branding, navigation | Hero ("Know who's cooking"), cuisine categories, featured cooks, how-it-works |
| About page | Story of the marketplace and the client; mission |
| Services/Products page | **Browse Cooks** + **Browse Dishes** (shop archive) with filters |
| Contact page - working form with validation | Contact Form 7 / WPForms with required fields, email format check, spam protection |
| Social media - at least 2 platforms | Footer icons + embedded Instagram/Facebook feed or YouTube video |
| Responsive design | Mobile-first theme, tested at 360 / 768 / 1280 px |
| Visual consistency | One colour palette, 2 fonts, shared spacing (doc 09) |

## Optional features we will include (extra marks)

- **Image gallery** - food photo gallery.
- **Blog** - "Cook of the Week", recipes, food stories.
- **User login/dashboard** - customers (order history) and cooks (vendor dashboard to manage their menu). This comes free with WooCommerce + a vendor plugin.

## Scope boundaries

**In scope (must ship by 24 Nov):**
- Multi-vendor marketplace with 4-6 demo cooks, each with 4-8 dishes
- Cuisine categories, search, filters
- Cart + checkout (cash on delivery / pay on pickup; M-Pesa as a documented extra)
- Vendor dashboard for cooks to edit menu and prices
- All mandatory pages

**Out of scope (list under "Future work" in the presentation):**
- Own delivery fleet, rider app, live tracking
- Native mobile app
- Automated M-Pesa payouts to cooks
- Real-time order notifications via push

## Definition of done

- [ ] Live URL opens from any phone
- [ ] A customer can: find a cook -> see menu and prices -> add to cart -> place order
- [ ] A cook can: log in -> add/edit a dish and price -> it appears on the site
- [ ] Contact form delivers an email
- [ ] Two social platforms linked
- [ ] Source on GitHub, slides ready, docs complete
