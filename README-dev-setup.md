# dev.brockdonovan.com setup

This repo was on GitHub Pages, served from `master`, with DNS for
`brockdonovan.com` at Justhost pointing at GitHub's IPs. It's moving to
Cloudflare for native branch previews.

Cloudflare has been folding **Pages into the Workers platform**. Creating a
project via the dashboard's "Pages > Upload assets" flow actually provisions
a **Worker with static assets**, not a classic Pages project (confirmed by
wrangler itself refusing to deploy to it as a Pages project). So this repo
deploys as two such Workers instead of one Pages project with environments:

| Branch    | Worker name        | Domain                  |
|-----------|---------------------|--------------------------|
| `master`  | `personalsite`      | `brockdonovan.com`, `www.brockdonovan.com` |
| `add-dev` | `personalsite-dev`  | `dev.brockdonovan.com`  |

`.github/workflows/cloudflare-deploy.yml` deploys on every push to either
branch, using `wrangler.toml` (static-assets config, `directory = "."`) and
`.assetsignore` (keeps `.git`, `.github`, and the wrangler-action's own
`node_modules` install out of the uploaded assets).

## Status

- [x] Cloudflare account created, `brockdonovan.com` zone added, nameservers
      switched from Justhost to Cloudflare (`sofia`/`rommy.ns.cloudflare.com`)
      — zone active.
- [x] `CLOUDFLARE_API_TOKEN` / `CLOUDFLARE_ACCOUNT_ID` repo secrets added.
- [x] `add-dev` push deploys clean to Worker `personalsite-dev`, confirmed
      live at `https://personalsite-dev.brockdonovan.workers.dev/`.
- [x] Custom domain `dev.brockdonovan.com` attached to `personalsite-dev`
      (Production), confirmed loading in browser.
- [ ] `master` merged/pushed with this same workflow, confirmed deploying
      clean to Worker `personalsite`.
- [ ] Custom domains `brockdonovan.com` / `www.brockdonovan.com` attached to
      `personalsite` (this is the actual prod cutover — do this deliberately,
      not as a side effect of an unrelated push).
- [ ] Old GitHub Pages site disabled (repo Settings > Pages) once the above
      is confirmed working, and the now-unused `CNAME` file removed.

## Remaining manual steps

### Attach dev.brockdonovan.com (safe to do now)

Dashboard > Workers & Pages > `personalsite-dev` > **Settings** > **Domains &
Routes** > **Add** > **Custom Domain** > enter `dev.brockdonovan.com` > Add.
Cloudflare creates the DNS record itself since the zone is already here.
Give it a minute, then check `https://dev.brockdonovan.com`.

### Cut prod over (do deliberately, this is the live site)

1. Merge/push `add-dev`'s workflow + `wrangler.toml` + `.assetsignore` to
   `master` so pushes there start deploying the `personalsite` Worker.
2. Confirm that deploy succeeded and `https://personalsite.workers.dev`
   (or whatever subdomain Cloudflare assigns it) actually looks right.
3. Only then: `personalsite` > Settings > Domains & Routes > add
   `brockdonovan.com` and `www.brockdonovan.com`. This is the moment the
   live site switches from GitHub Pages to this Worker.
4. Once confirmed, disable GitHub Pages (repo Settings > Pages) and delete
   the `CNAME` file in a follow-up commit.

## Day-to-day workflow once this is fully wired up

- Work on `add-dev` (or branch off it), push, check `https://dev.brockdonovan.com`.
- Merge `add-dev` into `master` when it looks right — that push deploys to
  `https://brockdonovan.com`.
