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
                </form>
            </div>

            
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
   <script src="{{ asset('js/custom.js') }}"></script>
@stop