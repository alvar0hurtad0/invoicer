<?php

namespace Drupal\invoicer_invoice\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Invoice base edit forms.
 *
 * @ingroup invoicer_invoice
 */
class InvoiceBaseForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\invoicer_invoice\Entity\InvoiceBase */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Invoice base.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Invoice base.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.invoice_base.canonical', ['invoice_base' => $entity->id()]);
  }

}
