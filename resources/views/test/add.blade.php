<x-modal.modal-header-body>
    <x-slot name="title">Add new test</x-slot>
    <x-card class="">
        <div class="row">
            <div class="col-md-12" id="add_test">
                <form class="" action="{{ url('tests/add') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <x-forms.input
                                label="title"
                                class="required"
                                name="title"
                                placeholder="Enter title">
                            </x-forms.input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-forms.input
                                label="Description"
                                class="required"
                                name="description"
                                placeholder="Description"
                            ></x-forms.input>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <x-buttons.btn-save
                                    onclick="addObject(this,'tests')"
                                    container="add_test">
                                    Add
                                </x-buttons.btn-save>
                                <div id="form-errors" class="text-left"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
</x-modal.modal-header-body>
