# 17 - Client Setup Guide: from GitHub link to a live food marketplace

This guide takes you from "I was sent a GitHub link" to a **live website** where cooks list their menus and prices and customers can order. No prior experience is needed. Every technical word is explained the first time it appears, and again in the glossary at the end.

**Time needed:** about 1.5 to 2 hours, once. You don't need to write any code. The coding is done, and what's left is **connecting** the site to your own accounts (email, WhatsApp, social media, photos).

---

## Part 0: What you are getting

A website called **Mapishi Market** (you can rename it) where:

- Each **cook** has their own page with a photo, a story, a menu and prices.
- **Customers** browse by cuisine or by cook, add dishes to a cart and place an order.
- Each cook has a **dashboard** (a private control page) where they add dishes and change prices themselves.
- It runs on **WordPress** with two add-ons, **WooCommerce** (the shop) and **Dokan** (turns one shop into a marketplace of many cooks).

### How the pieces fit

| Piece | What it is, in plain words |
|---|---|
| **Hosting** (InfinityFree) | A computer that is always on and connected to the internet. Your website's files live on it. |
| **WordPress** | Free software that runs on the hosting and builds your site. Think of it as the "engine". |
| **Theme** | The look of the site: colours, fonts, layout. Ours is called *Mapishi Child*. |
| **Plugin** | An add-on that gives WordPress a new ability (shop, contact form...). |
| **GitHub** | A website where programmers store project files. You were sent a link to ours. |
| **wp-admin** | The private control room of your site, at `your-site.com/wp-admin`. |

---

## Part 1: Before you start - gather these

| You need | Why | Cost |
|---|---|---|
| An email address you check daily (Gmail is fine) | Account sign-ups and order notifications | Free |
| A computer (not just a phone) | Uploading files is much easier | - |
| Your **WhatsApp number**, **phone** and **business email** | Shown on the Contact page | - |
| Social media pages (Facebook, Instagram...) | Linked in the footer. Create empty ones now if you don't have any | Free |
| A **password manager** or a notebook kept safe | You will create several passwords. Never reuse them | Free |

> **Rule of thumb:** use a **different, long password** for every account (at least 14 characters). Never paste passwords in chats or emails. Never use `password123`.

---

## Part 2: Get the project files from GitHub

**GitHub** is a website where programmers keep project files. A **repository** (or "repo") is one project's folder on GitHub.

1. Open the link you were sent (it looks like `https://github.com/Musyonchez/food-market-prc305`). If it says *404 Not Found*, the repo is **private**. Ask the developer to add your GitHub account to it, or to send you the two zip files directly.
2. Click the green **Code** button, then **Download ZIP**.
3. Find the downloaded file (usually in Downloads) and **extract** it (right-click, *Extract All*). A **zip** is a compressed folder, and extracting turns it back into a normal folder.
4. Open the extracted folder and go into the **releases** folder. You need exactly two files:
   - `mapishi-child.zip` - the **theme** (the look)
   - `mk-seed.zip` - a **setup helper plugin** (installs the other plugins and creates the starter content)

> **Important:** do **not** extract these two files. WordPress wants them as zips.

Other folders (`docs`, `scripts`, `wp-content`) are for developers. You can ignore them.

---

## Part 3: Create your hosting account (InfinityFree)

1. Go to https://www.infinityfree.com/ and click **Sign Up**. Use your email and confirm it.
2. In the **Client Area**, click **Create Account**.
3. Choose **Subdomain** and type a name, e.g. `mapishi`. A **subdomain** is a free web address ending in the host's domain, such as `mapishi.infinityfreeapp.com`. (Later you can buy your own, like `mapishi.co.ke`, if you wish.)
4. Give the account a label (for example "Food Market") and set a password.
5. Wait until the status says **Active**. This takes a few minutes.

You now have an empty website address. Next we put WordPress on it.

---

## Part 4: Install WordPress

**Installing** means copying WordPress's files onto your hosting. A tool called **Softaculous** does it in a few clicks.

