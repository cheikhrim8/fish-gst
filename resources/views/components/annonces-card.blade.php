<div {{ $attributes->merge(['class' => 'card post-card']) }}>
  <div class="card-body p-1">
    <div class="row">
        {{ $slot }}
    </div>
  </div>
</div>
