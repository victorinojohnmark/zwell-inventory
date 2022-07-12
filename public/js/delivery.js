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
                   document.querySelector(`#deliveryDetailUnitIndicator${element.dataset.detailid}`).innerHTML = data;
                   document.querySelector(`#purchaseOrderDetail${element.dataset.detailid}`).value = element.options[element.selectedIndex].dataset.po_detail_id;
                   document.querySelector(`#deliveryDetailUnitCost${element.dataset.detailid}`).value = element.options[element.selectedIndex].dataset.unitcost
                //    console.log(element.options[element.selectedIndex], element.options[element.selectedIndex].dataset.po_detail_id);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
            
                },
            });
            // console.log(element.options[element.selectedIndex].dataset.unitcost);
            // document.querySelectorAll('input[name="unit_price"]').value = element.options[element.selectedIndex].dataset.unitcost

        }
    });
});

let quantityItems = document.querySelectorAll('input[name="quantity"]');
let unitCostItems = document.querySelectorAll('input[name="unit_price"]');
if(quantityItems && unitCostItems) {
    Array.from([quantityItems, unitCostItems]).forEach(function (elements){
        Array.from(elements).forEach(function (el){
            el.addEventListener('input', function(e){
                let quantity = document.querySelector(`#deliveryDetailQuantity${el.dataset.detailid}`).value;
                let unitCost = document.querySelector(`#deliveryDetailUnitCost${el.dataset.detailid}`).value;
                let subTotalAmount = document.querySelector(`#deliveryDetailSubTotalAmount${el.dataset.detailid}`);
                // console.log('quantity is: ' + quantity, 'unitcost is: ' + unitCost);
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


let searchPO = document.querySelector('input[name="po_no_search"]');
let searchPOResult = document.querySelector('#poSearchResult');
let inputPO = document.querySelector('input[name="purchase_order_id"]');
if(searchPO && searchPOResult && inputPO) {
    searchPO.addEventListener('input', (e) => {
        inputPO.value = '';
        inputPO.dataset.po_no = '';

        if(e.target.value.length > 3) {
            searchPOResult.classList.add('show');
            axios.get(`/purchaseorder/approvedsearch/${e.target.value}`)
            .then(response => {
                const data = response.data;
                if(data.length === 0) {
                    //clear first all result list
                    while(searchPOResult.children.length > 0) {
                        searchPOResult.children[0].remove();
                    }
                } else {
                    data.forEach((d) => {
                        //clear first all result list
                        while(searchPOResult.children.length > 0) {
                            searchPOResult.children[0].remove();
                        }

                        let li = document.createElement('li');
                        li.classList.add('list-group-item', 'list-group-item-action', 'border-0');
                        li.innerHTML = d.po_no;
                        li.dataset.poid = d.id;
                        li.dataset.po_no = d.po_no;
                
                        li.addEventListener('click', function(e) {
                            //clear PO id input value
                            inputPO.value = null;
                            inputPO.dataset.po_no = null;

                            //assign input po values
                            inputPO.value = e.target.dataset.poid;
                            inputPO.dataset.po_no = e.target.dataset.po_no;
                            searchPO.value = e.target.innerHTML;

                            //assign supplier id
                            axios.get(`/purchaseorder/${e.target.dataset.poid}`)
                            .then(response => {
                                const data = response.data;
                                document.querySelector('input[name="supplier_id"]').value = data.supplier_id;
                            })
                            .catch(error => {
                                console.log(error);
                            });


                            //clear first all result list
                            while(searchPOResult.children.length > 0) {
                                searchPOResult.children[0].remove();
                            }

                            // hide po search result list
                            searchPOResult.classList.remove('show');
                        });

                        searchPOResult.appendChild(li);
                    });

                }
            })
            .catch(error => {
                console.log(error);
            })
        } else {
            while(searchPOResult.children.length > 0) {
                searchPOResult.children[0].remove();
            }
            searchPOResult.classList.remove('show');
        }

        
    })

    searchPO.addEventListener('blur', (e) => {
        searchPO.value = inputPO.value != undefined ? inputPO.dataset.po_no : '';
        
    });

    function resetSearchPOResult() {
        inputPO.value = '';
        searchPO.value = '';
        while(searchPOResult.children.length > 0) {
            searchPOResult.children[0].remove();
        }
        searchPOResult.classList.remove('show');
    }

    

    
    
}




  