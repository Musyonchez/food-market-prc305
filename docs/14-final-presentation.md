# 14 - Final Presentation (24 Nov, 10-15 minutes)

## Submission pack

1. Live URL (InfinityFree)
2. GitHub repo link
3. Final slides

## Time plan (about 13 minutes + Q&A)

| Min | Section | Content |
|---|---|---|
| 0-1 | Introduction | Name, tagline, the client's idea (quote the Swahili line) |
| 1-2 | Background and objectives | The Glovo gap and the problem statement |
| 2-4 | Design process and UX | Persona, sitemap, wireframes -> final design; palette and type |
| 4-5 | Tech stack and approach | WordPress, WooCommerce, Dokan, InfinityFree, and why |
| 5-10 | **Live demo** | See script below |
| 10-11 | Challenges and solutions | See list below |
| 11-12 | Recommendations and future work | M-Pesa, rider integration, mobile app, reviews |
| 12-13 | Conclusion | Recap in 3 bullets |
| 13+ | Q&A | |

## Live demo script (rehearse until it takes 5 minutes)

1. **Home** on the phone, then the laptop (shows responsiveness).
2. Click a cuisine -> see dishes with price and cook name.
3. Open **a cook's profile**: story, menu, prices. *This is the unique selling point.*
4. Add 2 dishes -> checkout (COD) -> order confirmation.
5. Switch to the **cook dashboard** (second browser profile): the new order appears. Then edit a price and refresh the public page to show the change.
6. Show **Become a Cook** registration and admin approval (quickly).
7. **Contact form**: submit invalid, then valid, then show the email arriving.
8. Show the social links and the footer. Mention the GitHub repo.

Keep a **screen recording** of the whole flow as a backup in case Wi-Fi or the host fails.

## Challenges and solutions (examples, so replace with your real ones)

| Challenge | Solution |
|---|---|
| Free hosting limits and slow pages | Few plugins, image compression, caching |
| PHP `mail()` unreliable on InfinityFree | WP Mail SMTP with Gmail app password |
| Cooks have little tech skill | Simple Dokan dashboard + one-page how-to guide |
| M-Pesa needs a business account and callbacks | COD/pickup + WhatsApp order link now, M-Pesa planned |
| Different cooks in one cart | Dokan sub-orders, one per cook |

## Likely Q&A

- *How do cooks get paid?* Phase 1: directly (cash/M-Pesa); the admin commission is tracked in Dokan. Automated payouts are future work.
- *How do you make money?* A commission per order or a featured-cook fee.
- *How is it different from Glovo?* It puts the cook, the menu and the price first.
- *Food safety?* Cooks agree to the T&Cs. Hygiene verification is a future step.
- *Is this your own code?* WordPress with open-source plugins plus a custom child theme. Everything is credited in the README.
- *What if traffic grows?* Move to paid hosting; the backup file makes migration easy.

## Slide outline (about 10-12 slides)

Title - Introduction - Problem and objectives - Users and UX - Design process - Tech stack - Demo (a divider slide) - Challenges - Results and screenshots - Recommendations - Conclusion - Q&A (with the live URL and QR code)

## Tips

- Dress and speak as if pitching to the client.
- Show the URL on a slide and as a QR code.
- Know your site. Individual performance is evaluated independently.
