# 06 - InfinityFree Hosting Setup

Target: a live WordPress install on a public URL (about 1-2 hours).

## 1. Create the account

1. Go to https://www.infinityfree.com/ and click **Sign Up**.
2. Use a stable email (`bioagrosoln@gmail.com` or a dedicated project email). Confirm it.
3. Log in to the **Client Area**.

## 2. Create the hosting account

1. Client Area -> **Create Account**.
2. Choose a **free subdomain** (e.g. `mapishi` + the offered suffix) or connect a custom domain if the client has bought one.
3. Set a hosting-account label (e.g. "Food Market PRC305") and a password.
4. Wait for status **Active**. This can take a few minutes.

> Record the credentials (control panel user, FTP host/user/pass, MySQL host) in a **private** password manager. **Never commit them to GitHub.**

## 3. Enable SSL

- Client Area -> **Free SSL Certificates** -> request one for the domain. Complete the verification steps it gives you.
- Once issued, install it from the control panel (it can take some minutes to hours).
- Then set WordPress URLs to `https://` and force HTTPS (Really Simple SSL plugin or `.htaccess`).

## 4. Install WordPress

**Option A: Softaculous (easiest)**
1. Open the **Control Panel** (vPanel) for the account.
2. Find **Softaculous Apps Installer** -> **WordPress** -> **Install**.
3. Set the protocol (`https://` once SSL is active), leave the directory blank to install at the root, then choose the site name, admin username (**not** `admin`), a strong password and the admin email.
4. Click **Install**.

**Option B: Manual**
1. Control Panel -> **MySQL Databases** -> create a database.
2. Download WordPress from wordpress.org.
3. Upload it to `htdocs/` via the File Manager or FTP (FileZilla).
4. Visit the domain and run the 5-minute installer with the DB details.

## 5. First login

`https://<your-domain>/wp-admin` -> log in -> **Settings -> General**: set the site title, tagline ("Know who's cooking"), timezone **Nairobi**, and the date format.

## 6. Hosting checks

- [ ] Site loads over HTTPS
- [ ] `/wp-admin` works
- [ ] **Settings -> Permalinks** set to **Post name**
- [ ] Upload a test image (confirms uploads work)
- [ ] Note the PHP version (Control Panel -> PHP Config); use 8.x if offered

## 7. Keep it alive

The brief says the site must stay online until grading is complete.
- Log in to the InfinityFree Client Area from time to time so the account stays active.
- InfinityFree can suspend accounts that exceed hit limits. Cache and compress images to stay under them.
- Don't delete the account after submission.

## Troubleshooting

| Problem | Fix |
|---|---|
| "Account suspended" | Check Client Area for the reason; reduce traffic; reactivate |
| Installer stuck | Use manual install |
| Mixed-content warnings after SSL | Run Better Search Replace to change `http://` to `https://` |
| Emails not arriving | Use WP Mail SMTP (doc 11) |
| 508 / resource limit errors | Disable heavy plugins; enable caching |
