<?php

namespace Drupal\invoicer_invoice;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Invoice base entities.
 *
 * @ingroup invoicer_invoice
 */
class InvoiceBaseListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Invoice base ID');
    $header['name'] = $this->t('Name');
    $header['date'] = $this->t('Date');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\invoicer_invoice\Entity\InvoiceBase */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.invoice_base.edit_form', [
          'invoice_base' => $entity->id(),
        ]
      )
    );
    $row['date'] = $entity->date->value;
    return $row + parent::buildRow($entity);
  }

}
