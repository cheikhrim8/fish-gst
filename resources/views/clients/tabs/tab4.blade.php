<x-card>
    <div class="row">
        <div class="col-md-12">
            <div class="text-right">
                <button class="btn btn-primary btn-sm" onclick="fiche_stock_client({{$client->id}})" >Imprimer</button>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table">
            <thead>
                <tr>
                  <th scope="col">Poisson</th>
                  <th scope="col">Stock</th>
                </tr>
             </thead>
             <tbody>
                 @php
                $totale = 0 ;
                @endphp
                @foreach($stock_poisson as $stock)
                    
                @if($stock['stock'] > 0)
                    @php
                        $totale += $stock['stock'] ;
                    @endphp
                 <tr>
                  <th scope="row">{{$stock['nom']}}</th>
                  <td>{{$stock['stock']}}</td>
                </tr>
                @endif
                @endforeach
                <tr>
                    <td>Totale</td>
                    <td>{{$totale}}</td>
                </tr>
             </tbody>
        </div>
    </div>
</x-card>