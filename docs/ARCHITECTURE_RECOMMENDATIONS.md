# Architecture Recommendations

Review of the backend architecture introduced in commit `cc7d70fe` ("BE architecture update") and how the Next.js frontend (`../autoarena-frontend`) consumes it.

_Last updated: 2026-09-27_

## Current architecture

Drupal 10.5 runs headless. It exposes content through a read-only JSON:API. The Next.js frontend reads it with `next-drupal`, and uses `decoupled_router` to turn slugs into entities.

### Content model

| Bundle | Role | Key fields |
|---|---|---|
| `cars` (node) | A car **generation** (e.g. Hyundai Creta 2020) | `field_brand`, `field_car_model`, `field_body_type`, `field_year_start/end`, `field_car_images`, `field_variants` |
| `car_variants` (node) | A trim/variant; **source of truth** for price and specs | `field_ex_showroom_price`, `field_engine_cc`, `field_power_bhp`, `field_mileage_kmpl`, `field_fuel_type`, `field_transmission` |
| `news` (node) | News items | `field_images`, `field_type_of_news`, `field_related_car` |
| `article` (node) | Blog posts | `field_image`, `field_tags`, `field_related_car` |

Vocabularies: `brands`, `car_model`, `body_type`, `fuel`, `transmission`, `type_of_news`.

### Derived summary fields

The `autoarena_catalog` module keeps summary fields on each car in sync with its **published** variants. These fields are `field_price_min`, `field_price_max`, `field_fuel_type` and `field_transmission`.

- The summary is recomputed in `hook_node_presave` whenever a car is saved.
- When a variant is updated or deleted, every car that references it is re-saved as syncing.
- Summary fields are hidden from the car edit form and must never be edited by hand.

Because of this, listings can filter and sort on the car alone. For example, the frontend filters with `field_fuel_type.name` and `field_price_min`.

### Editorial workflow

Variants are managed inside the car form with Inline Entity Form (`inline_entity_form_complex`).

| Setting | Value | Meaning |
|---|---|---|
| `allow_new` | `true` | Editors can create variants inline |
| `allow_existing` | `true` | Editors can attach existing variant nodes |
| `allow_duplicate` | `false` | No "Duplicate" row action |
| `removed_reference` | `optional` | On "Remove", Drupal asks whether to also delete the variant node |

Two customisations support this workflow:

- **Existing-variant autocomplete.** `hook_inline_entity_form_reference_form_alter()` switches the autocomplete to the `autoarena_exclude:node` selection handler (`ExcludeNodeSelection`). That handler leaves out, and rejects on validation, any variants already attached to the car being edited.
- **Cloning.** `hook_cloned_node_alter()` gives a cloned car its own unsaved copies of each variant, so the clone and the original don't share variants.

### Supporting modules

- **URLs:** pathauto builds these aliases:
  - cars: `/cars/[brand]-[model]-[year_start]`
  - news: `/news/[title]`
  - blog: `/blog/[title]`
- **Redirects and SEO:** redirect, metatag, simple_sitemap.
- **API:** `jsonapi` is set to `read_only: true`.

## What works well

- **The data model is right for a car catalogue.** Keeping variants as the source of truth and denormalising summaries onto the car keeps listing queries simple.
- **The API can't be written to.** A read-only JSON:API is the right default for a headless site.
- **Editing is fast.** Inline editing, cloning and slug routing are all in place.

## Recommendations

Items are listed by priority. Items 1–4 are small and touch only `autoarena_catalog` and one frontend query file.

### 1. Stop including variants in car listings

**Problem**
- [`CarCard.tsx`](../../autoarena-frontend/src/components/CarCard.tsx) calls `mileageRange(car)`, which reads `field_variants`.
- Because of that, `CAR_INCLUDES` in [`queries.ts`](../../autoarena-frontend/src/lib/queries.ts) includes full variant nodes, body text included, on every listing. That covers `/cars` (48 cars), the homepage rails, related cars and other generations.
- This undoes the point of the summary fields.

