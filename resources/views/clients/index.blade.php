@extends('layouts.app', ['title' => 'Clients'])

@section('content')
    <x-page-header>
        <x-slot name="title">
            <i class="fa fa-chart-area"></i> Clients
        </x-slot>
        <x-buttons.btn-add onclick="openFormAddInModal('clients')">
            Client
        </x-buttons.btn-add>
    </x-page-header>

    <x-card>
       {{-- <x-slot name="heading">
            <div class="row">
               --}}{{--
                <div class="col">
                    <x-forms.select
                        class="select2"
                        class="select2"
                        label="{{__('menu.parent')}}"
                        name="parent_id"
                    >
                        <option value=""></option>
                        @foreach(\App\Models\Test::all() as $value)
                            <option value="{{$value->id}}">{{$value->libelle}}</option>
                        @endforeach
                    </x-forms.select>
                </div>
               --}}{{--
            </div>
        </x-slot>--}}

        <div class="row">
            <div class="col">
                <x-table.table
                    id="datatableshow"
                    link="{{url('clients/getDT')}}"
                    colonnes="id,nom,prenom,tel,actions"
                    class="table-hover w-100 table-bordered">
                    <thead>
                    <tr>
                        <x-table.th>#ID</x-table.th>
                        <x-table.th>Mom</x-table.th>
                        <x-table.th>Prenom</x-table.th>
                        <x-table.th>Telephone</x-table.th>
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
