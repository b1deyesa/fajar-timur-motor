<x-layout>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Login Kasir --}}
    <section class="login-kasir">
        @livewire("login-kasir")
    </section>

    {{-- Login Admin --}}
    <section class="login-admin">
        <div class="container">
            <div class="heading">
                <h1>Welcome To</h1>
                <h3>Fajar Timur Motor</h3>
            </div>
            <form method="POST" action="{{ route("login.post") }}">
                @csrf

                {{-- Input Username --}}
                <input 
                    type="text" 
                    name="username" 
                    placeholder="ID" 
                    autocomplete="off" 
                    value="{{ old("username") }}" 
                    />
                @error("username")<small>{{ $message }}</small> @enderror

                {{-- Input Password --}}
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Password" 
                    autocomplete="off" 
                    />
                @error("password")<small>{{ $message }}</small> @enderror

                <span>*Silahkan menghubungi admin untuk mendapatkan ID dan Password</span>

                {{-- Button --}}
                <button type="submit">Login</button>
            </form>
        </div>
    </section>
</x-layout>