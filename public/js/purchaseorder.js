let quantityItems = document.querySelectorAll('input[name="quantity"]');
let unitCostItems = document.querySelectorAll('input[name="unit_cost"]');

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

let itemSelectors = document.querySelectorAll('select[name="item_id"]');

Array.from(itemSelectors).forEach(function(element){
    element.addEventListener('change', () => {
        if(!isNaN(element.value)){

            //ajax send post request
            $.ajax({
                type: "POST",
                url: '/item/getunit',
                data: { id: element.value },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                   document.querySelector(`#purchaseOrderDetailUnitIndicator${element.dataset.detailid}`).innerHTML = data;
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
            
                },
            });
        }
    });
});

//filepond
const inputElement = document.querySelector('input[id="file"]');
const pond = FilePond.create( inputElement );
FilePond.setOptions({
      server: {
          url: `/UploadPO/${inputElement.dataset.transactiontype}/${inputElement.dataset.transactionid}/${inputElement.dataset.userid}`,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          } 
      }
  });

  