1. In the Client Area, open your hosting account and click **Control Panel** (also called cPanel or vPanel). This is the hosting's own control room.
2. Find **Softaculous Apps Installer** and click **WordPress**, then **Install**.
3. Fill in the form:
   - **Protocol:** `http://` (we upgrade to secure `https://` in Part 8)
   - **Domain:** your subdomain. Leave **In Directory** empty.
   - **Site Name:** Mapishi Market
   - **Admin Username:** pick something other than `admin` (hackers try `admin` first)
   - **Admin Password:** a **strong, unique** password (use the key icon to generate one, then save it in your password manager)
   - **Admin Email:** your **real** email. Password resets are sent here
4. Click **Install** and wait for the success message.

---

## Part 5: Log in for the first time

1. Go to `http://YOUR-SUBDOMAIN.infinityfreeapp.com/wp-admin`.
2. If you see a page saying *"checking your browser"* or *"JavaScript required"*, wait a few seconds. This is the host's bot-protection, and it is normal.
3. Log in with the username and password you chose. You should see the **Dashboard**.
4. Click **Dashboard, then Updates**. If WordPress offers an update, click it. Updates fix security holes.

> **wp-admin** means "WordPress administration". Everything below happens here.

---

## Part 6: Install the theme

A **theme** controls how the site looks. Our theme is a **child theme** of a free, popular theme called **Astra**. A *child theme* adds our changes on top of its **parent** (Astra), so Astra must be installed first.

1. **Appearance, then Themes, then Add New Theme.**
2. Search **Astra**, click **Install**. **Do not click Activate.**
3. Click **Upload Theme** (top of the page), then **Choose File**, select `mapishi-child.zip`, and click **Install Now**.
4. Click **Activate**.

**If you see "Incompatible Archive":** you probably selected the wrong file, or a folder you extracted. Select the `.zip` file itself.

---

## Part 7: Install the setup helper and create the starter content

The helper plugin installs the other add-ons for you, then fills the site with starter content so it is not empty.

1. **Plugins, then Add New Plugin, then Upload Plugin.**
2. Choose `mk-seed.zip`, click **Install Now**, then **Activate Plugin**.
3. Go to **Tools, then Mapishi Seed**.
4. **Step 1, required plugins:** click the **Install next** button. It installs one plugin per click and can take up to a minute. Click again until all boxes are ticked. If a click shows an error, wait a minute and click again.
5. **Step 2, demo content:** click **Run seed**. **Wait** and don't refresh or close the tab. It creates 5 sample cooks, 16 dishes, pages, menus and a contact form.
6. If a setup wizard appears for WooCommerce, Dokan or another plugin, always choose **Skip** or **Not right now**. The helper has already set what is needed.
7. When it's done, go to **Plugins** and **Deactivate**, then **Delete** the *Mapishi Seed* plugin. You don't need it any more.
8. Visit your site address. You should see the Mapishi Market home page with cuisines, cooks and dishes.

> **Demo cooks:** the sample cooks (Mama Amina, Baba Otieno, ...) are made-up examples so the site looks alive. Their logins have random passwords nobody knows. In Part 9.4 you replace them with real cooks.

---

## Part 8: Make the site secure (HTTPS)

**HTTPS** (the padlock in the browser) means traffic between your visitors and your site is encrypted. Browsers warn visitors away from sites without it, and customers will not enter their details.

1. Try opening `https://YOUR-SUBDOMAIN.infinityfreeapp.com` (note the **s**). If the padlock appears, skip to step 3.
2. If it fails, go to the InfinityFree Client Area, find **Free SSL Certificates**, request one for your domain and follow the on-screen steps. It can take from minutes to a few hours.
3. In wp-admin go to **Settings, then General**. Change **both** "WordPress Address" and "Site Address" from `http://` to `https://`. Click **Save Changes**, then log in again.

---

## Part 9: Connect your own details (the part only you can do)

This is the "connecting" work: telling the site your email, phone, social pages and real cooks.

### 9.1 Contact details and social media

