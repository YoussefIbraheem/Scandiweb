$(document).ready(function() {
    // Hide all fields initially
    $('.typeFields').hide();

    // Attach event listener for product type change
    $('#productType').change(function() {
        // Hide all specific fields
        $('.typeFields').hide();

        // Get the target fields via data attribute and show them
        let selectedType = $(this).find('option:selected').data('target');
        $('#' + selectedType).show();
    });
});