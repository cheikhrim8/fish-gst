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

.caption{
  font-weight:bold
 }
</style>
</head>
<body style="width: 100%">
	@include('entete',['code'=>$code , 'date'=>$reception->created_at->format('d-m-Y') , 'titre'=>"Bon de réception" ])
<div>Client: {{$client->nom.' '.$client->prenom}}</div>
<div>numéro: {{$client->tel}}</div>
@php
$reception = $client->receptions->sortByDesc('id')->first();
@endphp
<div>Date reception : {{$reception->created_at->format('d-m-Y')}}</div>
<br/><br/> <br/>
<div style="margin-top: 10px">
	<table>
	<thead>
		<tr>
			<th class="caption">ID</th>
			<th class="caption">Espéce</th>
			<th class="caption">Quantité</th>
		</tr>
	</thead>
	<tbody>
		@php
		$i = 1;
		$total = 0;
		@endphp
		@foreach($reception->poissons as $poisson)

		<tr>
			<td>{{$i}}</td>
			<td>{{$poisson->libelle}} </td>
			<td>{{$poisson->pivot->poid}} Kg</td>
		</tr>
		@php
		$i = 1 + $i;
		$total +=$poisson->pivot->poid;
		@endphp
		@endforeach
		<tr >
			<td colspan="2">
				Total
			</td>
			<td>
				{{$total}}
			</td>
		</tr>
	</tbody>
</table>
</div>
</body>
</html>
