@extends('adminlte::page')

@section('title', config('app.name') . " - Inventory Stock")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Inventory Stock</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <form action="" class="form-row">
                    <div class="col-md-5">
                        <x-adminlte-select name="location_id" label="Location" class="" required>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id }}">
                                {{ $location->location_name }}
                            </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-5">
                        <x-adminlte-select name="item_id" label="Item" class="" required>
                            <option value="all">All Item</option>
                            @foreach ($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->item_name }}
                            </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top:32px;"><i class="fas fw fa-search"></i> Search</button>
                    </div>
                </form>

            </div>

            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Current Stock</th>
                        <th scope="col">Status</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
            </table>

            
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
   <script src="{{ asset('js/custom.js') }}"></script>
@stop