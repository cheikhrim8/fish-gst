 <x-card class="mt-1">
    <div class="text-right py-0"> 
        <button  class="btn btn-danger bt-sm mr-1" onclick="vider_tinele({{$tinele->id}})">
            Vider tinelle
        </button>
    </div>
    <form action="{{ url('tineles/add_charios_in_tinele') }}" method="post">
        {{ csrf_field() }}
    	<div class="row">
                <div class="col">
    			   <x-forms.select
                    class="selectpicker"
                    label="Charios"
                    data-live-search="true"
                    name="chario[]"
                    id="chario"
                    multiple="multiple"
                >
                    @foreach($charios as $chario)
                        <option value="{{$chario->id}}">{{$chario->code}}</option>
                    @endforeach
                </x-forms.select>	
    		</div>
        </div>
        <input type="text" hidden name="tinelle_id" value="{{$tinele->id}}">
        <div class="row">
            <div class="col">
                <div class="text-right">
                    <x-buttons.btn-save
                        onclick="ajouter_chario_to_tinelle(this)"
                        container="tab2">
                        Enrigistre
                     </x-buttons.btn-save>
                     
                </div>
            </div>
        </div>
    </form>
    <div class="row mt-1">
        <div class="col">
                <table id="datatableshow1" selected="" link="{{url('charios/getDT/'.$tinele->id)}}" 
                    colonnes="id,code,nb_plat,rest_plat_disponible,actions" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="30px"></th>
                            <th>Code</th>
                            <th>Nb palt</th>
                            <th>Nb de plat Disponible</th>
                            <th width="80px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>
 </x-card>