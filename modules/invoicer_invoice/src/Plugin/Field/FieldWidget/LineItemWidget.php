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
      '#default_value' => $items->get($delta)->get('item')->getValue(),
      '#size' => 50,
      '#maxlength' => 128,
    ];

    $elements['quantity'] = [
      '#type' => 'number',
      '#default_value' => $items->get($delta)->get('quantity')->getValue(),
      '#size' => 4,
      '#scale' => 2,
      '#maxlength' => 6,
    ];

    $elements['ammount'] = [
      '#type' => 'number',
      '#default_value' => $items->get($delta)->get('ammount')->getValue(),
      '#size' => 4,
      '#scale' => 2,
      '#maxlength' => 6,
    ];

    $elements['vat'] = [
      '#type' => 'select',
      '#default_value' => $items->get($delta)->get('vat')->getValue(),
      '#options' => ['21' => '21%', '19'=> '19%'],
    ];

    $elements['#attributes']['class'][] = 'container-inline';
    return $elements;
  }

}