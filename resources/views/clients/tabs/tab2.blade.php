 <div class="row">
    <div class="col-md-12">
        <x-forms.select
            class="select2"
            label="Liste reception"
            name="reception"
            onchange="afficher_detaille(this)">
            <option value=""></option>
            @foreach($client->receptions->where('etat',1) as $value)
                <option value="{{$value->id}}">{{$value->id}}) {{$value->date_reception}}</option>
            @endforeach
        </x-forms.select>
    </div>
    <div class="col-md-12">
        <div class="text-right"> 
          <button class="btn btn-primary" onclick="new_reception({{$client->id}})">Ajouter reception</button>
          <button class="btn btn-secondary" onclick="imprimer_reception()">imprimer</button>
        </div>
    </div>
    <div class="col-md-12 mt-1" id="detaille_reception">
        <div class="alert alert-info">
            Selectionner une Réception pour voir sa detaille ou crréer une nouvelle réception   
        </div>
    </div>
</div>
