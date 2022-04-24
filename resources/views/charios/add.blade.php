<x-modal.modal-header-body>
    <x-slot name="title">Ajouter nouveau chario</x-slot>
    <x-card class="">
        <div class="row">
            <div class="col-md-12" id="add_chario">
                <form class="" action="{{ url('charios/add') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <x-forms.input
                                label="Code"
                                class="required"
                                name="code"
                                placeholder="Enter code">
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
                            ></x-forms.input>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <x-buttons.btn-save
                                    onclick="addObject(this,'charios')"
                                    container="add_chario">
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
