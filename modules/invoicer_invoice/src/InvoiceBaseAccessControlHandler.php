<?php

namespace Drupal\invoicer_invoice;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Invoice base entity.
 *
 * @see \Drupal\invoicer_invoice\Entity\InvoiceBase.
 */
class InvoiceBaseAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\invoicer_invoice\Entity\InvoiceBaseInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished invoice base entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published invoice base entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit invoice base entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete invoice base entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add invoice base entities');
  }

}
