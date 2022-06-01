//set boostrapSwitch state when active value is present
let active = document.querySelector('input[name="active"]');
if(active) {
    if(active.value == 1) {
        $('#activeToggler').bootstrapSwitch('state', true);
    } else {
        $('#activeToggler').bootstrapSwitch('state', false);
    }
}

// toggle active value when bootstrapSwitch changed
$(document).ready(function(){
    $('#activeToggler').on('switchChange.bootstrapSwitch', function(e) {
        let active = document.querySelector('input[name="active"]');
        (e.target.checked) ? active.value = 1 : active.value = 0;
    });
})



