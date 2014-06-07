$(document).ready(function() {
    $('.datatables').dataTable({
        ordering: false
    });
    $( ".datepicker" ).datepicker({
        dateFormat: "dd.mm.yy"
    });
});