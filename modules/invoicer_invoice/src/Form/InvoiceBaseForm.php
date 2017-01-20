<?php

namespace Drupal\invoicer_invoice\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Invoice base edit forms.
 *
 * @ingroup invoicer_invoice
 */
class InvoiceBaseForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'amazing_forms_contribute_form';
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
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
    $form['abstract']['vat'] = $form['vat'];
    unset($form['vat']);
    $form['abstract']['total'] = $form['total'];
    unset($form['total']);

    $form['comments']['#weight'] = 5;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    // Add #process and #after_build callbacks.
    $form['#process'][] = '::processForm';
    $form['#after_build'][] = '::afterBuild';

    $form['customer_ids'] = [
      'label' => 'above',
      'type' => 'string_textfield',
      'weight' => 0,
    ];
    $this->buildForm($form, $form_state);
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
