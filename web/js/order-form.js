/**
 * Search customers
 */
(function () {

    /**
     *
     */
    var clearId = function () {
        $('#rs-order-id-customer .form-control').val('');
    }

    /**
     *
     */
    var closeSelect = function () {
        $('.rs-add-to-order').hide();
        $('#rs-find-block').empty();
    }

    /**
     *
     * @param {Object} context
     */
    window.chooseCustomers = function (context) {
        $('#rs-order-id-customer .form-control').val( $(context).data('id') );
        $('#rs-order-find-customer .form-control').val( $(context).text() );
        closeSelect();
    }

    /**
     * Drawing table under input customer name
     *
     * @param {String} value
     * @param {Object} customers
     */
    var drawSelect = function (customers, value) {
        clearId();
        closeSelect();
        $(customers).each(function (index, customer) {
            if (customer.child_name === value) {
                return $('#rs-order-id-customer .form-control').val( customer.id );
            }
            $('#rs-find-block').append('<tr><td onclick="chooseCustomers(this)" class="rs-customer" data-name="customer" data-id="' + customer.id + '">' + customer.child_name + '</td></tr>');
            $('.rs-add-to-order').show();
        });
    }

    /**
     * Send ajax to get-customers action
     *
     * @param {String} value
     * @return {Void}
     */
    var getCustomers = function (value) {

        $.ajax({
            type: "POST",
            url: "/api/get-customers",
            data: "customer_name=" + value,
            success: function(msg){
                drawSelect( msg, value );
            },
            error: function (err, err1) {
                console.log('error', err1);
            }
        });
    }

    $('#rs-order-find-customer').on('keydown', function (evt) {
        evt.stopPropagation();
    });

    $('#rs-order-find-customer .form-control').on('input focus', function (evt) {
        var value = $.trim( $(this).val() );
        if (value.length > 1) {
            return getCustomers(value);
        }

        clearId();
        closeSelect();
    });

    $('#rs-order-find-customer .form-control').on('blur', function (evt) {
        setTimeout( function () {
             closeSelect();
        }, 200);
    });


    $('[data-name="type_of_customer"]').on('change', function (evt) {
        var value = $(this).val();
        $('.rs-order__customer').hide('200');
        $('#' + value).show('200');
        // $(this).tab('show');
    });

    $('[data-name="payment_create"]').on('change', function (evt) {
        $('#payment_date').toggle('100');
    });
}());