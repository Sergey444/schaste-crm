/**
 * Search customers
 */
(function () {

    /**
     *
     */
    var clearId = function () {
        $('#order-customer_id').val('');
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
        $('#order-customer_id').val( $(context).data('id') );
        $('#order-customer_name').val( $(context).text() );
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
        // $('.rs-add-to-order').css('display', 'none');
        $(customers).each(function (index, customer) {
            if (customer.child_name === value) {
                return $('#order-customer_id').val( customer.id );
            }
            // $('.rs-add-to-order').css('display', 'block');
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

    $('#order-customer_name').on('keydown', function (evt) {
        evt.stopPropagation();
    });

    $('#order-customer_name').on('input focus', function (evt) {
        var value = $.trim( $(this).val() );
        if (value.length > 1) {
            return getCustomers(value);
        }

        clearId();
        closeSelect();
    });

    $('#order-customer_name').on('blur', function (evt) {
        setTimeout( function () {
             closeSelect();
        }, 200);
    });


    $('[data-name="type_customer"]').on('change', function (evt) {
        $(this).tab('show');
    });

    $('[data-name="payment_create"]').on('change', function (evt) {
        $('#payment_date').toggle('100');
    });
}());