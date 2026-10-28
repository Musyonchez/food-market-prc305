# 08 - Vendor Marketplace Setup (the core of the idea)

This is what delivers the client's request: **show who is cooking, their menu and their prices.**

## 1. Configure Dokan

**Dokan -> Settings.**

**General**
- Vendor store URL: `/cook/` (the default is `/store/`). Use "cook".
- Seller registration: **enabled**.
- New seller enable selling: **manual approval** at first (you control quality), or automatic during the demo.

**Selling options**
- New product status: **Published** (or "Pending" if the admin should approve).
- Allow vendors to **edit products and prices**.
- Order status change: allow vendors to mark orders as processing/completed.

**Withdraw / Commission** (document the model even if payouts stay manual)
- Admin commission: e.g. **10% per order**.
- Withdrawal methods: manual (PayPal/bank listed; M-Pesa handled manually in phase 1).

**Appearance**
- Store header layout with banner + profile picture + address + phone + rating.

## 2. Vendor registration page

Create a **Become a Cook** page (the Dokan registration form) with these fields:
- Name, kitchen name, phone, email, password
- Address / area (Westlands, Kilimani, Ruaka...)
- Cuisine specialty
- Short bio ("My story")

Add it to the footer and Home page with a button: **Start selling your food.**

## 3. Vendor store page (what customers see)

Each cook's page `/cook/<kitchen-name>/` shows:
- Banner photo + cook portrait
- Kitchen name, location, phone/contact, opening hours
- Short bio and cuisine
- **Full menu with prices** (the dishes)
- Ratings/reviews (if enabled)
- "Contact cook" form

**Editing the store:** Dokan Dashboard -> **Settings -> Store**.

## 4. Adding dishes (menu)

Cooks use the Dokan dashboard (**Products -> Add New**). Each dish needs:

| Field | Example |
|---|---|
| Title | Pilau Beef |
| Price | KSh 350 |
| Category | Swahili / Coastal |
| Photo | Square, at least 800x800 px, compressed |
| Short description | Spiced rice with tender beef, served with kachumbari |
| Tags | Halal, Spicy |
| Stock | In stock / limited portions |

**Tip:** Ask the client for **4-6 real cooks** (friends, relatives, local kitchens) plus photos, so the demo is real, not lorem ipsum.

## 5. Customer journeys to support

1. **By cuisine:** Home -> category -> dishes -> cook name on each card -> cook page.
2. **By cook:** Browse Cooks (vendor listing) -> store page -> menu -> add to cart.
3. **By search:** Search bar -> dish or cook.

For this to work:
- Show the **vendor name** on every product card (Dokan + theme setting "show sold by").
- Place a **Store List** page (`[dokan-stores]` shortcode) as the **Browse Cooks** page.
- On the shop page, enable filters: category, price slider, tags.

## 6. Orders

- A customer cart can hold dishes from several cooks. Dokan splits it into **sub-orders**, one per cook.
- Each cook sees only their own orders in their dashboard and gets an email.
- Admin sees all orders in WooCommerce.

**Note for the demo:** Mixed-cook carts mean separate delivery. You can limit this later with a "single vendor per order" option if the client prefers.

## 7. Demo accounts to create

| Role | Username | Use |
|---|---|---|
| Admin | (private) | You |
| Cook 1-5 | `cook_<name>` | Demo cooks with full menus |
| Customer | `demo_customer` | For the live demo |

Keep these credentials for the final presentation, but **don't publish them in the repo.**

## 8. Checklist

- [ ] Registration works and a new cook appears after approval
- [ ] A cook edits a price and the change shows on the site immediately
- [ ] Each product card shows the cook's name
- [ ] Browse Cooks lists all the cooks
- [ ] Orders appear in the right cook's dashboard
