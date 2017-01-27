<?php

namespace Drupal\invoicer_invoice\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Invoice base entities.
 */
class InvoiceBaseViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();
    return $data;
  }

}
