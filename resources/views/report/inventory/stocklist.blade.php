@extends('adminlte::page')

@section('title', config('app.name') . " - Inventory Stock")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Inventory Stock</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <form action="{{ route('reportstockview') }}" class="form-row">
                    <div class="col-md-5">
                        <x-adminlte-select name="location_id" label="Location" class="" required>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id }}">
                                {{ $location->location_name }}
                            </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top:32px;"><i class="fas fw fa-search"></i> Search</button>
                    </div>
                </form>

            </div>

            <table id="" class="table table-bordered table-hover table-sm{{ isset($location_id)? ' datatable' : '' }}">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Current Stock</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($location_id))
                        @if (isset($item))
                            <tr>
                                <td>1</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->total_stock($location_id) + 0}} {{ $item->unit }}</td>
                                <td><span class="badge badge-{{ $item->stock_status($location_id)['state'] }}">{{ $item->stock_status($location_id)['title'] }}</td>
                            </tr>
                        @else
                            @php $ctr = 1; @endphp
                            @forelse ($items->sortBy('item_name') as $item)
                            <tr>
                                <td>{{ $ctr }}</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->total_stock($location_id) + 0}} {{ $item->unit }}</td>
                                <td><span class="badge badge-{{ $item->stock_status($location_id)['state'] }}">{{ $item->stock_status($location_id)['title'] }}</td>
                            </tr>
                            @php $ctr++; @endphp
                            @empty
                            @endforelse
                        @endif
                    @else
                        <tr><td colspan="5">...</td></tr>
                    @endif
                    
                </tbody>
            </table>

            
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
@stop