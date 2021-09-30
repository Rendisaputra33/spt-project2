<div class="alert alert_{{ $type }}" style="animation-delay: .1s">
    <div class="alert--icon">
        <i class="{{ $icon ?? '' }}"></i>
    </div>
    <div class="alert--content">
        {{ $message }}
    </div>
    <div class="alert--close">
        <i class="far fa-times-circle"></i>
    </div>
</div>
