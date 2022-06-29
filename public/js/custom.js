let active = document.querySelector('input[name="active"]');
if(active) {
    if(active.value == 1) {
        $('#activeToggler').bootstrapSwitch('state', true);
    } else {
        $('#activeToggler').bootstrapSwitch('state', false);
    }
}


$(document).ready(function(){
    // toggle active value when bootstrapSwitch changed
    $('#activeToggler').on('switchChange.bootstrapSwitch', function(e) {
        let active = document.querySelector('input[name="active"]');
        (e.target.checked) ? active.value = 1 : active.value = 0;
    });

    // reset form upon modal close
    $('.purchaseOrderDetailModal').on('hidden.bs.modal', function () {
        $('.purchaseOrderDetailModal form')[0].reset();
        });
})


