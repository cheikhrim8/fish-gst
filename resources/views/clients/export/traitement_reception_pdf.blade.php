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
	@include('entete',['code'=>$code , 'date'=>$reception->created_at->format('d-m-Y') , 'titre'=>"Traitement reception" ])
<div>Client: {{$reception->client->nom.' '.$reception->client->prenom}}</div>
<div>numéro: {{$reception->client->tel}}</div>

<div>Date traitement de la réception : {{$reception->created_at->format('d-m-Y')}}</div>
</br></br></br>
<div style="margin-top: 10px">
	<table>
	<thead>
		<tr>
			<th class="caption">ID</th>
			<th class="caption">Espéce</th>
			<th class="caption">Quantité recus</th>
			<th class="caption">Net</th>
		</tr>
	</thead>
	<tbody>
		@php
			$i = 1;
			$totalr = 0;
			$total = 0;
		@endphp
		@foreach($reception->poissons as $poisson)
		<tr>
			<td>{{$i}}</td>
			<td>{{$poisson->libelle}} </td>
			<td>{{$poisson->pivot->poid}} Kg</td>
			<td>{{$poisson->pivot->poid_reel}} Kg</td>
		@php
			$i = 1+$i;
			$total +=$poisson->pivot->poid_reel; 
			$totalr +=  $poisson->pivot->poid;
 		@endphp
		</tr>
		@endforeach
		<tr>
			<td colspan="2">
				Totale
			</td>
			<td>
				{{$totalr}}
			</td>
			<td>
				{{$total}}
			</td>
		</tr>

	</tbody>
</table>
</div>
<br>

</body>
</html>
