<div class="card-body">
      <div class="row" id="add_detaille">
        <div class="col-md-12">
          <form  action="{{ url('clients/edit_reception') }}" method="post">
                     {{ csrf_field() }}
            <div class="form-row">         
              <table class="table table-bordered" id="article_add">
                  <thead>
                    <tr>
                        <th  width="60%">Nom poisson </th>
                        <th  width="30%">Quantité</th>
                        @if($reception->etat == 1)
                          <th  width="10%">
                            <button type="button" onclick="ajouter_quantite(this,{{$poissons}})" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </button>
                        </th>
                        @endif
                    </tr>
                  </thead>
                  <tbody id="th_body">
                    @if($reception->etat == 1)
                      @foreach($reception->poissons as $poisson)
                      <tr id="tr{{$poisson->id}}">
                        <td width="60%"><input type="text" name="poisson{{$poisson->id}}" value="{{$poisson->libelle}}" class="form-control"/>
                        </td>
                        <td width="30%"><input type="number" min="1" name="quatite{{$poisson->id}}" value="{{$poisson->pivot->poid}}" class="form-control"/>
                        </td>
                        <td width="10%"><button type="button" class="btn btn-danger" onclick="remove_tr(this,{{$poisson->id}},{{$reception->id}})" id="remove"><i class="fas fa-trash"></i></button></td>
                      </tr>
                      @endforeach
                      @else
                        @foreach($reception->poissons as $poisson)
                        <tr>
                          <td width="60%"><input type="text" value="{{$poisson->libelle}}" class="form-control"/>
                          </td>
                          <td width="30%"><input type="number" min="1"  value="{{$poisson->pivot->poid}}" class="form-control"/>
                          </td>
                        </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
            </div>
               <input type="hidden" id="recep" name="recep" value="{{$reception->id}}">
                 
                    <!-- <button type="submit">ok</button> -->
          </form>
        </div>
        @if($reception->etat == 1)
        <div class="col-md-12 pt-1">
          <div class="text-right">
            <button class="btn btn-success btn-icon-split"  onclick="add_reception(this)"
                    container="add_detaille">
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