# 12 - Testing and Launch Checklist

Run this in full on **18-19 Nov**, and run a smoke test again on 23 Nov.

## Functional

- [ ] Home loads with all sections, and every link works (no 404s)
- [ ] Menu links all work on desktop and mobile
- [ ] Browse Cooks lists every cook; each cook page shows bio, menu and prices
- [ ] Dish cards show the price and the cook's name
- [ ] Category filter, price filter and search return correct results
- [ ] Add to cart -> change quantity -> remove -> checkout
- [ ] Place an order as a customer with COD; the order appears in the admin and in the right cook's dashboard
- [ ] Order emails reach the customer, the admin and the cook
- [ ] A cook can log in, add a dish, change a price and unpublish a dish
- [ ] New cook registration works, and approval works
- [ ] Contact form: empty submit shows errors, a bad email is rejected, a valid submit sends mail and shows a success message
- [ ] Social links open the correct pages; at least 2 platforms
- [ ] Gallery and Blog display properly
- [ ] Customer login, logout and password reset work

## Responsive and design

- [ ] 360 px, 768 px and 1280 px in DevTools: no horizontal scroll, no overlapping text
- [ ] Tested on a real Android phone and one other device
- [ ] Buttons are tappable, text at least 16 px on mobile
- [ ] Fonts, colours and spacing are consistent across all pages
- [ ] Images are sharp but compressed (each under about 200 KB)
- [ ] Favicon and logo show everywhere

## Browsers

Chrome, Edge, Firefox and Safari/iOS if available.

## Performance and quality

- [ ] Run Google PageSpeed Insights on Home (target 60+ mobile on free hosting)
- [ ] No console errors on key pages (DevTools -> Console)
- [ ] No mixed-content (http) warnings; padlock shows
- [ ] No lorem ipsum, no "Sample page", no test products left over

## Accessibility quick pass

- [ ] Alt text on images
- [ ] Form labels present
- [ ] Contrast is readable (check with WebAIM contrast checker)
- [ ] Can tab through the main navigation

## Content and legal

- [ ] Spelling and grammar checked
- [ ] Prices in KSh, consistent format (KSh 350)
- [ ] Privacy and Terms pages published
- [ ] Image credits given for stock photos
- [ ] Client has approved the content and the use of cooks' names and photos

## Launch day (24 Nov)

- [ ] Fresh backup exported (All-in-One WP Migration) and saved off-site
- [ ] Log into InfinityFree and confirm the account is active
- [ ] Open the live URL on **phone data** and on the laptop you will present with
- [ ] Demo accounts logged in on separate browser profiles (customer / cook / admin)
- [ ] Internet fallback ready: phone hotspot, screenshots and a short screen recording in case the host is slow
- [ ] Submit: live URL, GitHub link, slides
- [ ] After submission: keep the site online until grading is complete
