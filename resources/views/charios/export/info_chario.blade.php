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
            border: 1px solid rgba(180, 177, 177, 0.4);
        }
        th,td{
            padding: 5px;
        }
    </style>
</head>
<body>
    @php
    $d = date('Y-m-d');
    $info = "Situation des charios" ;
    @endphp
	@include('entete',['code'=>"....." , 'date'=>$d , 'titre'=>$info ])
<div style="margin-top: 10px">
    <table>
        <tr>
            <th>Chario</th>
            <th>Espece</th>
            <th>Nbr plat</th>
        </tr>
        @php
            $toatale = 0;
        @endphp

        @foreach($charios_info as $info)
            <tr>
                <td rowspan="{{count($info['poissons'])+1}}">{{$info['nom_chario']}}</td>
            </tr>
            @foreach($info['poissons'] as $poi)
                <tr>
                    <td>{{$poi['nom_poisson']}}</td>
                    <td>{{$poi['nb_plat']}}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
</div>
</body>
</html>
