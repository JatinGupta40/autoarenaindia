<?php

namespace Drupal\autoarena_catalog\Plugin\EntityReferenceSelection;

use Drupal\Core\Entity\Attribute\EntityReferenceSelection;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\node\Plugin\EntityReferenceSelection\NodeSelection;

/**
 * Node selection that leaves out the nodes listed in 'exclude_ids'.
 *
 * Used by the "Add existing variant" autocomplete so variants already attached
 * to the car being edited are neither suggested nor accepted again.
 */
#[EntityReferenceSelection(
  id: "autoarena_exclude:node",
  label: new TranslatableMarkup("Node selection, excluding given nodes"),
  entity_types: ["node"],
  group: "autoarena_exclude",
  weight: 5
)]
class ExcludeNodeSelection extends NodeSelection {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'exclude_ids' => [],
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  protected function buildEntityQuery($match = NULL, $match_operator = 'CONTAINS') {
    $query = parent::buildEntityQuery($match, $match_operator);
    if ($exclude = $this->getConfiguration()['exclude_ids']) {
      $query->condition('nid', $exclude, 'NOT IN');
    }
    return $query;
  }

}
