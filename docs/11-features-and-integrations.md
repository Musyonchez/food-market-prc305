# 11 - Features and Integrations

## 1. Contact form with validation

1. Install **Contact Form 7** (or WPForms Lite).
2. Build the form (CF7 example):

```
<label>Your name (required)
  [text* your-name] </label>
<label>Email (required)
  [email* your-email] </label>
<label>Phone
  [tel your-phone] </label>
<label>Subject
  [select* subject "Order help" "Become a cook" "Partnership" "Other"] </label>
<label>Message (required)
  [textarea* your-message minlength:10] </label>
[submit "Send message"]
```

3. Set **Mail** tab -> To: the client's email; Reply-to: `[your-email]`.
4. Add a spam guard: CF7 Honeypot plugin, or Google reCAPTCHA v3.
5. Customise the success and error messages.
6. Put the shortcode on the Contact page.

## 2. Reliable email (SMTP)

InfinityFree's PHP `mail()` often fails, so use a real mail account.

1. Install **WP Mail SMTP**.
2. Use a **Gmail** account with an **App Password** (needs 2-Step Verification) or **Brevo/SendGrid free tier**.
3. SMTP host `smtp.gmail.com`, port 587 (TLS) or 465 (SSL), plus username and app password.
4. Send the plugin's **test email**. Fix this before testing the contact form or orders.

> Never put SMTP passwords in the repo.

## 3. Ordering flow

| Option | Effort | Notes |
|---|---|---|
| **Cash on delivery / pay on pickup** | Done by default | Recommended for the demo |
| **Bank transfer** | Done by default | Manual confirmation |
| **M-Pesa (Daraja STK Push)** | High | Needs a Safaricom Daraja account, a Paybill/Till, a public HTTPS callback URL, and a WooCommerce M-Pesa plugin (several free/paid ones exist). Can be tested on the sandbox |
| **WhatsApp order button** | Low | A "Order on WhatsApp" link with a pre-filled message to the cook; very Kenyan, and good for the demo |

**Recommendation:** go live with COD + pickup and add a WhatsApp order link per cook. Treat M-Pesa as a stretch goal after Milestone 3, and show it on the sandbox or in the "Future work" slide if live payments are not ready.

WhatsApp link format: `https://wa.me/2547XXXXXXXX?text=Hi%20I%20want%20to%20order%20...`

## 4. Delivery

- Flat fee within Nairobi, set in WooCommerce zones (doc 07).
- Pickup is free.
- Delivery by the cook or the cook's rider in phase 1. Say so in the T&Cs.

## 5. Ratings and reviews

- Enable product reviews in WooCommerce and Dokan store reviews.
- Seed a few honest demo reviews from testers. Don't fabricate reviews as if they were real customers. Label demo data as demo if asked.

## 6. Search and filters

- Built-in WooCommerce product search in the header.
- Filters on the shop page by category, price and tags. The default Woo filter blocks are enough.

## 7. Notifications

- WooCommerce new-order email to admin; Dokan new-order email to the cook.
- Customise the email header with the logo and brand colour (WooCommerce -> Settings -> Emails).

## 8. Basic security

- Strong admin password, username other than `admin`.
- Keep WordPress and plugins updated.
- Limit login attempts (Limit Login Attempts Reloaded).
- Don't leave debug mode on.

## 9. Analytics (optional)

Google Site Kit or a simple GA4 tag. Useful for the presentation ("X visits during testing").
