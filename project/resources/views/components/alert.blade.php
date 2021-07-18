<div class="alert alert_{{ $getType() }}" style="animation-delay: .2s">
    <div class="alert--icon">
        <i class="{{ $getIcon() }}"></i>
    </div>
    <div class="alert--content">
        {{ $getMessage() }}
    </div>
    <div class="alert--close">
        <i class="far fa-times-circle"></i>
    </div>
</div>
