<form action="{{ url('tests/edit') }}" method="post">

    {{ csrf_field() }}

    <div class="row">
        <div class="col">
            <x-forms.input
                label="title"
                class="required"
                name="title"
                value="{{$test->title}}"
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
                value="{{$test->description}}"
                placeholder="Description"
            ></x-forms.input>
        </div>
    </div>

    <input type="hidden" value="{{ $test->id }}" name="id"/>

    <div class="form-row">
        <div class="col-md-12">
            <div class="text-right">
                <x-buttons.btn-save
                    onclick="saveform(this)"
                    container="tab1">
                    Save
                </x-buttons.btn-save>
            </div>
        </div>
    </div>
</form>
