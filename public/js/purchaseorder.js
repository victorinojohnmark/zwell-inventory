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






  