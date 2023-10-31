<tr class="label">
    <td>{{ $label }} @if($required)<span class="required" />@endif</td>
    <td>:</td>
    <td class="input">
        {{-- Text --}}
        @if ($type == 'text')
            <input 
                type="text" name="{{ $name }}" 
                placeholder="{{ $placeholder }}" 
                value="{{ old($name, $value) }}" 
                autocomplete="off" 
                wire:model.lazy="{{ $name }}" 
                @if($disabled) disabled @endif 
            >
            @error($name)
                <small>{{ $message }}</small>
            @enderror

        {{-- Select --}}
        @elseif ($type == 'select')
            <select name="{{ $name }}" wire:model.lazy="{{ $name }}">
                {{ $slot }}
            </select>
            @error($name)
                <small>{{ $message }}</small>
            @enderror
        
        {{-- Textarea --}}
        @elseif ($type == 'textarea')
            <textarea 
                type="text" name="{{ $name }}" 
                placeholder="{{ $placeholder }}" 
                value="{{ old($name, $value) }}" 
                autocomplete="off" 
                wire:model="{{ $name }}" 
                @if($disabled) disabled @endif 
            ></textarea>
            @error($name)
                <small>{{ $message }}</small>
            @enderror
            
        {{-- Password --}}
        @elseif ($type == 'password')
            <input 
                type="password" 
                name="{{ $name }}" 
                placeholder="{{ $placeholder }}" 
                value="{{ old($name, $value) }}" 
                autocomplete="off" 
                wire:model="{{ $name }}" 
                @if($disabled) disabled @endif
            >
            @error($name)
                <small>{{ $message }}</small>
            @enderror
        @endif
    </td>
</tr>