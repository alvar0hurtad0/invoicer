<?php

namespace Drupal\invoicer_invoice\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Invoice base entities.
 *
 * @ingroup invoicer_invoice
 */
interface InvoiceBaseInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Invoice base name.
   *
   * @return string
   *   Name of the Invoice base.
   */
  public function getName();

  /**
   * Sets the Invoice base name.
   *
   * @param string $name
   *   The Invoice base name.
   *
   * @return \Drupal\invoicer_invoice\Entity\InvoiceBaseInterface
   *   The called Invoice base entity.
   */
  public function setName($name);

  /**
   * Gets the Invoice base creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Invoice base.
   */
  public function getCreatedTime();

  /**
   * Sets the Invoice base creation timestamp.
   *
   * @param int $timestamp
   *   The Invoice base creation timestamp.
   *
   * @return \Drupal\invoicer_invoice\Entity\InvoiceBaseInterface
   *   The called Invoice base entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Invoice base published status indicator.
   *
   * Unpublished Invoice base are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Invoice base is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Invoice base.
   *
   * @param bool $published
   *   TRUE to set this Invoice base to published, FALSE to unpublished.
   *
   * @return \Drupal\invoicer_invoice\Entity\InvoiceBaseInterface
   *   The called Invoice base entity.
   */
  public function setPublished($published);

}
