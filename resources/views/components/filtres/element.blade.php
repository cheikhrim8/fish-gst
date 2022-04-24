<div  {{ $attributes->merge(['class' => 'filters-item']) }}  >
    <div class="filters-label">
        <i class="fa fa-filter"></i> {{ $label }}
    </div>
    <div class="filters-input">
        {{ $slot }}
    </div>
</div>
