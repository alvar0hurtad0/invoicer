<?php

namespace Drupal\invoicer_invoice\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'field_line_item' formatter.
 *
 * @FieldFormatter(
 *   id = "line_item_formatter",
 *   module = "invoicer_invoice",
 *   label = @Translation("Line Item formatter"),
 *   field_types = {
 *     "line_item"
 *   }
 * )
 */
class LineItemFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    foreach ($items as $delta => $item) {
      $rows[$delta] = array(
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => $this->t('The color code in this field is @code', array('@code' => $item->value)),
      );
    }
    foreach ($items as $delta => $item) {
      // Calculated fields.
      $base_price = $item->quantity * $item->amount;
      $total_price = $base_price * (1 + $item->vat / 100);

      // Build the row.
      $rows[$delta] = [
        'item' => $item->item,
        'quantity' => $item->quantity,
        'amount' => $item->amount,
        'vat' => $item->vat . '%',
        'base_price' => $base_price,
        'total_price' => $total_price,
      ];
    }
    $header = [
      'Description',
      'Quantity',
      'Amount',
      'Vat',
      'Base price',
      'Total Price',
    ];
    $elements = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return $elements;
  }

}
