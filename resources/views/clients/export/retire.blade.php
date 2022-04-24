<!DOCTYPE html>
<html>
<head>
	<title></title>
<style>
table {
 border-collapse:collapse;
 width:80%;
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
	@include('entete',['code'=>$code , 'date'=>$retire->created_at->format('d-m-Y') , 'titre'=>"Bon de  sortie" ])
<div>Client: {{$retire->client->nom.' '.$retire->client->prenom}}   </div>
<div>numéro: {{$retire->client->tel}}</div>

</br></br></br>
<div style="margin-top: 10px">
	<table>
	<thead>
		<tr>
			<th class="caption">Espéce</th>
			<th class="caption">Nb carton</th>
			<th class="caption">poids</th>
			
		</tr>
	</thead>
	<tbody>
		@php
		  $totale_carton = 0;
		  $totale_poid = 0;
		@endphp
		@foreach($retires as $retire)
		<tr>
		@php
		  $totale_carton += $retire->nb_carton;
		  $totale_poid += $retire->nb_carton*20;
		@endphp
			<td>{{$retire->poisson->libelle}}</td>
			<td>{{$retire->nb_carton}}</td>
			<td>{{$retire->nb_carton*20}}</td>
		</tr>
		@endforeach
		<tr>
			<td>Totale</td>
			<td>{{$totale_carton}}</td>
			<td>{{$totale_poid}}</td>
		</tr>
	</tbody>
</table>
</div>

 <br>

</body>
</html>
