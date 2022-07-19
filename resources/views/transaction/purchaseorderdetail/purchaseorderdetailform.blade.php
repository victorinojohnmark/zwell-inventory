<div class="form-row">
    <input type="hidden" name="id" value="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}">
    <input type="hidden" name="purchase_order_id" value="{{isset($purchaseOrder) ? $purchaseOrder->id : null }}">

    @if (isset($purchaseOrderDetail))
        <div class="col-md-12">
            <input type="hidden" name="item_id" value="{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->item_id : null }}">
            <x-adminlte-input name="Item" label="Item" type="text" value="{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->item->item_name : null }}" disabled> 
            </x-adminlte-input>
        </div>
    @else
        <div class="col-md-12">
            <x-adminlte-select name="item_id" label="Item" required
            id="purchaseOrderDetailItem{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}"
            data-detailid="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}">
                @foreach ($items as $item)
                <option value="{{ $item->id }}" {{isset($purchaseOrderDetail) ? !is_null($purchaseOrderDetail->id) && ($purchaseOrderDetail->item_id == $item->id)? 'selected' : '' : null }}>
                    {{ $item->item_code }}
                </option>
                @endforeach
            </x-adminlte-select>

        </div>
    @endif
    
    <div class="col-md-6">
        <x-adminlte-input name="quantity" label="Quantity" type="number" 
        id="purchaseOrderDetailQuantity{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}"
        data-detailid="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" 
        placeholder="e.n. 150" min="0" step="0.01" required
        value="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->quantity : null }}">
            <x-slot name="appendSlot">
                <div class="input-group-text">
                    <span id="purchaseOrderDetailUnitIndicator{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}">{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->item->unit : 'n/a' }}</span>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    <div class="col-md-6">
        <x-adminlte-input name="unit_cost" label="Unit Cost" type="number" 
        id="purchaseOrderDetailUnitCost{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}"
        data-detailid="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" 
        placeholder="e.n. 12000" min="0" step="0.01" required
        value="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->unit_cost : null }}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <span id="itemCostCurrency"><strong>Php</strong></span>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    <div class="col-md-12">
        <x-adminlte-input name="total_amount" label="Total Amount" type="text" 
        id="purchaseOrderDetailSubTotalAmount{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}"
        data-detailid="{{isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" 
        placeholder="..." readonly
            value="{{isset($purchaseOrderDetail) ? number_format($purchaseOrderDetail->SubTotal, 2) : null }}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <span id="itemTotalCostCurrency"><strong>Php</strong></span>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    <div class="col-md-12">
        <x-adminlte-textarea name="notes" label="Notes" placeholder="...">
            {{isset($purchaseOrderDetail) ? $purchaseOrderDetail->notes : null }}
        </x-adminlte-textarea>
    </div>

</div>