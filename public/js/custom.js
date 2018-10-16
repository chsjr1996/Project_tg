$(document).ready(function() {
    // -----------------------
    // Addons
    
    // Bootstrap select
    $(".bs-select").selectpicker();

    // -----------------------
    // Events
    $(this).on('click', '.close-alert', function() {
        $(this).remove();
    });
});