<form action="{{ url('tineles/edit') }}" method="post">
    {{ csrf_field() }}
  <div class="row">
        <div class="col">
            <x-forms.input
                label="Nom"
                class="required"
                name="nom"
                placeholder="Enter nom"
                value="{{$tinele->nom}}"
                >
            </x-forms.input>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <x-forms.input
                label="Nombre charios"
                class="required"
                name="nb_charios"
                placeholder="nb charios"
                value="{{$tinele->nb_charo_place}}"
            ></x-forms.input>
        </div>
    </div>
    <input type="hidden" value="{{ $tinele->id }}" name="id"/>

    <div class="form-row">
        <div class="col-md-12">
            <div class="text-right">
                <x-buttons.btn-save
                    onclick="saveform(this)"
                    container="tab1">
                    Enrigistre
                </x-buttons.btn-save>
            </div>
        </div>
    </div>
</form>
