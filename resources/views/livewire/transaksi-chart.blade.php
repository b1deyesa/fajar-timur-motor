<div class="transaksi-chart">

    {{-- Filter --}}
    <div class="filter">
        <label>Filter : </label>
        <select wire:model.lazy="filter">
            <option value="week">Week</option>
            <option value="month">Month</option>
        </select>
    </div>

    {{-- Chart --}}
    <ul>
        @for ($i = $count - 1; $i >= 0; $i--)
        @php $total = $transaksis->whereBetween('created_at', [today()->subDay($i)->toDateTimeString(), today()->subDay($i - 1)->toDateTimeString()])->sum('total'); @endphp
        <li>
            {{-- Bar Chart --}}
            <span style="max-height: {{ ($total / 300000000) * 100}}%"></span>

            {{-- Value --}}
            <small>Rp{{ number_format($total, 0, ',', '.') }}</small>

            {{-- Label --}}
            @if ($filter == 'week')
                <label>{{ today()->subDay($i)->format('l') }}<label>
            @elseif ($filter == 'month')        
                <label>{{ today()->subDay($i)->format('d') }}<label>
            @endif
        </li>
        @endfor
    </ul>
</div>
