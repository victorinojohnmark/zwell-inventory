@extends('adminlte::page')

@section('title', 'Zwell Inventory')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Purchase Orders</p>
                </div>
                <div class="icon"><i class="fas fa-briefcase"></i></div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0</h3>
                    <p>Deliveries Today</p>
                </div>
                <div class="icon"><i class="fas fa-truck-loading"></i></div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong>Tasks</strong>
    </div>

    <div class="card-body">
        <p>Pending tasks here...</p>
    </div>
</div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop