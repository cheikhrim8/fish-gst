<form action="{{ url('clients/edit') }}" method="post">
    {{ csrf_field() }}
     <div class="row">
        <div class="col">
            <x-forms.input
                label="Nom"
                class="required"
                name="nom"
                value="{{$client->nom}}"
                placeholder="Nom">
            </x-forms.input>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <x-forms.input
                label="Prenom"
                class="required"
                name="prenom"
                placeholder="prenom"
                value="{{$client->prenom}}"
            ></x-forms.input>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <x-forms.input
                label="Telephone"
                class="required"
                name="telephone"
                value="{{$client->tel}}"
                placeholder="telephone"
            ></x-forms.input>
        </div>
    </div>
    <input type="hidden" value="{{ $client->id }}" name="id"/>
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
