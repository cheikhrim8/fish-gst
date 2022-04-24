<x-modal.modal-header-body>
    <x-slot name="title">Ajouter un nouveau tinelle</x-slot>
    <x-card class="">
        <div class="row">
            <div class="col-md-12" id="add_tinelle">
                <form class="" action="{{ url('tineles/add') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <x-forms.input
                                label="Nom"
                                class="required"
                                name="nom"
                                placeholder="Enter nom">
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
                            ></x-forms.input>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <x-buttons.btn-save
                                    onclick="addObject(this,'tineles')"
                                    container="add_tinelle">
                                    Enrigistre
                                </x-buttons.btn-save>
                                <div id="form-errors" class="text-left"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
</x-modal.modal-header-body>
