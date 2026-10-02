# AutoArena India — Backend

Headless Drupal 10 backend for AutoArena India, a car catalogue with news and blogs. Content is served read-only over JSON:API to the Next.js frontend in [autoarenaindia-FE](https://github.com/JatinGupta40/autoarenaindia-FE).

| | |
|---|---|
| Drupal | 10.5 (`drupal/recommended-project`, docroot `web/`) |
| PHP | 8.3 |
| Database | MariaDB 10.4 |
| Local environment | [DDEV](https://ddev.com), project name `autoarenaindia` |
| Local URL | https://autoarenaindia.ddev.site |
| API | https://autoarenaindia.ddev.site/jsonapi (read-only) |

## Local setup

**Prerequisites:** Docker and DDEV.

1. Clone the repo and start DDEV:
   ```bash
   git clone git@github.com:JatinGupta40/autoarenaindia-BE.git
   cd autoarenaindia-BE
   ddev start
   ddev composer install
   ```
2. Import a database. The site can't be installed from config, because the `standard` install profile implements `hook_install()`. Ask a maintainer for a recent dump, then import it:
   ```bash
   ddev import-db --file=path/to/dump.sql.gz
   ```
   The `autoarenaindia.sql.gz` file in the repo root is an old, untracked dump. It predates the current content model, so don't use it.
3. Bring the database in line with the code:
   ```bash
   ddev drush deploy   # updb, config import, cache rebuild, deploy hooks
   ddev drush uli      # one-time admin login link
   ```

### Frontend connection

The frontend reads the backend URL from its `.env.local` file:

```text
NEXT_PUBLIC_DRUPAL_BASE_URL=https://autoarenaindia.ddev.site
```

If the browser calls the API directly, it needs CORS. Enable it in `web/sites/default/services.yml`. That file is git-ignored, so each developer adds it locally:

```yaml
parameters:
  cors.config:
    enabled: true
    allowedHeaders: ['*']
    allowedMethods: ['GET', 'OPTIONS']
    allowedOrigins: ['http://localhost:3000']
```

## Content model

| Type | Machine name | Purpose |
|---|---|---|
| Car | `cars` (node) | One car **generation**, e.g. Hyundai Creta 2024 |
| Variant | `variant` (paragraph, in `cars.field_car_variants`) | A trim of that car, e.g. SX or ZXi+ |
| Powertrain | rows of `field_powertrains` on a variant (Custom Field) | One engine + transmission combination. Holds fuel, transmission, cc, bhp, torque, km/l and ex-showroom price |
| News | `news` (node) | News items, optionally linked to a car |
| Blog | `blogs` (node) | Blog posts, optionally linked to a car |
| Page | `page` (node) | Basic pages |

**Vocabularies:** `brands`, `car_model`, `body_type`, `fuel`, `transmission`, `type_of_news`, `tags`.

### Derived car fields

The custom module `autoarena_catalog` recomputes these fields on every car save, from the car's **published** variants:

- `field_price_min` and `field_price_max`
- `field_fuel_type` and `field_transmission`

They are hidden from the edit form and must never be edited by hand. They let the frontend filter and sort cars without loading variants.

### URL aliases (pathauto)

| Type | Pattern |
|---|---|
| Cars | `/cars/[brand]-[model]-[year_start]` |
| News | `/news/[title]` |
| Blogs | `/blog/[title]` |

The frontend resolves these through `decoupled_router` (`/router/translate-path`).

## API

JSON:API is enabled in **read-only** mode. These are the resources the frontend uses:

- `node--cars`, `node--news`, `node--blogs`, `node--page`
- `paragraph--variant` (include it via `field_car_variants`)
- `taxonomy_term--{brands,car_model,body_type,fuel,transmission,type_of_news,tags}`

Example request:

```text
/jsonapi/node/cars?include=field_brand,field_car_model,field_car_variants&filter[status]=1
```

Powertrain `fuel_type` and `transmission` values are taxonomy term IDs, not relationships. Resolve them against the car's included `field_fuel_type` and `field_transmission` terms, using `drupal_internal__tid`.

## Working with config

All site configuration lives in `config/sync`.

- After changing anything in the admin UI, run `ddev drush cex` and commit the YAML files that changed.
- After pulling, run `ddev drush cim`, or `ddev drush deploy` if there are code updates too.
- Never rename or hand-edit config files to rename things.
  - To change a label, edit it in the UI and then export.
  - A bundle's machine name can't be changed through config. It needs a content migration.
- Check for drift with `ddev drush config:status`.

## Branches and pull requests

```text
feature/*  ──PR──▶  develop  ──PR──▶  stage  ──PR──▶  main
                     (dev)            (stage)         (production)
```

- Branch features off `develop`, and open PRs into `develop`.
- Promote `develop → stage → main` with PRs merged as **merge commits**. Squashing would rewrite history between the long-lived branches.
- Don't push directly to `develop`, `stage` or `main`.
- Hotfix: branch off `main`, PR into `main`, then merge `main` back into `stage` and `develop`.

## CI and deployment

- **[`ci.yml`](.github/workflows/ci.yml)** runs on every PR into `develop`, `stage` or `main`. It runs these PHP checks:
  - `composer validate` and `composer install`
  - PHP lint of custom code
  - YAML lint of `config/sync`
  - Drupal coding standards (`phpcs` with `drupal/coder`) on `web/modules/custom`
- **[`deploy.yml`](.github/workflows/deploy.yml)** runs on a push (merge) to those branches. It runs CI again, then deploys to `dev`, `stage` or `production`.
  - The deploy step is a placeholder until hosting is chosen.
  - Environment secrets and approval rules go under *Settings → Environments*.

Run the CI checks locally before opening a PR:

```bash
ddev composer validate --no-check-publish
ddev exec vendor/bin/yaml-lint config/sync
```

## Repository layout

```text
config/sync/                     Exported Drupal configuration
docs/                            Architecture notes and recommendations
web/modules/custom/              Custom modules (autoarena_catalog)
web/themes/custom/autoarenaindia Legacy theme from before the site went headless (not enabled)
.ddev/config.yaml                DDEV project config
.github/workflows/               CI and deploy workflows
```

Contrib modules, core and `vendor/` come from Composer and are not committed.

## Further reading

[docs/ARCHITECTURE_RECOMMENDATIONS.md](docs/ARCHITECTURE_RECOMMENDATIONS.md) covers the architecture review, open recommendations, and the history of the variant-to-paragraph migration.
