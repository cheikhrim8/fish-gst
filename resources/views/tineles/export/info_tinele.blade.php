<!DOCTYPE html>
<html>
<head>
	<title></title>
<style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid rgba(0,0,0,.2);
        }
        th,td{
            padding: 5px;
        }
    </style>
</head>
<body>
    @php
    $d = date('Y-m-d');
    $info = "Situation tunelle ".$tunelle->nom;
    @endphp
	@include('entete',['code'=>"....." , 'date'=>$d , 'titre'=>$info ])
<div style="margin-top: 10px">


    <table>
        <tr>
            <th></th>
            <th>espece</th>
            <th>Nbr plat</th>
        </tr>
        @php
            $toatale = 0;
        @endphp

        @foreach($receptions as $reception)
            <tr>
                <td rowspan="{{$reception['rece']->poissons->count()+1}}">{{$reception['nom_prenom']}}</td>
            </tr>
            @foreach($reception['rece']->poissons as $poisson)
                @php
                    $toatale += $poisson->getNbplat($reception['rece']->id);
                @endphp
                <tr>
                    <td>{{$poisson->libelle}}</td>
                    <td>{{$poisson->getNbplat($reception['rece']->id)}}</td>
                </tr>
            @endforeach
        @endforeach
        <tr style="font-weight: bold; font-size: 20px; ">
            <td colspan="2">TOTAL</td>
            <td>{{$toatale}}</td>
        </tr>
    </table>
    
</div>
</body>
</html>
