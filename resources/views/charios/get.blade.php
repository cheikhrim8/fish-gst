<x-modal.modal-header-body>
    <x-slot name="title">Affectation poisson </x-slot>
    <x-card class="">
        <div class="row">
            <div class="col-md-12" id="add_poison_in_chario">
                <fieldset @if($etat) disabled="disabled" @endif>
                    <form class="" action="{{ url('charios/add_poisson_to_chario') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col">
                                    <x-forms.select
                                    class="selectpicker required"
                                    onchange="get_nb_plat({{$reception_poisson_id}})" 
                                    name="chario_libre[]" 
                                    id="chario_libre" 
                                    multiple="multiple" 
                                    title="Selectionner..." data-live-search="true"
                                    label="Charios"
                                >
                                        @foreach($charios as $chario)
                                            <option value="{{$chario->id}}">{{$chario->code}}</option>
                                        @endforeach
                                    </x-forms.select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <x-forms.input
                                        label="Nombre plat"
                                        class="required"
                                        name="nb_plat"
                                        id="nb_plat"
                                        placeholder="Nombre plat"
                                        type="number" 
                                        >
                                        </x-forms.input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="nb_plat_">
                                    
                                </div>
                            </div>
                            <input type="hidden" value="{{ $reception_poisson_id }}" name="reception_poisson_id"/>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="text-right">
                                        <x-buttons.btn-save
                                            onclick="saveform(this)"
                                            container="add_poison_in_chario">
                                            Save
                                        </x-buttons.btn-save>
                                        <div id="form-errors" class="text-left"></div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </fieldset>  
            </div>
        </div>
    </x-card>
</x-modal.modal-header-body>