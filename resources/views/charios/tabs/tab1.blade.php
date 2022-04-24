<form action="{{ url('charios/edit') }}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col">
            <x-forms.input
                label="Code"
                class="required"
                name="code"
                placeholder="Enter code"
                value="{{$chario->code}}"
                >
            </x-forms.input>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <x-forms.input
                label="Nombre plat"
                class="required"
                name="nb_plat"
                placeholder="Nombre plat"
                type="number"
                min="1"
                value="{{$chario->nb_plat}}"
            ></x-forms.input>
        </div>
    </div>
    <input type="hidden" value="{{ $chario->id }}" name="id"/>
    <div class="form-row">
        <div class="col-md-12">
            <div class="text-right">
                <x-buttons.btn-save
                    onclick="saveform(this)"
                    container="tab1">
                    Save
                </x-buttons.btn-save>
            </div>
        </div>
    </div>
</form>
