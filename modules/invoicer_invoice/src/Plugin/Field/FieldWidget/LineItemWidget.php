<?php

namespace Drupal\invoicer_invoice\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Witget for line_item elements.
 *
 * @FieldWidget(
 *   id = "line_item_widget",
 *   label = @Translation("Line item widget"),
 *   field_types = {
 *     "line_item"
 *   }
 * )
 */
class LineItemWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $elements['item'] = [
      '#type' => 'textfield',
      '#title' => t('Description'),
      '#default_value' => $items->get($delta)->get('item')->getValue(),
      '#size' => 50,
      '#maxlength' => 128,
    ];

    $quantity = $items->get($delta)->get('quantity')->getValue();
    $quantity = (!is_null($quantity) ? $quantity : 0);
    $elements['quantity'] = [
      '#type' => 'number',
      '#title' => t('Quantity'),
      '#default_value' => $quantity,
      '#size' => 2,
      '#scale' => 2,
      '#step' => 0.01,
      '#maxlength' => 4,
      '#attributes' => ['class' => ['quantity']],
    ];

    $amount = $items->get($delta)->get('amount')->getValue();
    $amount = (!is_null($amount) ? $amount : 0);
    $elements['amount'] = [
      '#type' => 'number',
      '#title' => t('Amount'),
      '#default_value' => $amount,
      '#size' => 4,
      '#scale' => 2,
      '#maxlength' => 6,
      '#step' => 0.01,
      '#attributes' => ['class' => ['amount']],
    ];

    $vat = $items->get($delta)->get('vat')->getValue();
    $vat = (!is_null($vat) ? $vat : 0);

    $config = \Drupal::service('config.factory')->get('invoicer_invoice.settings');
    $vatOptions = $config->get('vat_types');
    $options = [];
    foreach ($vatOptions as $vatOption) {
      $value = $vatOption['value'];
      $vatType = $vatOption['value_label'];
      $options[$value] = $vatType;
    };

    $elements['vat'] = [
      '#type' => 'select',
      '#title' => t('Vat'),
      '#default_value' => $vat,
      '#options' => $options,
      '#attributes' => ['class' => ['vat']],
    ];

    $elements['base_price'] = [
      '#type' => 'number',
      '#title' => t('Base price'),
      '#default_value' => $quantity * $amount,
      '#step' => 0.01,
      '#size' => 4,
      '#scale' => 2,
      '#maxlength' => 6,
      '#step' => 0.01,
      '#attributes' => ['class' => ['base_price']],
    ];

    $elements['total_price'] = [
      '#type' => 'number',
      '#title' => t('Total price'),
      '#default_value' => $quantity * $amount * (1 + $vat * (0.01)),
      '#size' => 4,
      '#scale' => 2,
      '#step' => 0.01,
      '#maxlength' => 6,
      '#attributes' => ['class' => ['total_price']]
    ];
    return $elements;
  }

}
