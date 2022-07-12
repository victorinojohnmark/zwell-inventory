<div class="modal fade" id="deliveriesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delivery details for {{ $purchaseOrder->transaction_code }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @php $deliveryTabCtr = 0; @endphp
                            @foreach ($purchaseOrder->completeDeliveries as $delivery)
                                <a class="nav-link{{$deliveryTabCtr == 0 ? ' active' : ''}}" data-toggle="tab" href="#delivery{{ $delivery->id }}" role="tab" aria-selected="true">{{ $delivery->transaction_code }}</a>
                                @php $deliveryTabCtr++; @endphp
                            @endforeach
                            {{-- <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                            <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> --}}
                        </div>
                    </nav>
                        
                    <div class="tab-content" id="nav-tabContent">
                        @php $deliveryPanelCtr = 0; @endphp
                        @foreach ($purchaseOrder->completeDeliveries as $delivery)
                            {{-- <a class="nav-link {{$deliveryCtr == 0 ? 'active' : ''}}" data-toggle="tab" href="#delivery{{ $delivery->id }}" role="tab" aria-selected="true">{{ $delivery->transaction_code }}</a> --}}
                            <div class="tab-pane fade{{$deliveryPanelCtr == 0 ? ' show active' : ''}}" id="delivery{{ $delivery->id }}" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
                            @php $deliveryPanelCtr++; @endphp
                        @endforeach

                        {{-- <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div> --}}
                    </div>
                </div>
        </div>
    </div>
</div>