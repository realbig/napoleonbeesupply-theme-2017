import $ from 'jquery';

class NBS_BeeOrderForm {

    constructor() {

        this.$orderForm = $('#nbs-bee-order-form');

        if ( ! this.$orderForm.length) {

            return;
        }

        this.quantityFields();
    }

    quantityFields() {

        let $fields = this.$orderForm.find('.nbs-bee-order-form-qty');

        $fields.change(this.quantityChange);
    }

    quantityChange() {

        let product = $(this).attr('data-product');
        let $addToCartButton = $(`a.ajax_add_to_cart[data-product_id="${product}"]`);

        $addToCartButton.attr('data-quantity', $(this).val());
    }
}

new NBS_BeeOrderForm();