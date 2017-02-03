<?php

/**
 * @file
 * Contains invoicer_invoice.page.inc.
 *
 * Page callback for Invoice base entities.
 */

use Drupal\user\Entity\User;

/**
 * Prepares variables for Invoice base templates.
 *
 * Default template: invoicer_invoice.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_invoicer_invoice(array &$variables) {
  // Load the current user.
  $user = User::load(\Drupal::currentUser()->id());

  $variables['elements']['logo'] = 'logo';
}
