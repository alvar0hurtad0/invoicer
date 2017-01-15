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
    $elements = array();

    foreach ($items as $delta => $item) {
      $elements[$delta] = array(
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#attributes' => array(
          'style' => 'color: ' . $item->value,
        ),
        '#value' => $this->t('The color code in this field is @code', array('@code' => $item->value)),
      );
    }

    return $elements;
  }

}
