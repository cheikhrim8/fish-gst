@extends('layouts.app', ['title' => 'charios'])
@section('content')
    <x-page-header>
        <x-slot name="title">
            <i class="fa fa-chart-area"></i> Charios
        </x-slot>
        <button class="btn btn-success btn-sm mr-1" onclick="imprimer_info_charios()">
            <i class="fas fa-print"></i> Situation chario
        </button>
        <button class="btn btn-info btn-sm mr-1" onclick="openObjectModal('','charios/form','','main','','xl')">
            <i class="fa fa-plus"></i> Poisson dans le chario
        </button>
        <x-buttons.btn-add onclick="openFormAddInModal('charios')">
           Chario
        </x-buttons.btn-add>
    </x-page-header>

    <x-card>
       {{-- <x-slot name="heading">
            <div class="row">

            </div>
        </x-slot>--}}

        <div class="row">
            <div class="col">
                <x-table.table
                    id="datatableshow1"
                    link="{{url('charios/getDT/all')}}"
                    colonnes="id,code,nb_plat,rest_plat_disponible,actions"
                    class="table-hover w-100 table-bordered">
                    <thead>
                    <tr>
                        <x-table.th>#ID</x-table.th>
                        <x-table.th>Code</x-table.th>
                        <x-table.th>Nb palt</x-table.th>
                        <x-table.th>Nb de plat Disponible</x-table.th>
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
