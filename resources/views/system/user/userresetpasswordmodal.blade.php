<x-adminlte-modal id="modalUpdatePassword{{ $user->id }}" title="Update Password">
    <form action="{{ route('userresetpassword', ['id' => $user->id]) }}" method="post">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <x-adminlte-input name="password" id="password{{ $user->id }}" label="Password" type="password" placeholder="..." required value=""/>
            </div>

            <div class="col-md-6">
                <x-adminlte-input name="confirm_password" id="confirm_password{{ $user->id }}" label="Confirm Password" type="password" placeholder="..." required value=""/>
            </div>
        </div>

        <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>
    </form>
</x-adminlte-modal>