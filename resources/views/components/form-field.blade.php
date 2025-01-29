<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" value="{{ $value ?? old($name) }}"  placeholder="{{ $placeholder ?? '' }}">

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror

    @if(session('form_context'))
        @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    @endif
</div>