1. **Appearance, then Customize.**
2. Open **Mapishi Contact and Social**.
3. Fill in: contact email, phone, **WhatsApp number**, and your Facebook, Instagram, YouTube, TikTok and X links. Leave unused ones empty. Only networks with a link are shown.
   - WhatsApp must be in **international format without + or spaces**: `254712345678` (not `0712345678`).
4. Click **Publish**.

You will see the contact details on the **Contact** page and the social links in a green bar above the footer. The brief for this project requires at least **two** social platforms.

### 9.2 Make email work

By default, free hosting sends email badly, so order notifications and contact messages can silently disappear. We fix that by sending mail through your own Gmail.

1. Sign in to the Google account you want to send from. Open **Manage your Google Account, then Security**, and turn on **2-Step Verification** (a code on your phone when you sign in).
2. Still under Security, search for **App passwords**. Create one named "Mapishi". Google shows a **16-character code once**. Copy it.
3. In wp-admin open **WP Mail SMTP, then Settings**. **SMTP** is the standard way programs send email through an email provider.
   - **From Email:** your Gmail address. **From Name:** Mapishi Market.
   - **Mailer:** *Other SMTP*.
   - **SMTP Host:** `smtp.gmail.com`. **Encryption:** TLS. **Port:** `587`.
   - **Authentication:** on. **Username:** your Gmail address. **Password:** the 16-character app password (not your normal password).
4. Save, then open **WP Mail SMTP, then Tools, then Email Test**. Send a test to yourself. If it arrives, email works.
5. Open the **Contact** page and send a message to confirm it reaches your inbox.

### 9.3 Name, tagline and logo

- **Settings, then General:** change **Site Title** and **Tagline** if you want a different name.
- A default logo and icon are already built in. To use your own, go to **Appearance, then Customize, then Site Identity** and upload a logo (PNG or JPG) and a **Site Icon**, the small image in the browser tab (at least 512x512 pixels).

### 9.4 Replace the demo cooks with real cooks

1. Each real cook goes to your site's **My account** page and registers, choosing **I am a vendor** ("vendor" = seller). They enter their kitchen name and phone.
2. You approve them: **Dokan, then Vendors**. Enable selling for the new cook.
3. The cook now has a dashboard at `your-site/dashboard/` where they add dishes: **Products, then Add New**, with a name, **price in KSh**, **category** (cuisine), photo and short description.
4. When a few real cooks are in, delete the demo ones: **Users**, filter by role **Vendor**, delete those named `cook_amina`, `cook_otieno`, `cook_priya`, `cook_luca`, `cook_wanjiru`. WordPress asks what to do with their content, so choose **Delete all content**.

**To demo the cook dashboard without a real cook:** **Users, then Edit** a demo cook, click **Set New Password**, and use it for your demo.

### 9.5 Photos (important for a food site)

- Every dish should have a real photo. Until then, a branded "Photo coming soon" picture is shown.
- Good photos are **square**, at least **800x800 pixels**, in daylight, close to the food.
- Compress photos before uploading (the **Smush** plugin does it automatically). Small images make the site fast.
- Only use photos you took or have permission for. If you use stock photos (Unsplash, Pexels), credit them in the footer or About page.
- Each cook also adds their own **profile picture and banner** in their dashboard under **Settings, then Store**.

### 9.6 Delivery fees and how customers pay

- **WooCommerce, then Settings, then Shipping:** the Nairobi delivery fee is set to **KSh 150**, and free pickup is available. Change it to what your cooks charge.
- **WooCommerce, then Settings, then Payments:** customers can **pay on delivery or pickup** (cash or M-Pesa handed to the cook). That is the simplest option and works with no extra setup.
- **Online M-Pesa payment** (the customer pays inside the site) needs a Safaricom **Daraja** business account and an extra plugin. It's a "phase 2" upgrade. Ask your developer before attempting it.

### 9.7 Your admin account and demo logins

- **Users, then Profile:** confirm your email is real, and set a strong password.
- Never share your admin login. If someone helps you, create them a separate account under **Users, then Add New**.

---

## Part 10: Test it like a customer

Open the site on your **phone** (on mobile data, not only on Wi-Fi), then on a computer.

