<?php

/**
 * @file
 * Contains invoice_base.page.inc.
 *
 * Page callback for Invoice base entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Invoice base templates.
 *
 * Default template: invoice_base.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_invoice_base(array &$variables) {
  // Fetch InvoiceBase Entity Object.
  $invoice_base = $variables['elements']['#invoice_base'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
