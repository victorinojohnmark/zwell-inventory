//set boostrapSwitch state when active value is present
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


let quantityItems = document.querySelectorAll('input[name="quantity"]');
let unitCostItems = document.querySelectorAll('input[name="unit_cost"]');
if(quantityItems && unitCostItems) {
    Array.from([quantityItems, unitCostItems]).forEach(function (elements){
        Array.from(elements).forEach(function (el){
            el.addEventListener('input', function(e){
                let quantity = document.querySelector(`#purchaseOrderDetailQuantity${el.dataset.detailid}`).value;
                let unitCost = document.querySelector(`#purchaseOrderDetailUnitCost${el.dataset.detailid}`).value;
                let subTotalAmount = document.querySelector(`#purchaseOrderDetailSubTotalAmount${el.dataset.detailid}`);
    
                //clean values
                quantity = parseFloat(quantity.replace(/,/g,''));
                unitCost = parseFloat(unitCost.replace(/,/g,''));
    
                //compute
                if (!isNaN(quantity) && !isNaN(unitCost)) {
                    subTotalAmount.value = (quantity * unitCost).toLocaleString("en-US", { minimumFractionDigits: 2 });
                }
            });
        });
    });
}