- [ ] Home page loads, and the logo and colours show
- [ ] Menu links work: Browse Cooks, Browse Dishes, Blog, About, Contact
- [ ] Open a cook page: bio, menu and prices show
- [ ] Add two dishes to the cart, check out with **Pay on delivery / pickup**
- [ ] You get an order email, and the cook sees the order in their dashboard
- [ ] Contact form: empty submit shows errors, a real message arrives in your inbox
- [ ] Social links open the right pages
- [ ] The padlock shows, and there are no browser warnings

The longer checklist is in `docs/12-testing-and-launch.md`.

---

## Part 11: Keeping it healthy

- **Backups:** install the **All-in-One WP Migration** plugin and use **Export, then File** once a month and before any big change. Keep the file on your computer.
- **Updates:** WordPress, themes and plugins release updates. Do them every couple of weeks, **after** making a backup. If the site breaks after an update, restore the backup.
- **Stay active:** free hosting can suspend accounts that are never used or get too much traffic. Log in to InfinityFree now and then. If the site grows, move to a paid plan.
- **Support:** keep your hosting login, wp-admin login, Gmail app password and the dates of your backups in your password manager.

---

## Troubleshooting

| Problem | What to try |
|---|---|
| "Incompatible Archive" when uploading | Upload the **.zip** itself, not the extracted folder. Re-download from `releases/` |
| White screen after installing a plugin | Wait a minute and reload. If it persists, in the hosting File Manager rename the plugin's folder under `wp-content/plugins` to deactivate it |
| "Briefly unavailable for scheduled maintenance" | Wait 2 minutes, then refresh |
| Setup helper shows an error or timeout | Wait a minute and click the same button again. It is safe to repeat |
| Emails don't arrive | Redo 9.2. Check Spam. Use the **app password**, not your normal password |
| Page looks unstyled or old | Hard refresh: `Ctrl + Shift + R`. If WP Super Cache is on, clear it |
| Padlock missing or "not secure" | Redo Part 8. Make sure the URLs under Settings, then General start with `https://` |
| Can't log in | Use **Lost your password?** on the login page (needs working email) |
| Site shows "Account suspended" | Open the InfinityFree Client Area and read the reason |

---

## Glossary

| Word | Meaning |
|---|---|
| **Admin / wp-admin** | The private control room of a WordPress site |
| **App password** | A one-time password Google gives a program so it can send email without your real password |
| **Cache** | A saved copy of a page so it loads faster |
| **CMS** | Content Management System: software like WordPress that lets you edit a site without coding |
| **cPanel / Control Panel** | The hosting company's control room (files, databases, installers) |
| **Domain / subdomain** | A web address. A subdomain is a free one that belongs to the host |
| **Extract / unzip** | Turn a `.zip` file back into a normal folder |
| **FTP** | A way to copy files to your hosting. Not needed in this guide |
| **GitHub / repository** | A website for storing project files, and one project's folder on it |
| **Hosting** | An always-on computer where your site lives |
| **HTTPS / SSL** | Encryption for web traffic, shown by the padlock |
| **Plugin** | An add-on for WordPress |
| **Theme / child theme** | The look of the site. A child theme adds changes on top of a parent theme |
| **SMTP** | The standard way to send email through a provider like Gmail |
| **Vendor** | A seller. On this site, a cook |
| **WooCommerce** | Free shop software for WordPress |
| **Dokan** | A WooCommerce add-on that lets many sellers share one shop |
| **WordPress** | The free website software that runs the site |

---

## Quick reference: what lives where

| I want to... | Go to |
|---|---|
| Change phone, email or social links | Appearance, then Customize, then Mapishi Contact and Social |
| Edit a page's text | Pages, then pick the page, then Edit |
| Add a blog post | Posts, then Add New |
| See orders | WooCommerce, then Orders |
| Approve or manage cooks | Dokan, then Vendors |
| Change delivery fee | WooCommerce, then Settings, then Shipping |
| Edit the menus at the top and bottom | Appearance, then Menus |
| Back up the site | All-in-One WP Migration, then Export |
