<?php

/**
 * Provides a field type of items for the invoices.
 *
 * @FieldType(
 *   id = "line_item",
 *   label = @Translation("Line item field"),
 * )
 */

namespace Drupal\invoicer_invoice\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

class LineItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'item' => array(
          'type' => 'text',
          'size' => 'big',
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('item')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['item'] = DataDefinition::create('text')
      ->setLabel(t('Item description'));

    return $properties;
  }

}