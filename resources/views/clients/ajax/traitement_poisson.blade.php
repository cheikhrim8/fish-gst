<div class="card-body">
      <div class="row" id="add_traitement_rception">
        <div class="col-md-12">
          <form  action="{{ url('clients/edit_reception_traitement') }}" method="post">
                     {{ csrf_field() }}
            <div class="form-row">         
              <table class="table table-bordered" id="article_add">
                  <thead>
                    <tr>
                        <th  width="60%">Nom poisson </th>
                        <th width="20%">Quantité total</th>
                        <th  width="20%">Quantité reél</th>
                    </tr>
                  </thead>
                  <tbody id="th_body">
                      @foreach($reception->poissons as $poisson)
                      <tr id="tr{{$poisson->id}}">
                        <td width="60%"><input type="text" name="poisson{{$poisson->id}}" value="{{$poisson->libelle}}" class="form-control" disabled="disabled" />
                        </td>
                        <td width="20%"><input type="text" min="1"  value="{{$poisson->pivot->poid}} KG" class="form-control" disabled="disabled" />
                        </td>
                        <td width="20%"><input type="number" min="1" name="quatite{{$poisson->id}}" @if($reception->etat > 2 ) disabled @endif value="{{$poisson->pivot->poid_reel}}" class="form-control"  />
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
               <input type="hidden" id="recep_tr" name="recep_tr" value="{{$reception->id}}">
                   <!--  <button type="submit">ok</button> -->
          </form>
        </div>
        @if($reception->etat == 1 || $reception->etat == 2)
        <div class="col-md-12 pt-1">
          <div class="text-right">
            <button class="btn btn-success btn-icon-split"  onclick="add_traitement_poisson(this)"
                    container="add_traitement_rception">
              <span class="icon text-white-50">
                <i class="main-icon fas fa-save"></i>
                <span class="spinner-border spinner-border-sm" style="display:none" role="status" aria-hidden="true"></span>
                <i class="answers-well-saved text-success fa fa-check" style="display:none" aria-hidden="true"></i>
            </span>
            <span class="text">Enrigitré</span>
            </button>
            <div id="form-errors" class="text-left"></div>
          </div>
        </div>
        @endif
    </div>
</div>