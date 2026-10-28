# 07 - WordPress and WooCommerce Setup

## 1. Base cleanup

- Delete sample page, sample post, "Hello world" comment and unused plugins (Hello Dolly, Akismet if unused).
- **Settings -> Reading:** static front page = **Home** (create it empty first).
- **Settings -> Discussion:** disable comments on pages.
- **Settings -> Permalinks:** Post name.
- Update WordPress and the PHP version if offered.

## 2. Install the theme

**Appearance -> Themes -> Add New** -> install **Astra** or **Kadence** -> activate.
Starter templates are optional. If you use one, pick a **food/restaurant** template and delete the pages you don't need.

## 3. Install plugins (in this order)

| Plugin | Purpose |
|---|---|
| WooCommerce | Store engine (run the setup wizard) |
| Dokan Lite | Multi-vendor (doc 08) |
| Contact Form 7 or WPForms Lite | Contact form |
| WP Mail SMTP | Reliable email |
| Smush | Image compression |
| WP Super Cache | Caching |
| Really Simple SSL | HTTPS enforcement |
| All-in-One WP Migration | Backup/export |
| Smash Balloon (Instagram/Facebook feed) | Social feed (optional) |

**Test the site after every install** (home page + wp-admin). On free hosting, one bad plugin can take the site down.

## 4. WooCommerce wizard

- **Store location:** Kenya.
- **Currency:** Kenyan Shilling (KES / KSh).
- **Industry:** Food and drink.
- **Product types:** physical products.
- **Skip** Jetpack and marketing add-ons.
- **Payments:** enable **Cash on delivery** and **Direct bank transfer** (rename it "Pay on pickup" if useful).
- **Shipping:** create a zone "Nairobi" with flat-rate delivery fee (e.g. KSh 150), plus **Local pickup** (free).
- **Taxes:** off unless the client wants VAT shown.

## 5. Categories (cuisines)

**Products -> Categories**, create:

- Swahili / Coastal
- Kenyan Classics (nyama choma, ugali, githeri)
- Indian
- Italian
- Chinese / Asian
- Street Food (smokies, mandazi, chapati)
- Healthy / Vegan
- Desserts and Bakes
- Drinks

Add a category image to each. They show on the Home page.

**Tags:** Halal, Vegetarian, Vegan, Spicy, Gluten-free.

## 6. Colour and typography (see doc 09)

Appearance -> Customize -> Global Colors and Typography: set the brand palette, 1 heading font and 1 body font. Add the logo and a favicon.

## 7. Menus

**Appearance -> Menus.**

- **Primary:** Home | Browse Cooks | Browse Dishes | Blog | About | Contact | Cart | My Account
- **Footer:** Privacy | Terms | Become a Cook | Contact

## 8. Verify

- [ ] Add a test product, add it to the cart, check out with COD, and see the order in WooCommerce
- [ ] Order confirmation email arrives (if not, see doc 11, SMTP)
