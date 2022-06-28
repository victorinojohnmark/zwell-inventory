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

let searchPO = document.querySelector('input[name="po_no_search"]');
let searchPOResult = document.querySelector('#poSearchResult');
let inputPO = document.querySelector('input[name="purchase_order_id"]');


if(searchPO && searchPOResult && inputPO) {
    searchPO.addEventListener('input', (e) => {
        inputPO.value = '';
        inputPO.dataset.po_no = '';

        if(e.target.value.length > 3) {
            searchPOResult.classList.add('show');
            axios.get(`/purchaseorder/search/${e.target.value}`)
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

                            inputPO.value = e.target.dataset.poid;
                            inputPO.dataset.po_no = e.target.dataset.po_no;
                            searchPO.value = e.target.innerHTML;

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
        while(searchPOResult.children.length > 0) {
            searchPOResult.children[0].remove();
        }
        searchPOResult.classList.remove('show');
        // console.log(selected, inputPO.value, searchPOResult.children.length, searchPO.value);
        // if(selected == false && inputPO.value == '' && searchPOResult.children.length == 0 && searchPO.value != ''){
        //     resetSearchPOResult();
        // }
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




  