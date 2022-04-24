<x-modal.modal-header-body>
    <x-slot name="title">mettre le nombre de carton</x-slot>
    <x-card>
         <div class="row">
            <div class="col-md-12" id="add_carton">
                <form class="" action="{{ url('cartons/add') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <x-forms.input
                                label="Nombre carton"
                                class="required"
                                name="nb_carton"
                                placeholder="Enter nb carton">
                            </x-forms.input>
                        </div>
                    </div>
                    <input type="hidden" name="recep_poiss" value="{{$reception_poisson->id}}">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <x-buttons.btn-save
                                    onclick="add_cartons(this)"
                                    container="add_carton">
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