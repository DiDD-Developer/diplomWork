<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>

    @if($type === 'select')
        <select class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}">
            @foreach($options as $value => $text)
                <option value="{{ $value }}" {{ old($name, $valueSelected) == $value ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
    @else
        <input
            type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $type === 'password' ? '' : 'required' }}
        >
    @endif

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
