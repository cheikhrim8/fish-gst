<div class="modal-header">
    <h4 class="modal-title">Affecter des poissons dans des charios</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    <div class="row">
         <div class="col-md-12 py-0">
            <div class="text-right">
                <x-buttons.btn-add onclick="valider_reeption_chario()">
                    Valider l'affectation
                </x-buttons.btn-add>
            </div>
        </div>
        <div class="col-md-12">
           <div class="card mt-3">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col">
                            <x-forms.select
                                class="selectpicker"
                                label="Clients"
                                name="client"
                                id="client"
                                data-live-search="true"
                                onchange="get_receptions()">
                                <option value="tous"></option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">  {{$client->nom.': '.$client->tel}}</option>
                                @endforeach
                            </x-forms.select>
                        </div>
                        <div class="col" id="rec">
                            <x-forms.select
                                class="selectpicker"
                                label="Receptions"
                                name="reception_ids"
                                id="reception_ids"
                                onchange="get_form_cp()">
                            </x-forms.select>
                        </div>
                    </div>   
                </div>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="charios_poissons">
            
        </div>
    </div>
</div>