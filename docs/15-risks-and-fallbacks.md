# 15 - Risks and Fallbacks

| # | Risk | Likelihood | Impact | Mitigation / fallback |
|---|---|---|---|---|
| 1 | **Concept presentation date (27 Oct) already passed** | Happened | High (25% of grade) | Email the instructor today. Ask for a slot, or whether the slides can be submitted with the final. Build the slides (doc 04) now |
| 2 | InfinityFree suspends the account or the site is slow | Medium | High | Cache + compress; few plugins; keep a recent backup; check the Client Area often. Last-resort fallback: ask the instructor for permission to use another free host |
| 3 | A plugin (Dokan/WooCommerce) fails on free hosting | Medium | High | Test right after each install. Fallback: **WCFM Marketplace** or **WC Vendors**. Last resort: single-store WooCommerce with a "Cook" custom taxonomy and one custom page per cook (still shows who/menu/price) |
| 4 | Emails not delivered | High | Medium | WP Mail SMTP (doc 11). Show the order in the admin if mail fails during the demo |
| 5 | Client does not provide photos/cooks in time | Medium | Medium | Set a hard date (4 Nov). Use friends or family as demo cooks and licensed stock images; label demo data |
| 6 | M-Pesa integration takes too long | High | Low | It's a stretch goal. Use COD, pickup and WhatsApp ordering |
| 7 | Scope creep from the client | Medium | Medium | Agree on the scope in writing (doc 02). New asks go into "Phase 2" |
| 8 | Not enough time (27 days) | Medium | High | Follow doc 03; freeze features 17 Nov; cut the blog and gallery first |
| 9 | Site breaks after an update | Low | High | No updates after 20 Nov. Export a backup before any change |
| 10 | Demo fails live (Wi-Fi, host) | Medium | High | Phone hotspot, screen recording, screenshots, rehearsal on 23 Nov |
| 11 | Plagiarism flag | Low | High | Credit all assets; keep a commit history; write original content |
| 12 | Using the client's cooks' photos/names without consent | Medium | Medium | Get written (WhatsApp is fine) permission |

## Client management

- Confirm the **business model** (commission? free listing?) and the **name** in the first week.
- Agree who owns the site and domain after the course. Decide before handover whether to move to paid hosting.
- Send a weekly update link. Early feedback prevents last-week rewrites.
- Note that the academic requirements (InfinityFree, individual work, 24 Nov) come first. Explain this to the client.

## If we are far behind: minimum viable version

Must-have: Home, About, Contact (working), Browse Cooks, 3 cooks with menus and prices, cart + COD checkout, 2 social links, responsive, live URL, GitHub, slides.
Cut first: blog, gallery, reviews, M-Pesa, Instagram feed.
