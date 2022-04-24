<div class="card-body">
      <div class="row" id="add_detaille">
        <div class="col-md-12">
          <form  action="{{ url('/clients/add_detaille_receptions') }}" method="post">
                     {{ csrf_field() }}
            <div class="form-row">         
              <table class="table table-bordered" id="article_add">
                  <thead>
                    <tr>
                        <th  width="60%">Nom poisson </th>
                        <th  width="30%">Quantité</th>
                          <th  width="10%">
                            <button type="button" onclick="ajouter_quantite(this,{{$poissons}})" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                  </thead>
                  <tbody id="th_body">
                  </tbody>
                </table>
            </div>
               <input type="hidden" id="client_id" name="client_id" value="{{$client->id}}">
                 
                    <!-- <button type="submit">ok</button> -->
          </form>
        </div>
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
    </div>
</div>