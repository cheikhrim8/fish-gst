<div class="card mt-3">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-12">
                <table class="table border-light">
                  <thead>
                    <th>Nom poisson</th>
                    <th  class="pl-1 pr-0">Quantité en (Kg)</th>
                    <th  class="pl-1 pr-0">affctation</th>
                  </thead>
                  <tbody>
                    @foreach($reception as $poisson)
                        <tr>
                            <td>{{$poisson['poisson']}}</td>
                            <td width="200px">{{$poisson['quatite']}}</td>
                            <td>
                                <button class="btn btn-light btn-sm mx-1" 
                                       onclick="openObjectModal({{$poisson['id']}}, 'charios/get_chario_disponible' ,'' ,'second',1,'lg')">
                                <div id="correspndence-{{$poisson['id']}}">
                                    <i class="fa fa-plus text-body"></i>
                                </div>
                                </button>
                                <button class="btn btn-light btn-sm mx-1" 
                                       onclick="openObjectModal({{$poisson['id']}}, 'charios/get_info_chario_poisson' ,'' ,'third',1,'sm')">
                                    <i class="fa fa-info-circle text-body"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
