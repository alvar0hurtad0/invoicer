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
   * Stores the sum of all subtotal on the list.
   *
   * @var int
   */
  protected $subTotal = 0;

  /**
   * Stores the sum of all total on the list.
   *
   * @var int
   */
  protected $total = 0;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['date'] = $this->t('Date');
    $header['Number'] = $this->t('Number');
    $header['name'] = $this->t('Name');
    $header['client_name'] = $this->t('Client name');
    $header['sub_total'] = $this->t('Subtotal price');
    $header['total'] = $this->t('Total price');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\invoicer_invoice\Entity\InvoiceBase */
    $row['date'] = $entity->date->value;
    $row['number'] = $entity->number->value;
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.invoice_base.canonical', [
          'invoice_base' => $entity->id(),
        ]
      )
    );
    $row['customer_name'] = $entity->customer_name->value;
    $row['sub_total'] = $entity->sub_total->value;
    $row['total'] = $entity->total->value;

    $this->subTotal += $entity->sub_total->value;
    $this->total += $entity->total->value;

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build = parent::render();

    $build['table']['#rows'][] = [
      '',
      '',
      '',
      '',
      $this->subTotal, $this->total,
      '',
    ];
    return $build;
  }

}
