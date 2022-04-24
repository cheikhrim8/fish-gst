<x-modal.modal-header-body>
    <x-slot name="title">
    {!! $modal_title !!}
    </x-slot>

    @component('components.nav-tabs', ['tabs' => $tabs,'numbre'=>isset($numbre)?$numbre:null])
    @endcomponent
</x-modal.modal-header-body>

