<x-dashboard>
    <section class="dashboard">
        
        {{-- Sidebar --}}
        <div class="sidebar">
            <div class="container">
                <div class="top">

                    {{-- Sidebar Profile --}}
                    <div class="profile">
                        <i class="fa-regular fa-circle-user"></i>
                        <a href="{{ route('user.edit', ['user' => Auth::id()]) }}">Edit Profile</a>
                    </div>

                    {{-- Sidebar Menu --}}
                    <div class="menu">
                        <a href="{{ route('gudang.index') }}" class="button">
                            <i class="fa-solid fa-box"></i>
                            <label>
                                <p><u>{{ $total_gudang }}</u> Gudang</p>
                                <small>> Cek Detail</small>
                            </label>
                        </a>
                        <a href="{{ route('supplier.index') }}" class="button">
                            <i class="fa-solid fa-truck"></i>
                            <label>
                                <p><u>{{ $total_supplier }}</u> Supplier</p>
                                <small>> Cek Detail</small>
                            </label>
                        </a>
                        <a href="{{ route('user.index') }}" class="button">
                            <i class="fa-solid fa-users"></i>
                            <label>
                                <p><u>{{ $total_user }}</u> Admin</p>
                                <small>> Cek Detail</small>
                            </label>
                        </a>
                        <a href="{{ route('transaksi.index') }}" class="button">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <label>
                                <p><u>{{ $total_transaksi }}</u> Transaksi</p>
                                <small>> Cek Detail</small>
                            </label>
                        </a>
                        <a href="{{ route('ro.index') }}" class="button">
                            <i class="fa-regular fa-hourglass-half"></i>
                            <label>
                                <p><u></u> RO</p>
                                <small>> Cek Detail</small>
                            </label>
                        </a>
                    </div>
                </div>

                {{-- Sidebar Logout --}}
                <a href="{{ route('logout') }}" class="button logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Logout</p>
                </a>
            </div>
        </div>

        {{-- Panel --}}
        <div class="panel">

            {{-- Statistic --}}
            <div class="statistic">
                <div class="parameter">
                    <div class="box">
                        <h6>Total Barang</h6>
                        <h3>{{ $total_barang }}</h3>
                    </div>
                    <div class="box">
                        <h6>Total Supplier</h6>
                        <h3>{{  $total_supplier }}</h3>
                    </div>
                    <div class="box">
                        <h6>Total Transaksi</h6>
                        <h3>{{ $total_transaksi }}</h3>
                    </div>
                </div>
                <div class="chart">
                    <div class="box">
                        <h6>Grafik Transakasi</h6>
                        <small>{{ now()->format('l, d F Y') }}</small>
                        @livewire('transaksi-chart')
                    </div>
                </div>
            </div>

            {{-- Log --}}
            <div class="log">
                <h6>Aktivitas Admin</h6>
                <table>
                    @foreach ($logs as $log)
                    <tr>
                        <td>[ {{ $log->created_at }} ]</td>
                        <td>{{ $log->user->nama }}</td>
                        <td>{{ $log->task }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
</x-dashboard>
