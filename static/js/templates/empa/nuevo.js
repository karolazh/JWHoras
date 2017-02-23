$(document).ready(function() {
    $("#bo_consume_alcohol").on('change', function(e) {
        xModal.info($("#bo_consume_alcohol").val());
    });
});