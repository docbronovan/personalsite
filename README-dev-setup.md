# dev.brockdonovan.com setup

This site was on GitHub Pages, served from `master`, with DNS for
`brockdonovan.com` at Justhost pointing at GitHub's IPs. It now runs on
Cloudflare, which gives it native branch-based previews.

Cloudflare has been folding **Pages into the Workers platform**. Creating a
project via the dashboard's "Pages > Upload assets" flow actually provisions
a **Worker with static assets**, not a classic Pages project (confirmed by
wrangler itself refusing to deploy to it as a Pages project). So this repo
deploys as two such Workers instead of one Pages project with environments:

| Branch    | Worker name         | Domain                                      |
|-----------|----------------------|----------------------------------------------|
| `master`  | `personalsite`       | `brockdonovan.com`, `www.brockdonovan.com`  |
| `add-dev` | `personalsite-dev`   | `dev.brockdonovan.com`                      |

`.github/workflows/cloudflare-deploy.yml` deploys on every push to either
branch, using `wrangler.toml` (static-assets config, `directory = "."`) and
`.assetsignore` (keeps `.git`, `.github`, and the wrangler-action's own
`node_modules` install out of the uploaded assets).

## Status: cutover complete

- Cloudflare account/zone set up, nameservers moved off Justhost.
- `CLOUDFLARE_API_TOKEN` / `CLOUDFLARE_ACCOUNT_ID` added as repo secrets.
- `dev.brockdonovan.com` → `personalsite-dev` Worker, confirmed live.
- `brockdonovan.com` / `www.brockdonovan.com` → `personalsite` Worker,
  confirmed live (old GitHub Pages DNS records removed from the Cloudflare
  zone first, since they conflicted with the Worker custom domain).
- Old GitHub Pages deployment disabled, `CNAME` file (GitHub Pages' config
  for a custom domain, no longer used) removed.

GitHub Pages is fully out of the picture.

## Day-to-day workflow

- Work on `add-dev` (or branch off it), push, check it at
  `https://dev.brockdonovan.com`.
- Merge `add-dev` into `master` when it looks right — that push deploys to
  `https://brockdonovan.com`.

## If something needs fixing

- Deploy logs: GitHub repo → **Actions** tab → "Deploy to Cloudflare Workers
  (static assets)".
- Worker logs/metrics: Cloudflare dashboard → **Workers & Pages** →
  `personalsite` or `personalsite-dev` → **Observability**.
- DNS records: Cloudflare dashboard → the `brockdonovan.com` zone → **DNS**.
