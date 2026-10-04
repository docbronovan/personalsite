# dev.brockdonovan.com setup (one-time, manual)

This repo is currently served by GitHub Pages from `master`, with DNS for
`brockdonovan.com` at Justhost pointing to GitHub's IPs. To get a working
dev preview at `dev.brockdonovan.com` that tracks the `add-dev` branch, this
repo is moving to Cloudflare Pages (chosen for native per-branch preview
domains). The steps below are dashboard/registrar actions nobody but you can
do — I don't have access to your Cloudflare or Justhost accounts.

The `.github/workflows/cloudflare-pages.yml` workflow in this repo already
does its part: on every push to `master` or `add-dev` it deploys this repo's
files to a Cloudflare Pages project named `personalsite`. It needs the steps
below done first, or the Action will fail on `apiToken`/`accountId`.

## 1. Cloudflare account + zone

1. Sign up at https://dash.cloudflare.com (free plan).
2. Add `brockdonovan.com` as a site. Cloudflare scans existing DNS and shows
   you the records it found (there's no email/MX on this domain today, so
   this should just be the apex `A` records and `www` CNAME to GitHub Pages).
3. Cloudflare gives you two nameservers (e.g. `xxx.ns.cloudflare.com`). At
   Justhost/Bluehost's domain panel, replace `NS1.JUSTHOST.COM` /
   `NS2.JUSTHOST.COM` with those two. Propagation is usually under an hour,
   can take up to 24h. **Site stays up on GitHub Pages during this** — don't
   change the A/CNAME records yet.

## 2. Cloudflare Pages project (direct upload)

1. Dashboard > Workers & Pages > Create > Pages > **Upload assets** (not
   "Connect to Git" — the GitHub Action does the deploying, so we don't want
   Cloudflare's own Git integration double-deploying).
2. Name the project `personalsite` (must match `projectName` in the workflow
   file).
3. Skip the initial manual upload prompt if offered — the Action will push
   the first real deploy.

## 3. API token + repo secrets

1. Dashboard > My Profile > API Tokens > Create Token > **Edit Cloudflare
   Workers** template (covers Pages) scoped to your account, or a custom
   token with `Account.Cloudflare Pages: Edit`.
2. Copy your Account ID (shown on the right side of any zone's Overview page
   or Workers & Pages home).
3. In GitHub: repo Settings > Secrets and variables > Actions, add:
   - `CLOUDFLARE_API_TOKEN`
   - `CLOUDFLARE_ACCOUNT_ID`

## 4. Push and verify preview deploys

1. Push a commit to `add-dev` (or push this branch as-is). The Action should
   run and create a deployment in the Pages project, reachable at an
   auto-generated URL like `add-dev.personalsite.pages.dev`.
2. Push/merge to `master` the same way — it becomes the **production**
   deployment for the same project.

## 5. Wire up the actual domains

In the Pages project > Custom domains:
- Add `brockdonovan.com` and `www.brockdonovan.com`, both mapped to the
  **Production** environment (i.e. `master`).
- Add `dev.brockdonovan.com` under the **Preview** section, scoped to the
  `add-dev` branch specifically (Cloudflare lets you pick "this branch only"
  rather than all preview deploys).

Cloudflare auto-creates the matching DNS records in your now-Cloudflare-
managed zone — you don't need to hand-add CNAMEs for this part.

## 6. Cut over and clean up

Once `brockdonovan.com` is confirmed loading from Cloudflare Pages:
1. GitHub repo Settings > Pages > disable the Pages site (stops the old
   deployment; also frees up the custom domain so Cloudflare's cert
   validation doesn't conflict with it).
2. The `CNAME` file in this repo was for GitHub Pages' custom-domain config
   and is no longer needed — fine to delete in a follow-up commit once step 1
   above is done.

## Day-to-day workflow after this is done

- Branch off `add-dev` (or push directly to `add-dev`) for work-in-progress,
  push it up, check `https://dev.brockdonovan.com`.
- Merge `add-dev` into `master` (or open a PR) when it looks right — that
  push triggers the production deploy to `https://brockdonovan.com`.
