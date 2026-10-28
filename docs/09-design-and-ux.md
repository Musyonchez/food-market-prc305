# 09 - Design and UX

## Brand direction

**Feeling:** warm, appetising, local, trustworthy, human. It is not a cold tech-company look.

**Suggested palette** (adjust with the client)

| Role | Colour | Hex |
|---|---|---|
| Primary (buttons, links) | Chilli orange | `#E4572E` |
| Secondary | Deep green (fresh) | `#2E7D32` |
| Accent | Turmeric yellow | `#F2A900` |
| Background | Warm off-white | `#FFF8F0` |
| Text | Charcoal | `#2B2B2B` |

Check contrast: white text on `#E4572E` passes for large/bold text. Use charcoal text on light backgrounds.

**Typography:** headings in **Poppins** or **Playfair Display**; body in **Inter** or **Open Sans**. Two fonts only.

**Imagery:** real photos of food and cooks (client supplied). Warm light, close-ups, consistent crop (square for dishes, 3:2 for banners). If real photos are not available, use clearly licensed images (Unsplash, Pexels) and credit them.

**Logo:** simple wordmark plus a pot/spoon/fire icon. Make it in Canva or Figma and export a PNG and an SVG.

## Sitemap

```
Home
 |-- Browse Cooks (vendor list)
 |      '-- Cook profile / menu  (one per cook)
 |-- Browse Dishes (shop)
 |      |-- Cuisine category pages
 |      '-- Dish detail
 |-- Cart -> Checkout -> Order confirmation
 |-- My Account (login, orders)
 |-- Become a Cook (registration) -> Cook dashboard
 |-- Gallery
 |-- Blog (Cook of the Week, recipes)
 |-- About
 '-- Contact
```

## Wireframes to draw (low-fidelity)

1. **Home:** header (logo, search, cart, login) / hero + search bar / cuisine tiles / featured cooks (photo, name, cuisine, rating) / popular dishes / how it works (3 steps) / become-a-cook banner / footer with social icons.
2. **Cook profile:** banner / portrait + name + bio + hours / menu grid (photo, dish, price, Add) / reviews / contact.
3. **Dish list:** filter sidebar (cuisine, price, tags) / grid of dish cards, each with the cook's name.
4. **Cart/checkout:** items grouped by cook / delivery or pickup / total.
5. **Mobile versions** of 1 and 2.

Tools: pen and paper (photo it), Figma, or Balsamiq. Add them to the repo under `/design`.

## UX principles

- **Mobile-first.** Most users will be on phones. Thumb-friendly buttons of at least 44 px.
- **Max 3 taps** from Home to adding a dish to the cart.
- **Price visible** on every dish card. Never hide cost.
- **Cook visible** on every dish card (photo + name). This is the unique selling point.
- Plain language with a bit of Swahili ("Karibu", "Mapishi ya leo").
- Fast: compress images, aim for pages under 3 MB.
- Accessibility: alt text on images, contrast, labels on form fields, keyboard-friendly.

## Responsive targets

| Device | Width | Layout |
|---|---|---|
| Phone | 360-480 | 1 column dishes (or 2 small), hamburger menu |
| Tablet | 768 | 2-3 columns |
| Desktop | 1280+ | 3-4 columns, sidebar filters |

Test with Chrome DevTools device mode and on at least one real phone.
