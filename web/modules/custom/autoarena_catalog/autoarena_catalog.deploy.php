<?php

/**
 * @file
 * Deploy hooks for AutoArena Catalog.
 *
 * These run after config import (`drush deploy`), so the variant paragraph
 * type and field_car_variants already exist when they execute.
 */

use Drupal\paragraphs\Entity\Paragraph;

/**
 * Copies legacy car_variants nodes into variant paragraphs on each car.
 *
 * Each variant node becomes one paragraph. Its specs become powertrain rows:
 * one row when the node has a single fuel and transmission, otherwise one row
 * per fuel × transmission combination with the same specs, since a node could
 * not say which pairs really exist. Those cars are listed for manual review.
 *
 * The legacy nodes and field_variants are left untouched, so this can be
 * re-verified or rolled back; phase 2 deletes them. Cars that already have
 * variant paragraphs are skipped, so the hook is safe to re-run.
 */
function autoarena_catalog_deploy_variant_paragraphs(array &$sandbox): string {
  $storage = \Drupal::entityTypeManager()->getStorage('node');
  $ids = $storage->getQuery()
    ->accessCheck(FALSE)
    ->condition('type', 'cars')
    ->execute();

  $migrated = 0;
  $review = [];
  foreach ($storage->loadMultiple($ids) as $car) {
    if (!$car->get('field_car_variants')->isEmpty()) {
      continue;
    }
    $paragraphs = [];
    foreach ($car->get('field_variants')->referencedEntities() as $node) {
      $fuels = array_column($node->get('field_fuel_type')->getValue(), 'target_id') ?: [NULL];
      $transmissions = array_column($node->get('field_transmission')->getValue(), 'target_id') ?: [NULL];
      if (count($fuels) > 1 || count($transmissions) > 1) {
        $review[] = sprintf('%s (node %d) → variant "%s"', $car->label(), $car->id(), $node->label());
      }

      $rows = [];
      foreach ($fuels as $fuel) {
        foreach ($transmissions as $transmission) {
          $rows[] = [
            'fuel_type' => $fuel,
            'transmission' => $transmission,
            'engine_cc' => $node->get('field_engine_cc')->value,
            'power_bhp' => $node->get('field_power_bhp')->value,
            'mileage_kmpl' => $node->get('field_mileage_kmpl')->value,
            'ex_showroom_price' => $node->get('field_ex_showroom_price')->value,
          ];
        }
      }

      $paragraph = Paragraph::create([
        'type' => 'variant',
        'status' => $node->isPublished(),
        'field_variant_name' => $node->label(),
        'field_powertrains' => $rows,
      ]);
      if (!$node->get('body')->isEmpty()) {
        $paragraph->set('field_variant_description', [
          'value' => $node->get('body')->value,
          'format' => $node->get('body')->format,
        ]);
      }
      $paragraphs[] = $paragraph;
    }

    if ($paragraphs) {
      $car->set('field_car_variants', $paragraphs);
      $car->setNewRevision(TRUE);
      $car->setRevisionLogMessage('Migrated variants from car_variants nodes to variant paragraphs.');
      $car->setSyncing(TRUE);
      $car->save();
      $migrated++;
    }
  }

  $message = sprintf('Migrated variants for %d car(s).', $migrated);
  if ($review) {
    $message .= ' Check the powertrain rows of these variants; remove fuel/transmission pairs that are not actually sold: ' . implode('; ', $review);
  }
  \Drupal::logger('autoarena_catalog')->notice($message);
  return $message;
}
