(function () {

    $('[data-name="salary"]').on('change', function (evt) {
        if (this.checked) {
            return $('#salary').show('200');
        }
        $('#paymentout-profile_id').val('');
        return $('#salary').hide('200');
    });
}());