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
    $value = $items->get($delta)->get('item')->getValue();
    $element += array(
      '#type' => 'textfield',
      '#default_value' => $value,
      '#size' => 50,
      '#maxlength' => 128,
      '#element_validate' => array(
        array($this, 'validate'),
      ),
    );
    return array('item' => $element);
  }

  /**
   * Validate the item field.
   */
  public function validate($element, FormStateInterface $form_state) {
    return TRUE;
  }

}