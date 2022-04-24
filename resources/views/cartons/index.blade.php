@extends('layouts.app', ['title' => 'Cartons'])

@section('content')
    <x-page-header>
        <x-slot name="title">
            <i class="fa fa-chart-area"></i> Cartons
        </x-slot>
        <a href="{{url('cartons/stock_generale')}}" type="button" class=" mr-1 btn btn-sm btn-secondary">
            Ajouter des cartons
        </a>
        <x-buttons.btn-add onclick="Ajouter_carton()">
            Ajouter des cartons
        </x-buttons.btn-add>
    </x-page-header>

    <x-card>
        <div class="row">
            <div class="col">
                <x-table.table
                    id="datatableshow"
                    link="{{url('cartons/getDT')}}"
                    colonnes="reception_id,poisson,poid_reel,nb_carton,actions"
                    class="table-hover w-100 table-bordered">
                    <thead>
                    <tr>
                        <x-table.th>#ID</x-table.th>
                        <x-table.th>poisson</x-table.th>
                        <x-table.th>Quantite</x-table.th>
                        <x-table.th>Nb carton</x-table.th>
                        <x-table.th width="160px">Actions</x-table.th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </x-table.table>
            </div>
        </div>
    </x-card>


@endsection
