<div class="modal fade" id="modalDeliveryDetail{{ isset($deliveryDetail) ? $deliveryDetail->id : '' }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delivery Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('deliverydetailsave') }}" method="post">
            @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id" value="{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}">
                        <input type="hidden" name="purchase_order_detail_id" id="purchaseOrderDetail{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}" value="{{isset($deliveryDetail) ? $deliveryDetail->purchase_order_detail_id : null }}">
                        <input type="hidden" name="delivery_id" value="{{isset($delivery) ? $delivery->id : null }}">
                        <input type="hidden" name="item_id" value="{{ isset($deliveryDetail) ? $deliveryDetail->item_id : null }}">
                        @if (isset($deliveryDetail))
                            <div class="col-md-12">
                                <x-adminlte-input name="Item" label="Item" type="text" value="{{ isset($deliveryDetail) ? $deliveryDetail->item->item_name : null }}" disabled> 
                                </x-adminlte-input>
                        
                            </div>
                        @else
                            @if ($delivery->purchaseOrder)
                                <div class="col-md-12">
                                    <x-adminlte-select name="item_id" label="Item" required
                                    id="deliveryDetailItem{{isset($deliveryDetail) ? $deliveryDetail->id : null }}"
                                    data-detailid="{{isset($deliveryDetail) ? $deliveryDetail->id : null }}">
                                        <option>Select here...</option>
                                        @foreach ($delivery->purchaseOrder->purchaseOrderDetails as $purchaseOrderDetail)
                                        <option value="{{ $purchaseOrderDetail->item->id }}" data-po_detail_id="{{ $purchaseOrderDetail->id }}" {{!is_null($purchaseOrderDetail->item->id) && isset($deliveryDetail) ? ($deliveryDetail->item_id == $purchaseOrderDetail->item->id) ? 'selected' : '' : null }}>
                                            {{ $purchaseOrderDetail->item->item_name }}
                                        </option>
                                        @endforeach
                                    </x-adminlte-select>
                            
                                </div>
                            @endif
                        @endif
                        
                        {{-- {{ dd(isset($deliveryDetail)) }} --}}
                        <div class="col-md-6">
                            <x-adminlte-input name="quantity" label="Quantity" type="number" 
                            id="deliveryDetailQuantity{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}"
                            data-detailid="{{ isset($deliveryDetail) ? $deliveryDetail->id : null }}" 
                            placeholder="e.n. 150" min="0" step="0.01" required
                            value="{{ isset($deliveryDetail) ? $deliveryDetail->quantity : null }}">
                                <x-slot name="appendSlot">
                                    <div class="input-group-text">
                                        <span id="deliveryDetailUnitIndicator{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}">{{isset($deliveryDetail) ? $deliveryDetail->item->unit : 'n/a' }}</span>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    
                        <div class="col-md-6">
                            <x-adminlte-input name="unit_price" label="Unit Price" type="number" 
                            id="deliveryDetailUnitCost{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}"
                            data-detailid="{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}" 
                            placeholder="e.n. 12000" min="0" step="0.01" required
                            value="{{isset($deliveryDetail) ? $deliveryDetail->unit_price : null }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <span id="itemCostCurrency"><strong>Php</strong></span>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    
                        <div class="col-md-12">
                            <x-adminlte-input name="total_amount" label="Total Amount Ongoing" type="text" 
                            id="deliveryDetailSubTotalAmount{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}"
                            data-detailid="{{isset($deliveryDetail) ? $deliveryDetail->id : '' }}" 
                            placeholder="..." readonly
                                value="{{isset($deliveryDetail) ? number_format($deliveryDetail->SubTotal, 2) : null }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <span id="itemTotalCostCurrency"><strong>Php</strong></span>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    
                        <div class="col-md-12">
                            <x-adminlte-textarea name="notes" label="Notes" placeholder="...">
                                {{isset($deliveryDetail) ? $deliveryDetail->notes : null }}
                            </x-adminlte-textarea>
                        </div>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>