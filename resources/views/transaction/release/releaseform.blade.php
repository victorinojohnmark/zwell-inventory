@extends('adminlte::page')

@section('title', config('app.name') . " - Release Form")

@section('content')

    @include('layouts.includes.errors')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    {{-- {{ $purchaseOrder->status['state'] }} {{ $purchaseOrder->status['title'] }} --}}
                    <strong>Release Form</strong> <span class="badge badge-"></span>
                </div>
                <div class="card-body">     
                    <div class="options mb-3">
                        <a href="{{ route('releaseview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Releases</a>
                        @if (!Request::is('release/create')) <a href="{{ route('releasecreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Release</a> @endif
                    </div>
        
                    <form action="{{ route('releasesave') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id" value="{{ old('id', !is_null($release->id)? $release->id : null) }}">
        
                                <x-adminlte-input name="transaction_code" label="Transaction Code" type="text" placeholder="[Auto-Generate]" readonly  
                                value="{{ old('transaction_code', !is_null($release->transaction_code)? $release->transaction_code : null) }}"/>
                            </div>

                            <div class="col-md-8">
                                <x-adminlte-select name="location_id" label="Location" required>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{!is_null($location->id) && ($release->location_id == $location->id)? 'selected' : '' }}>
                                        {{ $location->location_name }}
                                    </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>

                            <div class="col-md-6">
                                <x-adminlte-select name="contractor_id" label="Contractor" required>
                                    @foreach ($contractors as $contractor)
                                    <option value="{{ $contractor->id }}" {{!is_null($contractor->id) && ($release->contractor_id == $contractor->id)? 'selected' : '' }}>
                                        {{ $contractor->contractor_name }}
                                    </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>

                            <div class="col-md-6">
                                @php $config = ['format' => 'YYYY-MM-DD']; @endphp
                                <x-adminlte-input-date name="release_date" :config="$config" placeholder="Choose a date..." label="Release Date" required 
                                    value="{{ old('release_date', !is_null($release->release_date)? $release->release_date : null) }}">
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button theme="default" icon="fas fa-calendar-alt"
                                            title="Release Date"/>
                                    </x-slot>
                                </x-adminlte-input-date>
                            </div>

                            <div class="col-md-4">
                                <x-adminlte-input name="received_by" label="Recieved By" type="text" placeholder="e.g. john Doe"
                                value="{{ old('received_by', !is_null($release->received_by)? $release->received_by : null) }}" required/>
                            </div>

                            <div class="col-md-12">
                                <x-adminlte-textarea name="notes" label="Notes" placeholder="...">
                                    {{ old('notes', !is_null($release->notes)? $release->notes : null) }}
                                </x-adminlte-textarea>
                            </div>

                            @if ($release->id)
                            <small class="bg-secondary text-italic rounded p-1 mx-1 mb-2">
                                <i class="fas fa-fw fa-info-circle"></i> Updating Release with new location will reset release details below.
                            </small>
                            @endif
                        </div>
        
                        @if (!$release->complete_status)<button class="btn btn-sm btn-primary font-weight-bold" type="submit">Save</button> @endif
                       
                    </form>
                </div>
            </div>

            @if($release->id)
                @include('transaction.releasedetail.releasedetaillist')
            @endif
            

        </div>

        
        <div class="col-lg-4 {{ is_null($release->id)? 'd-none' : null }}">
            @include('transaction.release.releasefileattachment')
        </div>
    </div>
    
@stop

@section('plugins.Moment', true)
@section('plugins.TempusDominus', true)
@section('css')
    <link rel="stylesheet" href="/vendor/filepond/filepond.min.css">
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
   <script src="/vendor/filepond/filepond.min.js"></script>
   <script src="/js/fileattachment.js"></script>
   <script src="/js/custom.js"></script>
   <script>
    let itemSelectors = document.querySelectorAll('select[name="item_id"]');
    Array.from(itemSelectors).forEach(function(element){
        element.addEventListener('change', () => {
            if(!isNaN(element.value)){

                //ajax send post request
                $.ajax({
                    type: "POST",
                    url: '/item/getunit',
                    data: { id: element.value },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                    document.querySelector(`#releaseDetailUnitIndicator${element.dataset.detailid}`).innerHTML = data;
                    },
                    error: function (data, textStatus, errorThrown) {
                        console.log(data);
                
                    },
                });
            }
        });
    });
   </script>
   
@stop