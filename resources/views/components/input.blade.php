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

        {{-- File --}}
        @elseif ($type == 'file')
            <input 
                type="file" 
                name="{{ $name }}"
                wire:model="{{ $name }}"
            >
            @if (count($errors) > 0)
                @foreach($errors->all() as $error)
                    <small style="margin-left: 1em">{{ $error }}</small>
                @endforeach     
            @endif

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
                autocomplete="off" 
                wire:model="{{ $name }}" 
                @if($disabled) disabled @endif 
            >{{ old($name, $value) }}</textarea>
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