@extends('layouts.app', ['title' => 'Stock generale'])

@section('content')
    <x-page-header>
        <x-slot name="title">
            <i class="fa fa-chart-area"></i> Stock generale
        </x-slot>
        <a href="{{url('cartons')}}" type="button" class=" mr-1 btn btn-sm btn-secondary">
          <i class="fa"></i>  valider les cartons
        </a>
        <x-buttons.btn-default class="bg-primary text-white" onclick="Imprimer_stock_generale('cartons')">
           <i class="fa fa-print"></i> Imprimer
        </x-buttons.btn-default>
    </x-page-header>

    <x-card>
        <x-slot name="heading">
        </x-slot>

        <div class="row">
            <div class="col">
                <x-table.table
                    id="datatableshow"
                    link="{{url('cartons/get_stock_generaleDT')}}"
                    colonnes="id,libelle,carton_stock"
                    class="table-hover w-100 table-bordered">
                    <thead>
                    <tr>
                        <x-table.th>#ID</x-table.th>
                        <x-table.th>poisson</x-table.th>
                        <x-table.th>Quantite</x-table.th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </x-table.table>
            </div>
        </div>
    </x-card>


@endsection
