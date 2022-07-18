<div class="form-row">
    <input type="hidden" name="id" value="{{isset($releaseDetail) ? $releaseDetail->id : null}}">
    <input type="hidden" name="release_id" value="{{ $release->id }}">
    <input type="hidden" name="location_id" value="{{ $release->location_id }}">
    
    @if (isset($releaseDetail->id))
    <div class="col-md-6">
        <input type="hidden" name="item_id" value="{{ isset($releaseDetail) ? $releaseDetail->item_id : null }}">
        <x-adminlte-input name="Item" label="Item" type="text" value="{{ isset($releaseDetail) ? $releaseDetail->item->item_name : null }}" disabled> 
        </x-adminlte-input>
    </div>
    @else
    <div class="col-md-6">
        <x-adminlte-select name="item_id" label="Item" required 
        id="releaseDetail{{isset($releaseDetail) ? $releaseDetail->id : null }}"  
        data-detailid="{{isset($releaseDetail) ? $releaseDetail->id : null }}">
            @foreach ($items as $item)
            <option value="{{ $item->id }}" {{isset($releaseDetail) ? !is_null($releaseDetail->id) && ($releaseDetail->item_id == $item->id)? 'selected' : '' : null }}>
                {{ $item->item_code }}
            </option>
            @endforeach
        </x-adminlte-select>
    </div>
    @endif

    <div class="col-md-6">
        <x-adminlte-input name="quantity" label="Quantity" type="number" 
        id="releaseDetailQuantity{{isset($releaseDetail) ? $releaseDetail->id : null }}"
        data-detailid="{{isset($releaseDetail) ? $releaseDetail->id : null }}" 
        placeholder="e.n. 150" min="0" step="0.01" required
        value="{{isset($releaseDetail) ? $releaseDetail->quantity : null }}">
            <x-slot name="appendSlot">
                <div class="input-group-text">
                    <span id="releaseDetailUnitIndicator{{isset($releaseDetail) ? $releaseDetail->id : null }}">{{isset($releaseDetail) ? $releaseDetail->item->unit : 'n/a' }}</span>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
</div>