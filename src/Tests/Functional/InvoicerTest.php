<?php

namespace Drupal\Tests\invoicer\Fuctional;

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
  public function testInvoicer() {
    $this->assertTrue(TRUE);
  }

}
