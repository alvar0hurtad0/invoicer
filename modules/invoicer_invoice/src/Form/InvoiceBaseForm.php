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
    $form = parent::buildForm($form, $form_state);

    $form['#attached']['library'][] = 'invoicer_invoice/invoice_form';

    // Control fieldset.
    $form['control'] = [
      '#type' => 'fieldset',
      '#title' => t('Control'),
      '#weight' => 0,
    ];
    $form['control']['number'] = $form['number'];
    unset($form['number']);
    $form['control']['date'] = $form['date'];
    unset($form['date']);

    // Customer fieldset.
    $form['customer'] = [
      '#type' => 'fieldset',
      '#title' => t('Customer'),
      '#weight' => 1,
    ];
    $form['customer']['customer_id'] = $form['customer_id'];
    unset($form['customer_id']);
    $form['customer']['customer_name'] = $form['customer_name'];
    unset($form['customer_name']);
    $form['customer']['customer_address'] = $form['customer_address'];
    unset($form['customer_address']);

    // Provider Fieldset.
    $form['provider'] = [
      '#type' => 'fieldset',
      '#title' => t('Provider'),
      '#weight' => 2,
    ];
    $form['provider']['provider_id'] = $form['provider_id'];
    unset($form['provider_id']);
    $form['provider']['provider_name'] = $form['provider_name'];
    unset($form['provider_name']);
    $form['provider']['provider_address'] = $form['provider_address'];
    unset($form['provider_address']);

    // Abstract fieldset.
    $form['abstract'] = [
      '#type' => 'fieldset',
      '#title' => t('Abstract'),
      '#weight' => 4,
    ];

    $form['abstract']['sub_total'] = $form['sub_total'];
    unset($form['sub_total']);
    $form['abstract']['sub_total']['#attributes']['class'][] = 'abstract-subtotal';

    $form['abstract']['vat'] = $form['vat'];
    unset($form['vat']);
    $form['abstract']['vat']['#attributes']['class'][] = 'abstract-vat';

    $form['abstract']['total'] = $form['total'];
    unset($form['total']);
    $form['abstract']['total']['#attributes']['class'][] = 'abstract-total';

    $form['comments']['#weight'] = 5;

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
