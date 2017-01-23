<?php

/**
 * @file
 * Contains \Drupal\invoicer_invoice\Form\InvoicerInvoiceConfigForm.
 */

namespace Drupal\invoicer_invoice\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure file system settings for this site.
 */
class InvoicerInvoiceConfigForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'invoicer_invoice_config_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['invoicer_invoice.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('invoicer_invoice.settings');

        $form = array();

        $form['vat_types'] = array(
            '#type' => 'textarea',
            '#title' => t('VAT types'),
            '#size' => 60,
            '#maxlength' => 60,
            '#default_value' => implode("\n", $config->get('vat_types')),
            '#description' => t('The VAT types'),
        );

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $config = $this->config('invoicer_invoice.settings');

        $form_state->cleanValues();
        foreach ($form_state->getValues() as $key => $value) {
            if($key == 'vat_types') {
                $values = explode("\n", $value);

                $values = array_map(function ($value) {
                   return trim($value);
                }, $values);

                $values = array_filter($values, function($value) {
                    return (! empty($value)) && is_numeric($value);
                });

                $config->set($key, $values);
            }
        }

        $config->save();

        parent::submitForm($form, $form_state);
    }

}