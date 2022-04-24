<div {{ $attributes->merge(['class' => 'row mb-5']) }}>
    @if(isset($title))
        <div class="col-sm-6">
            <h2 class="header">{{ $title }}</h2>
        </div>
    @endif
    <div class="col-sm-6">
        <div class="d-flex justify-content-end">
            {{ $slot }}
        </div>
    </div>
</div>





