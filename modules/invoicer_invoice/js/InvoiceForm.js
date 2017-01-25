/**
 * @file
 * Attaches the behaviors for the invoicer_invoice module.
 */

(function ($, Drupal, drupalSettings) {

    'use strict';

    /**
     * @type {Drupal~behavior}
     *
     * @prop {Drupal~behaviorAttach} attach
     *   Adds behaviors to the field storage add form.
     */
    Drupal.behaviors.invoicerInvoice = {
        attach: function (context) {
            $(".quantity").change(updateLinePrice);
            $(".amount").change(updateLinePrice);
            $(".vat").change(updateLinePrice);

            function updateLinePrice() {
                var $parent = jQuery($(this).closest("td"));
                var $siblings = getSiblingsValues($parent);

                $parent.find(".base_price").val($siblings["quantity"] * $siblings["amount"]);
                $parent.find(".total_price").val($siblings["quantity"] * $siblings["amount"] * (1 + ($siblings["vat"]/100)));
            }

            function getSiblingsValues ($parent){
                return {
                    "quantity": $parent.find(".quantity").val(),
                    "amount": $parent.find(".amount").val(),
                    "vat": $parent.find(".vat").val()
                };
            }
        }
    };

})(jQuery, Drupal, drupalSettings);