**Fix**
1. On the backend, add summary fields to `cars`:
   - `field_engine_cc_min` and `field_engine_cc_max`
   - `field_mileage_min` and `field_mileage_max`, or just `field_mileage_best`
2. Compute them in `autoarena_catalog_summarize_variants()`.
3. On the frontend, make `engineRange`, `mileageRange` and `bestMileage` read the summary fields.
4. Remove `field_variants` from `CAR_INCLUDES` and include it only in `getCarByPath()`.

**Impact:** listing payloads get much smaller, and responses and ISR regeneration get faster.

### 2. Clean up orphaned variants when a car is deleted

**Problem**
- `removed_reference` only applies when a variant is removed inside the form. Deleting a car leaves all its variants behind.
- Because variants are nodes, orphans stay reachable at `/node/{id}` and in the `node--car_variants` JSON:API collection, and core search indexes them.

**Fix**
- Add `hook_node_predelete()` for `cars`. It should delete only the variants that **no other car references**, because `allow_existing` now lets cars share variants.
- Stop standalone variant pages from being reachable. Options:
  - Rabbit Hole, or an access hook, to return 404 for anonymous users.
  - Hide `car_variants` from `node/add` for editors.
  - Exclude it from the search index.

### 3. Avoid repeated car saves when editing variants inline

**Problem**
IEF saves each edited variant before the car itself is saved. Each variant save runs `autoarena_catalog_resave_parent_cars()`, which saves the car, and then the form saves the car again. Editing 8 variants means 9 car saves, each with cache-tag invalidation and pathauto work.

**Fix**
- Collect the affected car IDs during the request and re-save each car once at the end, using a `destruct` service or `drupal_register_shutdown_function()`.
- Skip the variant-triggered re-save entirely when the parent car is already being saved from its own form.

### 4. Make derived fields optional

**Problem**
- `field.field.node.cars.field_fuel_type` and `field_transmission` are `required: true`, but they are hidden and computed.
- They are legitimately empty for a car with no published variants.
- Any path that runs entity validation (migrations, drush scripts, a writable API later on) will reject such cars.

**Fix**
- Set both fields to `required: false`.
- If every car must have at least one variant, add a validation constraint on `field_variants` instead.
- Align the `translatable` flags. `field_price_min/max` and `field_variants` are translatable but the fields around them aren't. This has no effect today, because no language module is enabled.

### 5. Tie car models to brands

**Problem**
- `car_model` is a flat vocabulary with no link to `brands`, so an editor can save "Hyundai + Swift".
- The pathauto pattern `/cars/[brand]-[model]-[year_start]` can also collide when two generations or facelifts of the same model start in the same year. Pathauto then quietly adds a `-0` suffix.

**Fix**
- Add `field_brand` to `car_model` terms, or nest models under brand terms. Then filter the model autocomplete by the chosen brand.
- Add `year_end` or a generation code to the car alias pattern.

### 6. Make variant titles distinguishable in autocomplete

**Problem**
Now that editors can attach existing variants, the autocomplete shows only titles. Titles such as "Standard" or "XM" can't be told apart across cars.

**Fix** (choose one)
- Use a title convention: `<Brand> <Model> <Year> – <Trim>`. It could be generated automatically with the Automatic Entity Label module.
- Or make `ExcludeNodeSelection` (or an Entity Reference View) show the parent car next to each variant.
- Optionally, when variants shouldn't be shared, make `ExcludeNodeSelection` hide variants already attached to *any* car.

## Nice to have

- **Variants as paragraphs instead of nodes.** Paragraphs and `entity_reference_revisions` are already enabled, and no paragraph types exist yet.
  - **Gains:** variants become owned by their car. That fixes orphans and public URLs and makes the clone hook simpler.
  - **Costs:** you lose per-variant publish status and revisions, and you can't share a variant between cars, which is the current `allow_existing` use case.
  - **Recommendation:** keep nodes and do item 2.
