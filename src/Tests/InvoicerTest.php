<?php

namespace Drupal\invoicer\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests Minimal installation profile expectations.
 *
 * @group invoicer
 */
class InvoicerTest extends WebTestBase {

  protected $profile = 'invoicer';

  /**
   * Tests Invoicer installation profile.
   */
  function testInvoicer() {
    $this->assertTrue(TRUE);
  }

}
