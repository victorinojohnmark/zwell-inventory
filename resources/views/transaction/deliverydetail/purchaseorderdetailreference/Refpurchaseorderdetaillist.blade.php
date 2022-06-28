<div class="table-responsive">
    <table id="" class="table table-hover datatables">
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Unit Cost</th>
                <th scope="col">Delivered QTY.</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody> 
            @forelse ($delivery->purchaseOrder->purchaseOrderDetails as $purchaseOrderDetail)
            {{-- {{ dd($purchaseOrderDetail->purchaseOrder->deliveryDetails) }} --}}
            <tr>
                <td>{{ $purchaseOrderDetail->item->item_name }}</td>
                <td><span class="badge badge-secondary">{{ 'Php ' . number_format($purchaseOrderDetail->unit_cost, 2) }}</span></td>
                <td><span class="badge badge-secondary">{{ $purchaseOrderDetail->total_delivery_per_item . '/'. ($purchaseOrderDetail->quantity + 0) }} {{ $purchaseOrderDetail->item->unit }}</span></td>
                <td>
                    <button data-toggle="modal" data-target="#purchaseOrderItemModal{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" class="btn btn-sm btn-info font-weight-bold"> Add Item</button>
                    <div class="modal fade" id="purchaseOrderItemModal{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" class="purchaseOrderDetailModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Delivery Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('deliverydetailsave') }}" method="post">
                                @csrf
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <input type="hidden" name="id" value="{{ null }}">
                                            <input type="hidden" name="purchase_order_detail_id" value="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}">
                                            <input type="hidden" name="delivery_id" value="{{isset($delivery) ? $delivery->id : null }}">
                                            
                                            <div class="col-md-12">
                                                <input type="hidden" name="item_id" value="{{ $purchaseOrderDetail->item_id }}">
                                                <x-adminlte-input name="" label="Item" type="text" readonly value="{{ $purchaseOrderDetail->item_name }}"/>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <x-adminlte-input name="quantity" label="Quantity" type="number" id="purchaseOrderDetailQuantity{{ $purchaseOrderDetail->id }}" data-detailid="{{ $purchaseOrderDetail->id }}" placeholder="e.n. 150" 
                                                    min="0" step="0.01" required>
                                                    <x-slot name="appendSlot">
                                                        <div class="input-group-text">
                                                            <span id="purchaseOrderDetailUnitIndicator{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}">{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->item->unit : 'n/a' }}</span>
                                                        </div>
                                                    </x-slot>
                                                </x-adminlte-input>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <x-adminlte-input name="unit_price" label="Unit Price" type="number" 
                                                id="purchaseOrderDetailUnitCost{{ $purchaseOrderDetail->id }}" data-detailid="{{ $purchaseOrderDetail->id }}" min="0" step="0.01" required
                                                value="{{ $purchaseOrderDetail->unit_cost }}" readonly>
                                                    <x-slot name="prependSlot">
                                                        <div class="input-group-text">
                                                            <span id="itemCostCurrency"><strong>Php</strong></span>
                                                        </div>
                                                    </x-slot>
                                                </x-adminlte-input>
                                            </div>
                                        
                                            <div class="col-md-12">
                                                <x-adminlte-input name="total_amount" label="Total Amount" type="text" 
                                                id="purchaseOrderDetailSubTotalAmount{{ $purchaseOrderDetail->id }}" data-detailid="{{ $purchaseOrderDetail->id }}"  value="" readonly>
                                                    <x-slot name="prependSlot">
                                                        <div class="input-group-text">
                                                            <span id="itemTotalCostCurrency"><strong>Php</strong></span>
                                                        </div>
                                                    </x-slot>
                                                </x-adminlte-input>
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
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No PO Item record/s available.</td></tr>
            @endforelse                 
        </tbody>
    </table>
</div>