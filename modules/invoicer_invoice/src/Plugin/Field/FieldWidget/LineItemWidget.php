<?php

/**
 * @FieldWidget(
 *   id = "line_item_widget",
 *   label = @Translation("Line item widget"),
 *   field_types = {
 *     "line_item"
 *   }
 * )
 */

namespace Drupal\invoicer_invoice\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

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
    $quantity = (!is_null($quantity)?$quantity:0);
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

    $ammount = $items->get($delta)->get('ammount')->getValue();
    $ammount = (!is_null($ammount)?$ammount:0);
    $elements['ammount'] = [
      '#type' => 'number',
      '#title' => t('Ammount'),
      '#default_value' => $ammount,
      '#size' => 4,
      '#scale' => 2,
      '#maxlength' => 6,
      '#step' => 0.01,
    ];

    $vat = $items->get($delta)->get('vat')->getValue();
    $vat = (!is_null($vat)?$vat:0);
    $elements['vat'] = [
      '#type' => 'select',
      '#title' => t('Vat'),
      '#default_value' => $vat,
      '#options' => ['0' => '0%', '21' => '21%', '19'=> '19%'],
    ];

    $elements['base_price'] = [
      '#type' => 'number',
      '#title' => t('Base price'),
      '#default_value' => $quantity * $ammount,
        '#step' => 0.01,
      '#size' => 4,
      '#scale' => 2,
      '#maxlength' => 6,
      '#step' => 0.01,
    ];

    $elements['total_price'] = [
      '#type' => 'number',
      '#title' => t('Total price'),
      '#default_value' => $quantity * $ammount * (1 + $vat * (0.01)),
      '#size' => 4,
      '#scale' => 2,
        '#step' => 0.01,
      '#maxlength' => 6,
    ];
    return $elements;
  }

}