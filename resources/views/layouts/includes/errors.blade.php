@if ($errors->any())
<x-adminlte-alert theme="danger" dismissable>
    <ul class="m-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</x-adminlte-alert>
@endif

@if (Session::has('success'))
<x-adminlte-alert theme="success" dismissable>
    {{ Session::get('success') }}
</x-adminlte-alert>
@endif