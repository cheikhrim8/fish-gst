<!DOCTYPE html>
<html>
<head>
	<title></title>
<style>
table {
 border-collapse:collapse;
 width:100%;
 }
th, td {
 border:1px solid black;
 }
 .text_gauche{
 	text-align:right;
 }
 td{
 	font-size: 15px;
 }
.caption {
 font-weight:bold
 }
</style>
</head>
<body>
	@include('entete',['code'=>'......' , 'date'=>$now , 'titre'=>"Etat de stock" ])
<div>Client: {{$client->nom.' '.$client->prenom}}  </div>
<div>numéro: {{$client->tel}}</div>
<div>Date: {{$now}}</div>
</br></br></br>
<div style="margin-top: 10px">
	<table>
	<thead>
		<tr>
		
			<th class="caption">Etiquettes de lignes</th>
			<th class="caption">Cartons</th>
			<th class="caption">Somme de poid en kg</th>
		</tr>
	</thead>
	<tbody>
		@php
	 	$totale = 0 ;
	 	$totale_poid = 0;
	 	@endphp
	 	@foreach($stocks as $stock)

	 	
	 	@if($stock['stock'] > 0)
	 		@php
	 		$totale +=$stock['stock'] ;
		 		$totale_poid +=$stock['stock']* 20 ;
		 	@endphp
	 	 <tr>
	      <th scope="row">{{$stock['nom']}}</th>
	      <td>{{$stock['stock']}}</td>
	      <td>{{$stock['stock'] * 20 }}</td>
	    </tr>
	    @endif
	    @endforeach
	    <tr>
	    	<td>Totale</td>
	    	<td>{{$totale}}</td>
	    	<td>{{$totale_poid}}</td>
	    </tr>
	</tbody>
</table>
</div>
<br>

</body>
</html>
