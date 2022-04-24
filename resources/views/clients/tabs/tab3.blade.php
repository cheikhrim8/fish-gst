<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12 form-group">
				<label for="recept_traite"> Réceptions <span class="required_field" data-toggle="tooltip" data-placement="right" title="{{ trans('text.champ_obligatoire') }}">*</span></label>
				<select id="recept_traite" onchange="ajouter_traitement()" name="recept_traite" class="form-control form-control-sm selecte2  bordered" data-live-search="true">
					<option value="tous" selected>Tous</option>
					@foreach($client->receptions->whereIn('etat',[1,2])->sortByDesc('id') as $reception)
						<option value="{{$reception->id}}">
						 {{$reception->id}}) 	{{$reception->date_reception}} 
						</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-12">
				<div class="text-right">
					<button type="button" class="btn btn-info btn-sm" onclick="imprimer_traitement()">
						Imprimer
					</button>
				</div>
			</div>
			<input  type="hidden" name="id_cli" id="id_cli" value="{{$client->id}}">
			<div class="col-md-12 form-group mb-3">
			<!-- <button type="button" onclick="ajouter_traitement({{$client->id}})" class="btn btn-primary btn-sm">
				Traiter la réception
			</button> -->
			</div>
			<div class="col-md-12" id="detaille_reception_traitement">
				<div class="alert alert-secondary">
					Séléctionner une Réception pour faire le traitement de poisson      
				</div>
			</div>
		</div>	
	</div>
</div>