<form action="{{ url('clients/retirer_carton') }}" method="post">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>Poisson</th>
						<th>Nb carton</th>
					</tr>
				</thead>
				<tbody>
					@foreach($poissons as $poisson)
					@if($poisson->get_stock_client_global($client->id) > 0)
						<tr>
							<td>{{$poisson->libelle}}</td>
							<td>
								<div class="form-group">
								 	<input type="number" min="1" class="form-control" name="nb_c{{$poisson->id}}" id="nb_c{{$poisson->id}}" placeholder="Nb carons a retirer">
								 </div>
							</td>
						</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<input type="hidden" name="cl_id" id="cl_id" value="{{$client->id}}" />
	<div class="row">
        <div class="col-md-12">
            <div class="text-right">
                <x-buttons.btn-save
                    onclick="save_andgetretire(this)"
                    container="tab5">
                    Retirez
                </x-buttons.btn-save>
            </div>
        </div>
    </div>
</form>
