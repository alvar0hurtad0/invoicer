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
            $(".base_price").change(updateAmountAndTotalPrice);
            $(".total_price").change(updateAmountAndBasePrice);

            function updateLinePrice() {
                var $parent = jQuery($(this).closest("td"));
                var $siblings = getSiblingsValues($parent);

                var $basePrice = $siblings["quantity"] * $siblings["amount"];
                var $totalPrice = $basePrice * $siblings["vatFactor"];
                $parent.find(".base_price").val(parseFloat($basePrice).toFixed(2));
                $parent.find(".total_price").val(parseFloat($totalPrice).toFixed(2));
            }

            function updateAmountAndTotalPrice() {
                var $parent = jQuery($(this).closest("td"));
                var $siblings = getSiblingsValues($parent);

                var $totalPrice = $siblings["base_price"] * $siblings["vatFactor"];
                var $amount = $siblings["base_price"] / $siblings["quantity"];
                $parent.find(".amount").val(parseFloat($amount).toFixed(2));
                $parent.find(".total_price").val(parseFloat($totalPrice).toFixed(2));
            }

            function updateAmountAndBasePrice() {
                var $parent = jQuery($(this).closest("td"));
                var $siblings = getSiblingsValues($parent);

                var $basePrice = $siblings["total_price"] / $siblings["vatFactor"];
                var $amount = $basePrice / $siblings["quantity"];
                $parent.find(".amount").val(parseFloat($amount).toFixed(2));
                $parent.find(".base_price").val(parseFloat($basePrice).toFixed(2));
            }

            function getSiblingsValues ($parent){
                return {
                    "quantity": $parent.find(".quantity").val(),
                    "amount": $parent.find(".amount").val(),
                    "vat": $parent.find(".vat").val(),
                    "vatFactor": 1 + ($parent.find(".vat").val()/100),
                    "base_price": $parent.find(".base_price").val(),
                    "total_price": $parent.find(".total_price").val()
                };
            }
        }
    };

})(jQuery, Drupal, drupalSettings);
