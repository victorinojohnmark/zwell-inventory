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
                        </div>
                    </nav>
                        
                    <div class="tab-content" id="nav-tabContent">
                        @php $deliveryPanelCtr = 0; @endphp
                        @foreach ($purchaseOrder->completeDeliveries as $delivery)
                            {{-- <a class="nav-link {{$deliveryCtr == 0 ? 'active' : ''}}" data-toggle="tab" href="#delivery{{ $delivery->id }}" role="tab" aria-selected="true">{{ $delivery->transaction_code }}</a> --}}
                            <div class="tab-pane fade{{$deliveryPanelCtr == 0 ? ' show active' : ''}} pt-3" id="delivery{{ $delivery->id }}" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Cost</th>
                                        <th scope="col">Total Amount</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($delivery->deliveryDetails as $deliveryDetail)
                                            <tr>
                                                <th>{{ $deliveryDetail->item->item_name }}</th>
                                                <td>{{ $deliveryDetail->quantity + 0}} {{ $deliveryDetail->item->unit }}</td>
                                                <td>{{ 'PHP ' . number_format($deliveryDetail->unit_price, 2) }}</td>
                                                <td>{{ 'PHP ' . number_format($deliveryDetail->SubTotal, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4">No record/s available</td></tr>
                                        @endforelse
                                      
                                    </tbody>
                                  </table>
                            </div>
                            @php $deliveryPanelCtr++; @endphp
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
</div>