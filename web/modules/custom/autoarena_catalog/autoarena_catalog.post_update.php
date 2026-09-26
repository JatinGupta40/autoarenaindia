<?php

/**
 * @file
 * Post update functions for AutoArena Catalog.
 *
 * These run before config import (`drush deploy`), while the car_variants
 * node type still exists.
 */

use Drupal\field\Entity\FieldStorageConfig;

/**
 * Deletes the legacy car_variants nodes (phase 2 of the paragraph migration).
 *
 * Config import then removes the car_variants type, its fields and
 * cars.field_variants. Refuses to run while any car still references legacy
 * variants without having variant paragraphs, so data is never lost on an
 * environment where the phase 1 deploy hook has not run yet.
 */
function autoarena_catalog_post_update_delete_legacy_variants(array &$sandbox): string {
  $storage = \Drupal::entityTypeManager()->getStorage('node');

  if (!isset($sandbox['ids'])) {
    if (FieldStorageConfig::loadByName('node', 'field_variants')) {
      if (!FieldStorageConfig::loadByName('node', 'field_car_variants')) {
        throw new \RuntimeException('Variant paragraphs are not installed yet. Deploy phase 1 of the paragraph migration first.');
      }
      $unmigrated = $storage->getQuery()
        ->accessCheck(FALSE)
        ->condition('type', 'cars')
        ->exists('field_variants')
        ->notExists('field_car_variants')
        ->execute();
      if ($unmigrated) {
        throw new \RuntimeException(sprintf('Cars %s still have unmigrated variants. Run `drush deploy:hook` for phase 1 first.', implode(', ', $unmigrated)));
      }
    }
    $sandbox['ids'] = array_values($storage->getQuery()
      ->accessCheck(FALSE)
      ->condition('type', 'car_variants')
      ->execute());
    $sandbox['total'] = count($sandbox['ids']);
  }

  $batch = array_splice($sandbox['ids'], 0, 50);
  if ($batch) {
    $storage->delete($storage->loadMultiple($batch));
  }
  $sandbox['#finished'] = $sandbox['total'] ? 1 - count($sandbox['ids']) / $sandbox['total'] : 1;

  return sprintf('Deleted %d legacy car_variants node(s).', $sandbox['total']);
}
