@extends('adminlte::page')

@section('title', 'Zwell | Release Request List')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Releases</strong>
        </div>
        <div class="card-body">
            <div class="options">
                <a href="{{ route('releasecreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Release</a>
            </div>

            <div class="table-responsive">
                <table id="" class="table table-bordered table-hover datatables mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Release Date</th>
                            <th scope="col">Location</th>
                            <th scope="col">Contractor</th>
                            <th scope="col">Received By</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($releases as $release)
                            <tr>
                                <td>{{ $release->release_date }}</td>
                                <td>{{ $release->location->location_name }}</td>
                                <td>{{ $release->contractor->contractor_name }}</td>
                                <td>{{ $release->received_by }}</td>
                                <td><span class="badge badge-{{ $release->status['state'] }}">{{ $release->status['title'] }}</span></td>
                                <td>
                                    <a href="{{ route('releaseview', ['id' => $release->id]) }}" class="btn btn-sm btn-info font-weight">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Release record/s available.</td>
                            </tr>
                        @endforelse                
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                {{ $releases->links() }}
            </div>
        </div>
    </div>
    
@stop

@section('plugins.Moment', true)
@section('plugins.TempusDominus', true)
@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
   <script src="/js/custom.js"></script>
@stop