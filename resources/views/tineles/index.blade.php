@extends('layouts.app', ['title' => 'Tineles'])

@section('content')
    <x-page-header>
        <x-slot name="title">
            <i class="fa fa-chart-area"></i> Tineles
        </x-slot>
        <x-buttons.btn-add onclick="openFormAddInModal('tineles')">
            Tinele
        </x-buttons.btn-add>
    </x-page-header>

    <x-card>
        <div class="row">
            <div class="col">
                <x-table.table
                    id="datatableshow"
                    link="{{url('tineles/getDT')}}"
                    colonnes="id,nom,nb_charo_place,actions"
                    class="table-hover w-100 table-bordered">
                    <thead>
                    <tr>
                        <x-table.th>#ID</x-table.th>
                        <x-table.th>Nom</x-table.th>
                        <x-table.th>Nombre de place Chario </x-table.th>
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
