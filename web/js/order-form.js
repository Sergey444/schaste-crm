/**
 * Count sum when change unit price and count inputs
 */
(function () {
    var unitPriceInput = $('#order-unit_price');
    var countInput = $('#order-count');
    var saleInput = $('#order-sale');
    var sumInput = $('#order-sum');

    var unitPrice = 0;
    var count = 1;
    var sale = 0;

    /**
     * Count sum handler
     * 
     * @return {Void} 
     */
    var countSumHandler = function () {
        var sum = count * unitPrice - sale;
        if (sum > 0) {
            return $(sumInput).val(sum);
        }
        return $(sumInput).val('');
    }

    $(unitPriceInput).on('input', function (evt) {
        unitPrice = $(this).val();
        countSumHandler();
    });

    $(countInput).on('input', function (evt) {
        count = $(this).val();
        countSumHandler();
    });

    $(saleInput).on('input', function (evt) {
        sale = $(this).val();
        countSumHandler()
    });
}());


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
            url: "/journal/get-customers",
            data: "customer_name=" + value,
            success: function(msg){
                console.log(msg)
                drawSelect( JSON.parse(msg), value );
            },
            error: function (err, err1) {
                console.log('error', err1);
            }
        });
    } 

    $('#order-customer_name').on('keydown', function (evt) {
        evt.stopPropagation();
    });

    $('#order-customer_name').on('input', function (evt) {
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