- **JSON:API Extras.**
  - Disable unused resources: `node--page`, `comment`, `user`, `contact_message`, …
  - Remove internal fields: `revision_*`, `uid`, and `promote`/`sticky` where unused.
  - Optionally alias resource names.
  - This makes payloads smaller and exposes less.
- **Search API.** The frontend currently searches with `title CONTAINS q`, which only works because titles happen to read "Brand Model". Search API with a database backend gives fuzzy search across brand, model and body type, plus facets.
- **On-demand revalidation.** Every frontend page uses `revalidate = 60`.
  - Install the Drupal `next` module and use next-drupal's on-demand revalidation. Edits then show up immediately and the timeout can be raised.
  - At the same time, move from the deprecated `DrupalClient` to `NextDrupal`.
- **Composer cleanup.** Remove `ds`, `ui_patterns`, `superfish` and `libraries`. They are required but not enabled, left over from a themed site.
- **Config hygiene.**
  - Remove the stale `field_model` key under `hidden:` in `core.entity_form_display.node.cars.default.yml`.
  - Validate that `year_end >= year_start`.
- **Tests.** Add Kernel tests for `autoarena_catalog`: summary recalculation, clone, delete cleanup and the exclude selection. They protect items 1–3.
- **Per-environment config.** CORS origins live only in the git-ignored `web/sites/default/services.yml`. Before deploying to staging or production, set them per environment with `services.<env>.yml` or config_split.

## Status

| Item | Status |
|---|---|
| Variants moved from `car_variants` nodes to `variant` paragraphs, with a `field_powertrains` custom field (fuel, transmission, engine, cc, bhp, torque, km/l, price per row) | Phase 1 done — see below |
| 2. Orphaned variants / public variant URLs | Solved by paragraphs once phase 2 removes the nodes |
| 3. Repeated car saves on inline variant edits | Solved: variant node hooks removed; the summary is computed once, on car save |
| 6. Distinguishable titles in the existing-variant autocomplete | Obsolete: paragraphs aren't shared, so the autocomplete and `ExcludeNodeSelection` were removed |
| 1, 4, 5 and nice-to-haves | Open |

## Paragraph migration

**Phase 1 (this branch)**

- **New model:** `cars.field_car_variants` (Entity Reference Revisions) → `variant` paragraph, which holds:
  - `field_variant_name`
  - `field_variant_description`
  - `status`
  - `field_powertrains`: a `custom_field` with one row per fuel + transmission combination
- **Migration:** `autoarena_catalog_deploy_variant_paragraphs()` in `autoarena_catalog.deploy.php` copies each legacy variant node into a paragraph. A node with several fuels/transmissions becomes one row per combination. Those rows are logged for manual review, because the node didn't record which pairs are really sold.
- **Legacy data:** `field_variants` and the `car_variants` nodes are kept but hidden, for verification or rollback.
- **Deploy:** run `drush deploy` (updb → cim → deploy:hook). The deploy hook needs the new config, so config import must run before it.
- **API change for the frontend:**
  - Include `field_car_variants` instead of `field_variants`.
  - Powertrain `fuel_type`/`transmission` are term IDs. Resolve them against the car's included `field_fuel_type`/`field_transmission` terms (`drupal_internal__tid`).

**Phase 2 (after verifying on dev)**

1. Delete the `car_variants` nodes.
2. Remove `cars.field_variants`, the `car_variants` node type and its fields (`field_engine_cc`, `field_power_bhp`, `field_mileage_kmpl`, `field_ex_showroom_price`).
3. Remove the `hook_cloned_node_alter()` legacy clean-up.
4. Uninstall `inline_entity_form`.

Deleting the nodes has to happen in a `post_update` hook, because those run before config import removes the node type.
